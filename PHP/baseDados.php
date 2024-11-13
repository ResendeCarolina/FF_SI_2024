<?php
    //Establece ligação com a base de dados
    $servername = 'dbname=FF_SI24 user=postgres password=2765 host=localhost port=5432';
    $connection = pg_connect($servername);

    //Verifica conectividade
    if (!$connection) {
        echo 'Erro: Não foi possível conectar ao banco de dados.';
    }
?>