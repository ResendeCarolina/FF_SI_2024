<!--ficheiro que consulta a tabela reserva da base de dados para obter os valores das data_inicio e data_fim
de todas as reservas associadas a um carro específico (que é verificado pela matrícula)-->

<?php
require('../comuns/baseDados.php');

//consoante a PK do carro - matrícula vamos selecionar o carro em questão
if (isset($_REQUEST['matricula'])) { //se for selecionado corretamente
    $matricula = pg_escape_string($connection, $_GET['matricula']);

    $query = "SELECT data_inicio, data_fim  #da tabela reserva os atributos das datas são selecionados
             FROM reserva 
             WHERE carro_matricula = '$matricula'
             ";
    $resultado = pg_query($connection, $query);

    $reservas = []; #lista de reservas inicialmente vazia
    if ($resultado && pg_num_rows($resultado) > 0) { #se for maior que zero há reservas para o carro

        while ($row = pg_fetch_assoc($resultado)) {

            $reservas[] = [ #adiciona ao array um item novo
                'start' => $row['data_inicio'],
                'end' => $row['data_fim']
            ];
        }
    }

    header('Content-Type: application/json');
    echo json_encode($reservas);
    pg_close($connection);
} else {
    http_response_code(400); //se o valor da matrícula não for detetado dá erro 
    echo json_encode(['error' => 'Invalid request']);
}
?>