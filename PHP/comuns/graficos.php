<?php
require('baseDados.php');

// Dados para os gráficos
$data = [];

// Total de carros por modelo (para gráfico de barras)
$queryModelos = "SELECT modelo, COUNT(*) AS total FROM carro GROUP BY modelo";
$resultModelos = pg_query($connection, $queryModelos);
$data['modelos'] = [];
while ($row = pg_fetch_assoc($resultModelos)) {
    $data['modelos'][] = [
        'modelo' => $row['modelo'],
        'total' => $row['total']
    ];
}

// Total de reservas por utilizador (para gráfico de pizza)
$queryReservas = "SELECT cliente_pessoa_nome, COUNT(*) AS total_reservas FROM reserva GROUP BY cliente_pessoa_nome";
$resultReservas = pg_query($connection, $queryReservas);
$data['reservas'] = [];
while ($row = pg_fetch_assoc($resultReservas)) {
    $data['reservas'][] = [
        'utilizador' => $row['cliente_pessoa_nome'],
        'total' => $row['total_reservas']
    ];
}

pg_close($connection);

// Passar os dados para o frontend
echo json_encode($data);
