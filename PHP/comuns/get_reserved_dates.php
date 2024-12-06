<?php
require('baseDados.php');

if (isset($_REQUEST['matricula'])) {
    $matricula = pg_escape_string($connection, $_GET['matricula']);

    $query = "SELECT data_inicio, data_fim FROM reserva WHERE carro_matricula = '$matricula'";
    $resultado = pg_query($connection, $query);

    $reservas = [];
    if ($resultado && pg_num_rows($resultado) > 0) {
        while ($row = pg_fetch_assoc($resultado)) {
            $reservas[] = [
                'start' => $row['data_inicio'],
                'end' => $row['data_fim']
            ];
        }
    }

    header('Content-Type: application/json');
    echo json_encode($reservas);
    pg_close($connection);
} else {
    http_response_code(400); // Requisição inválida
    echo json_encode(['error' => 'Invalid request']);
}
?>