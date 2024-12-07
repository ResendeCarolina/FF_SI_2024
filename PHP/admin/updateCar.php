<?php
    require('../comuns/baseDados.php');

    // Recebe os dados do pedido
    $data = json_decode(file_get_contents('php://input'), true);

    if ($data) {
        $matricula = pg_escape_string($connection, $data['matricula']);
        $nmr_lugares = pg_escape_string($connection, $data['nmr_lugares']);
        $cor = pg_escape_string($connection, $data['cor']);
        $ano = pg_escape_string($connection, $data['ano']);
        $custo_max_dia = pg_escape_string($connection, $data['custo_max_dia']);
        $oculto = $data['oculto'] === 'true' ? 'true' : 'false'; // Formate o valor corretamente para PostgreSQL

        // Atualiza a informação na base de dados
        $queryUpdate = "UPDATE carro
                        SET nmr_lugares = '$nmr_lugares',
                            cor = '$cor',
                            ano = '$ano',
                            custo_max_dia = '$custo_max_dia',
                            oculto = $oculto
                        WHERE matricula = '$matricula'";

        $result = pg_query($connection, $queryUpdate);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => pg_last_error($connection)]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'No data received']);
    }
?>
