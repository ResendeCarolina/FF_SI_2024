<?php
//establece/configura uma conexão com a base de dados
$servername = 'dbname=FF_SI24 user=postgres password=postgres host=localhost port=5432';
$connection = pg_connect($servername);

//se não estiver conectado com a base dados dá erro
if (!$connection) {
    echo 'Erro: Não foi possível conectar ao banco de dados.';
}
