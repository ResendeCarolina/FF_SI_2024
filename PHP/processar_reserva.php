<?php
session_start(); // Inicia a sessão

require('baseDados.php'); // Conexão ao banco de dados

if (isset($_POST['startDate'], $_POST['endDate'], $_POST['matricula'])) {
    $dataInicio = pg_escape_string($connection, $_POST['startDate']);
    $dataFim = pg_escape_string($connection, $_POST['endDate']);
    $matricula = pg_escape_string($connection, $_POST['matricula']);
    $clienteNome = pg_escape_string($connection, $_SESSION['nome']);

    if (empty($dataInicio) || empty($dataFim) || empty($matricula) || empty($clienteNome)) {
        echo "Missing required data";
        http_response_code(400); // Código de erro 400 (Bad Request)
        exit;
    }

    // Inicia transação
    pg_query($connection, "BEGIN");

    $queryReserva = "INSERT INTO reserva (data_inicio, data_fim, carro_matricula, cliente_pessoa_nome) 
                     VALUES ('$dataInicio', '$dataFim', '$matricula', '$clienteNome')";
    $resultReserva = pg_query($connection, $queryReserva);

    if ($resultReserva) {
        pg_query($connection, "COMMIT");
        echo "Reservation made successfully";
    } else {
        pg_query($connection, "ROLLBACK");
        echo "Error: " . pg_last_error($connection);
        http_response_code(500); // Código de erro 500 (Internal Server Error)
    }

    pg_close($connection);
} else {
    echo "Invalid request";
    http_response_code(400);
}
