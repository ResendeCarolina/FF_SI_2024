<?php

//conexão à base de dados
require('../comuns/baseDados.php');

//armazena os dados mandados pelo json
$data = [];


//GRAFICO DE BARRAS-----------------------------------------------------------------------------------
//consulta a tabela carro para contar o número total de carros agrupados por modelo
$queryModelos = "SELECT modelo, COUNT(*) AS total FROM carro GROUP BY modelo";
$resultModelos = pg_query($connection, $queryModelos);
$data['modelos'] = [];
while ($row = pg_fetch_assoc($resultModelos)) { //percorre todos os valores retornados
    $data['modelos'][] = [
        'modelo' => $row['modelo'],
        'total' => $row['total']
    ];
}

//GRAFICO CIRCULAR------------------------------------------------------------------------------------
//consulta a tabela reserva para contar o número total de reservas feitas por cada cliente
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

//retorna os dados em formato json
echo json_encode($data);
