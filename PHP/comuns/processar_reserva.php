<?php

session_start();

require('../comuns/baseDados.php'); // conexão à base de dados

// verificar se os dados foram enviados corretamente
if (isset($_POST['startDate'], $_POST['endDate'], $_POST['matricula'])) {

    // obter os valores dos campos
    $dataInicio = new DateTime($_POST['startDate']);
    $dataFim = new DateTime($_POST['endDate']);
    $matricula = pg_escape_string($connection, $_POST['matricula']);
    $clienteNome = pg_escape_string($connection, $_SESSION['nome']);

    // formatar as datas para o formato desejado
    $start = $dataInicio->format('Y-m-d'); // corrigido para usar $start
    $end = $dataFim->format('Y-m-d'); // corrigido para usar $end

    // verificar conflito de reserva
    $check_conflict = "SELECT * FROM reserva 
                       WHERE carro_matricula = '$matricula' 
                       AND ((data_inicio <= '$end' AND data_fim >= '$start'))";

    $check_conflict_result = pg_query($connection, $check_conflict); // corrigido para $connection
    
    
    
    //se não for possível reservar nesse período, dá erro e a sessão termina
    if (!$check_conflict_result) {
        echo "Database error: " . pg_last_error($connection);
        exit();
    }

    $conflict = pg_fetch_all($check_conflict_result);

    //se der erro remete o utilizador
    if ($conflict) {
        echo "The car is already booked for those dates! Please, select another dates or another car";
        exit();
    }

    // verificar se os dados estão completos
    if (empty($start) || empty($end) || empty($matricula) || empty($clienteNome)) {
        echo "Missing required data";
        http_response_code(400); // erro 400 (Bad Request)
        exit;
    }

    // iniciar transação
    pg_query($connection, "BEGIN");

    $queryReserva = "INSERT INTO reserva (data_inicio, data_fim, carro_matricula, cliente_pessoa_nome) 
                     VALUES ('$start', '$end', '$matricula', '$clienteNome')";
    $resultReserva = pg_query($connection, $queryReserva);

    if ($resultReserva) {
        // confirmar transação
        pg_query($connection, "COMMIT");
        echo "Reservation made successfully";
    } else {
        // desfazer transação em caso de erro
        pg_query($connection, "ROLLBACK");
        echo "Error: Could not complete reservation." . pg_last_error($connection);
        http_response_code(500); // erro 500 (Internal Server Error)
    }

    pg_close($connection);
} else {
    echo "Invalid request";
    http_response_code(400);
}


?>