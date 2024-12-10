<?php

require('../comuns/baseDados.php');

//o ficheiro php recebe os dados enviados através do method POST no formato json
$data = json_decode(file_get_contents('php://input'), true);

//verifica os valores retornados
if ($data) {
    $matricula = pg_escape_string($connection, $data['matricula']);
    $nmr_lugares = pg_escape_string($connection, $data['nmr_lugares']);
    $cor = pg_escape_string($connection, $data['cor']);
    $ano = pg_escape_string($connection, $data['ano']);
    $novo_custo_max_dia = pg_escape_string($connection, $data['custo_max_dia']);
    $oculto = $data['oculto'] === 'true' ? 'true' : 'false'; //o valor da variável será true ou false consaonte o valor enviado

    session_start();

    if (isset($_SESSION['nome'])) {
        $admin_nome = htmlspecialchars($_SESSION['nome']);
    }

    //Consulta a tabela carro e seleciona o custo diário do carro
    $querySelect = "SELECT custo_max_dia 
                    FROM carro 
                    WHERE matricula = '$matricula'";
    $resultSelect = pg_query($connection, $querySelect);

    //se a consulta falhou, a função é enviada uma mensagem de erro 
    //que é convertida para formato json 
    if (!$resultSelect) {
        echo json_encode(['success' => false, 'error' => pg_last_error($connection)]);
        exit();
    }

    $carroAtual = pg_fetch_assoc($resultSelect);
    $precoAtual = $carroAtual['custo_max_dia'];

    //valor da data do momento presente
    //verifica se o carro tem reservas no futuro
    $currentDate = date('Y-m-d');
    $queryCheckReservations = "SELECT data_inicio, data_fim 
                                FROM reserva
                                WHERE carro_matricula = '$matricula' 
                                AND data_inicio > '$currentDate'";  // Verifica reservas futuras


    $resultCheckReservations = pg_query($connection, $queryCheckReservations);

    //se houver reservas no futuro
    if (pg_num_rows($resultCheckReservations) > 0) {
        echo json_encode(['erro' => 'Já há reservas feitas']);
        exit();
    }


    //atualiza os novos valores na tabela carro da base de dados
    $queryUpdate = "UPDATE carro
                    SET nmr_lugares = '$nmr_lugares',
                        cor = '$cor',
                        ano = '$ano',
                        custo_max_dia = '$novo_custo_max_dia',
                        oculto = $oculto
                    WHERE matricula = '$matricula'";

    $result = pg_query($connection, $queryUpdate);

    if ($result) {
        //se o preço foi alterado essa informação também vai ser inserida na tabela do hirótico de preço de carros da base de dados
        if ($precoAtual != $novo_custo_max_dia) {
            $queryInsertHist = "INSERT INTO hist_preco_carro_ (custodiario, data_alteracao, oculto, administrador_pessoa_nome, carro_matricula)
                                    VALUES ('$precoAtual', NOW(), $oculto, '$admin_nome', '$matricula')";

            $resultInsertHist = pg_query($connection, $queryInsertHist);

            if (!$resultInsertHist) {
                echo json_encode(['success' => false, 'error' => 'Failed to update history: ' . pg_last_error($connection)]);
                exit();
            }
        }

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => pg_last_error($connection)]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'No data received']);
}
