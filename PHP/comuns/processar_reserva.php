<!--ficheiro que vai buscar os valores submetidos no formulário do 
carro e os envia para a tabela reserva da base de dados-->

<?php
session_start();

require('../comuns/baseDados.php'); #conexão à base de dados

#se os dados foram enviados corretamente
if (isset($_POST['startDate'], $_POST['endDate'], $_POST['matricula'])) {

    #os atributos vão corresponder às respetivas variáveis
    $dataInicio = pg_escape_string($connection, $_POST['startDate']);
    $dataFim = pg_escape_string($connection, $_POST['endDate']);
    $matricula = pg_escape_string($connection, $_POST['matricula']);
    $clienteNome = pg_escape_string($connection, $_SESSION['nome']);

    #se os dados enviados não estiverem corretos ou estiverem vazios, dá erro e não prossegue
    if (empty($dataInicio) || empty($dataFim) || empty($matricula) || empty($clienteNome)) {
        echo "Missing required data";
        http_response_code(400); #Código de erro 400 (Bad Request)
        exit;
    }

    #a transição de dados é iniciada
    pg_query($connection, "BEGIN");

    $queryReserva = "INSERT INTO reserva (data_inicio, data_fim, carro_matricula, cliente_pessoa_nome) 
                     VALUES ('$dataInicio', '$dataFim', '$matricula', '$clienteNome')";
    $resultReserva = pg_query($connection, $queryReserva);

    #se os valores estiverem corretos e se prosseguir com transição para a base de dados
    if ($resultReserva) { #se os valores forem inseridos corretamente
        pg_query($connection, "COMMIT");
        echo "Reservation made successfully";
    } else {
        pg_query($connection, "ROLLBACK"); #se os valores não forem inseridos corretamente
        echo "Error: " . pg_last_error($connection);
        http_response_code(500); #Código de erro 500 (Internal Server Error)
    }

    pg_close($connection);
} else { #se os dados não forem enviados corretamente
    echo "Invalid request";
    http_response_code(400);
}
