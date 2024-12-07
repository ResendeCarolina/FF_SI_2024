<?php
require('../comuns/baseDados.php');
session_start();

// Recebe os dados do pedido
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $matricula = pg_escape_string($connection, $data['matricula']);
    $nmr_lugares = pg_escape_string($connection, $data['nmr_lugares']);
    $cor = pg_escape_string($connection, $data['cor']);
    $ano = pg_escape_string($connection, $data['ano']);
    $custo_max_dia = pg_escape_string($connection, $data['custo_max_dia']);

    // Atualiza a informação na base de dados
    $queryUpdate = "UPDATE carro
                    SET nmr_lugares = '$nmr_lugares',
                        cor = '$cor',
                        ano = '$ano',
                        custo_max_dia = '$custo_max_dia'
                    WHERE matricula = '$matricula'";

    $result = pg_query($connection, $queryUpdate);


    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => pg_last_error($connection)]);
    }


    
    $oculto = isset($_POST['oculto']) ? 1 : 0; // Verifica se o carro deve estar oculto

    // Nome do administrador que está a realizar a alteração (assumindo que está logado)
    $administradorNome = $_SESSION['nome'] ?? 'Unknown';

    // Data da alteração
    $dataAlteracao = date('Y-m-d H:i:s'); // Formato padrão de data e hora

    // Consulta para inserir no histórico
    $queryInserirHistorico = "INSERT INTO historico_carro (custo_diario, data_alteracao, oculto, administrador_pessoa_nome, carro_matricula)
                            VALUES ($novoCustoDiario,
        $dataAlteracao,
        $oculto,
        $administradorNome,
        $matricula)";

    // Prepara e executa a query
    $resultadoInsercao = pg_query_params($connection, $queryInserirHistorico);

    if ($resultadoInsercao) {
        echo "Histórico atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o histórico: " . pg_last_error($connection);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'No data received']);
}

