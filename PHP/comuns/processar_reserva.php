<?php

//retoma a sessão e vai buscar os dados do utilizador
session_start();

//conexão à base de dados
require('../comuns/baseDados.php');

//verifica se os dados do formulário foram enviados corretamente
if (isset($_POST['startDate'], $_POST['endDate'], $_POST['matricula'])) {

    //converte as variáveis em objetos dateTime
    $dataInicio = new DateTime($_POST['startDate']);
    $dataFim = new DateTime($_POST['endDate']);
    $matricula = pg_escape_string($connection, $_POST['matricula']);
    $clienteNome = pg_escape_string($connection, $_SESSION['nome']);

    //formata as datas para o formato ano-mês-dia
    $start = $dataInicio->format('Y-m-d');
    $end = $dataFim->format('Y-m-d');

    //consulta a tabela reserva para verificar se já existem reservas marcadas  
    $check_conflict = "SELECT * FROM reserva 
                       WHERE carro_matricula = '$matricula' 
                       AND ((data_inicio <= '$end' AND data_fim >= '$start'))";

    $check_conflict_result = pg_query($connection, $check_conflict);



    //se já houver reservas marcadas que afetem os dias em que tento marcar, dá erro e a sessão termina
    if (!$check_conflict_result) {
        echo "Database error: " . pg_last_error($connection);
        exit();
    }

    $conflict = pg_fetch_all($check_conflict_result);

    //se der erro aparece um alerta do porquê se não ser possível agendar reserva
    if ($conflict) {
        echo "The car is already booked for those dates! Please, select another date or another car";
        exit();
    }

    //verifica se nenhum dos campos obrigatórios está vazio/por preencher
    if (empty($start) || empty($end) || empty($matricula) || empty($clienteNome)) {
        echo "Missing required data";
        http_response_code(400); // erro 400 (Bad Request)
        exit;
    }

    //inicia a transação de registo da reserva
    pg_query($connection, "BEGIN");

    $queryReserva = "INSERT INTO reserva (data_inicio, data_fim, carro_matricula, cliente_pessoa_nome) 
                     VALUES ('$start', '$end', '$matricula', '$clienteNome')";
    $resultReserva = pg_query($connection, $queryReserva);

    if ($resultReserva) {
        //confirma a transação
        pg_query($connection, "COMMIT");
        echo "Reservation made successfully!";
    } else {
        //volta para trás/é interrompida se der erro
        pg_query($connection, "ROLLBACK");
        echo "Error: Could not complete reservation." . pg_last_error($connection);
        http_response_code(500); // erro 500 (Internal Server Error)
    }

    //encerra a transação
    pg_close($connection);
} else {
    echo "Invalid request";
    http_response_code(400);
}
