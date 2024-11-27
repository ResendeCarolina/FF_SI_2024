<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car</title>
</head>
<body>
    <?php

    // conexão à base de dados
    require('../baseDados.php');

    echo "<h1> Carro </h1>";

    // Verificar se o parâmetro "matricula" foi enviado
    if (isset($_GET['matricula'])) {
        $matricula = pg_escape_string($connection, $_GET['matricula']);

        // Query para buscar os detalhes do carro
        $query = "SELECT matricula, modelo, nmr_lugares, cor, ano, custo_max_dia, administrador_pessoa_nome, img FROM carro WHERE matricula = '$matricula'";
        $resultado = pg_query($connection, $query);

        // Verificar se a consulta foi bem-sucedida
        if ($resultado && pg_num_rows($resultado) > 0) {
            $carro = pg_fetch_assoc($resultado);

            // Exibir as informações do carro
            echo "
        <div class='carro-detalhes'>
            <h1>" . htmlspecialchars($carro['modelo']) . "</h1>
            <img src='" . htmlspecialchars($carro['img']) . "' alt='" . htmlspecialchars($carro['modelo']) . "'>
            <ul>
                <li><strong>Matrícula:</strong> " . htmlspecialchars($carro['matricula']) . "</li>
                <li><strong>Número de Lugares:</strong> " . htmlspecialchars($carro['nmr_lugares']) . "</li>
                <li><strong>Cor:</strong> " . htmlspecialchars($carro['cor']) . "</li>
                <li><strong>Ano:</strong> " . htmlspecialchars($carro['ano']) . "</li>
                <li><strong>Custo Máximo por Dia:</strong> €" . htmlspecialchars($carro['custo_max_dia']) . "</li>
                <li><strong>Administrador:</strong> " . htmlspecialchars($carro['administrador_pessoa_nome']) . "</li>
            </ul>
        </div>
        ";
        } else {
            echo "<p>Carro não encontrado.</p>";
        }
    } else {
        echo "<p>Matrícula não especificada.</p>";
    }

    // Fechar a conexão
    pg_close($connection);
    ?>
</body>
</html>

<!-- <div class='element'>
                            <div class='wrapbutton'>
                                <div class='dateContainer'>
                                    <button class='tituloGeral date startBtn'>START</button>
                                    <input class='dateInput startDate' type='date'>
                                </div>
                                <div class='dateContainer'>
                                    <button class='tituloGeral date endBtn'>END</button>
                                    <input class='dateInput endDate' type='date'>
                                </div>
                            </div>
                            <button class='botaoPlus' onclick='test(" . htmlspecialchars($carro['matricula']) . ")'><img class='imgPlus' src='/IMAGENS/pictogramaPlus.png' alt='adicionar'></button>
                        </div> -->
