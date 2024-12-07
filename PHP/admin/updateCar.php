<?php
require('../comuns/baseDados.php');

// Recebe os dados do pedido
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $matricula = pg_escape_string($connection, $data['matricula']);
    $nmr_lugares = pg_escape_string($connection, $data['nmr_lugares']);
    $cor = pg_escape_string($connection, $data['cor']);
    $ano = pg_escape_string($connection, $data['ano']);
    $novo_custo_max_dia = pg_escape_string($connection, $data['custo_max_dia']);
    $oculto = $data['oculto'] === 'true' ? 'true' : 'false'; // Formate o valor corretamente para PostgreSQL

    session_start();
    if (isset($_SESSION['nome'])) {
        $admin_nome = htmlspecialchars($_SESSION['nome']);
    }

    // Primeiro, verifica o preço atual
    $querySelect = "SELECT custo_max_dia FROM carro WHERE matricula = '$matricula'";
    $resultSelect = pg_query($connection, $querySelect);

    if (!$resultSelect) {
        echo json_encode(['success' => false, 'error' => pg_last_error($connection)]);
        exit();
    }

    $carroAtual = pg_fetch_assoc($resultSelect);
    $precoAtual = $carroAtual['custo_max_dia'];

    // Atualiza a informação na base de dados
    $queryUpdate = "UPDATE carro
                        SET nmr_lugares = '$nmr_lugares',
                            cor = '$cor',
                            ano = '$ano',
                            custo_max_dia = '$novo_custo_max_dia',
                            oculto = $oculto
                        WHERE matricula = '$matricula'";

    $result = pg_query($connection, $queryUpdate);

    if ($result) {
        // Se o preço mudou, insere um registro na tabela hist_preco_carro_
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
