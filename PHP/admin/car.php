<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car</title>
    <link rel="stylesheet" href="/CSS/main.css">
</head>

<body>
    <header class="cabecalhoGeral">
        <div class="logotipo">
            <a href="homepage.php">
                <img class="logo" id="logo" src="/IMAGENS/LogoBranco.png" alt="logotipo">
            </a>
        </div>

        <div class="menuContainer">
            <nav class="menu">
                <a class="tituloGeral sobreEfeito" id="secao1" href="homepage.php#thirdSection">STATISTICS</a>
                <a class="tituloGeral sobreEfeito" id="secao2" href="products.php">PRODUCTS</a>
                <a class="tituloGeral sobreEfeito" id="secao3" href="#fourthSection">CONTACTS</a>
            </nav>
        </div>

        <div class="iconesContainer">
            <div class="profileContainer">
                <img class="icones" id="perfil" src="/IMAGENS/pictogramaPerfil.png" alt="perfil">

                <div class="textoGeral loginNome">
                    <?php
                    // Conexão à base de dados
                    require('../comuns/baseDados.php');

                    session_start();
                    // Verificar se o utilizador está logado
                    if (isset($_SESSION['nome'])) {
                        $nome = htmlspecialchars($_SESSION['nome']);
                        echo "<p>Welcome, $nome!</p>";
                    } else {
                        echo "<p>Please login</p>";
                    }
                    ?>
                </div>
            </div>

            <div class="tituloGeral opcoesCont" id="opcoesCont">
                <a href="perfil.php">
                    <div class="sobreEfeito opcoes account" id="acount">
                        <p>MY ACCOUNT</p>
                    </div>
                </a>
                <?php
                // Conexão à base de dados
                require('../comuns/baseDados.php');


                if (isset($_SESSION['nome'])) {
                    echo "
                <a href='../comuns/logout.php' class='btn-logout'>
                    <div class='sobreEfeito opcoes logout' id='logout'>
                        <p>LOGOUT</p>
                    </div>
                </a>
                ";
                }
                ?>
            </div>
        </div>
    </header>
    <main>

        <?php

        // Verifica se o atributo "matricula" foi enviado
        if (isset($_GET['matricula'])) { //se foi enviado
            $matricula = pg_escape_string($connection, $_GET['matricula']);

            // Query para buscar os detalhes do carro
            $queryCarro = "SELECT matricula, modelo, nmr_lugares, cor, ano, custo_max_dia, img, oculto
                                FROM carro
                                WHERE matricula = '$matricula'";

            $resultado = pg_query($connection, $queryCarro);

            // Verificar se a consulta foi bem-sucedida
            if ($resultado && pg_num_rows($resultado) > 0) {
                $carro = pg_fetch_assoc($resultado);
                // Verifica se o valor de 'oculto' é 't' (true) ou 'f' (false)
                $oculto = ($carro['oculto'] === 't'); // Converte para booleano em PHP

                // Exibir as informações do carro
                echo "
                    <section class='thirdPage'>
                            
                        <div class='thirdPageFC'> 
                            <h1 class='tituloGeral tituloTP'>" . htmlspecialchars($carro['modelo']) . "</h1>
                            <div class='detalhesCarro'>
                                <img class='imagem' src='" . htmlspecialchars($carro['img']) . "' alt='" . htmlspecialchars($carro['modelo']) . "'>

                                <div class='specificationCont'>
                                    <h1 class='tituloGeral subtitulo'>Specifications</h1>
                                    <ul class='tituloGeral topicos'>
                                        <li>
                                            <span class='textoGeral specific'>Registration Plate: </span>
                                            <span class='textoGeral infoField' id='matricula'>" . htmlspecialchars($carro['matricula']) . "</span>
                                            <input type='text' class='editField' id='editMatricula' style='display: none;' value='" . htmlspecialchars($carro['matricula']) . "'>
                                        </li>
                                        <li>
                                            <span class='textoGeral specific'>Number of Seats: </span>
                                            <span class='textoGeral infoField' id='nmr_lugares'>" . htmlspecialchars($carro['nmr_lugares']) . "</span>
                                            <input type='number' class='editField' id='editSeats' style='display: none;' value='" . htmlspecialchars($carro['nmr_lugares']) . "'>
                                        </li>
                                        <li>
                                            <span class='textoGeral specific'>Color: </span>
                                            <span class='textoGeral infoField' id='cor'>" . htmlspecialchars($carro['cor']) . "</span>
                                            <input type='text' class='editField' id='editColor' style='display: none;' value='" . htmlspecialchars($carro['cor']) . "'>
                                        </li>
                                        <li>
                                            <span class='textoGeral specific'>Year: </span>
                                            <span class='textoGeral infoField' id='ano'>" . htmlspecialchars($carro['ano']) . "</span>
                                            <input type='date' class='editField' id='editYear' style='display: none;' value='" . htmlspecialchars($carro['ano']) . "'>
                                        </li>
                                        <li>
                                            <span class='textoGeral specific'>Cost per Day: </span>
                                            <span class='textoGeral infoField' id='custo_max_dia'>" . htmlspecialchars($carro['custo_max_dia']) . "€</span>
                                            <input type='number' class='editField' id='editCost' style='display: none;' value='" . htmlspecialchars($carro['custo_max_dia']) . "'>
                                        </li>
                                        <li>
                                            <span class='textoGeral specific'>Visible: </span>
                                            <input type='checkbox' class='editField' id='editOcult' " . ($oculto ? 'checked' : '') . " style='display: none;'>
                                        </li>
                                    </ul>
                                    <div class='buttonContainer'>
                                        <button class='tituloGeral editButton botaoGeral btn carBtn' id='editButton'>EDIT</button>
                                        <button class='tituloGeral saveButton botaoGeral btn carBtn' id='saveButton' style='display: none;'>SAVE</button>
                                   </div>
                                </div>
                            </div>
                        </div>
                    </section>";

                //query que vai buscar a informação das reservas de cada carro
                $queryReservas = "SELECT data_inicio, data_fim, cliente_pessoa_nome
                                  FROM reserva
                                  WHERE reserva.carro_matricula = '$matricula'";

                //query que vai buscar a informação das reservas de cada carro
                $queryTotalReservas = "SELECT COUNT (*) AS total_reservas
                                  FROM reserva
                                  WHERE reserva.carro_matricula = '$matricula'";

                $reservas = pg_query($connection, $queryReservas);
                $totalReservas = pg_query($connection, $queryTotalReservas);

                //retorna o número total de reservas
                $totalReservasRow = pg_fetch_assoc($totalReservas);
                $numeroReservas = $totalReservasRow['total_reservas'] ?? 0; //caso não haja reservas, retorna 0

                if ($reservas && pg_num_rows($reservas) > 0) {
                    echo "<section class='thirdPage'>
                                <div class='thirdPageSC'>
                                    <h1 class='tituloGeral subtitulo'>Reservations</h1>
                                    <ul class='topicos'>
                                        <li>
                                            <span class='textoGeral specific'>Number of reservations: </span>
                                            <span class='textoGeral'>" . htmlspecialchars($numeroReservas) . "</span>
                                        </li>
                                        <br>
                                        <hr>
                                        <br>";
                    while ($reserva = pg_fetch_assoc($reservas)) {
                        echo "
                                <li>
                                    <span class='textoGeral specific'>Client: </span>
                                    <span class='textoGeral'>" . htmlspecialchars($reserva['cliente_pessoa_nome']) . "</span>
                                </li>
                                <li>
                                    <span class='textoGeral specific'>Start Date: </span>
                                    <span class='textoGeral'>" . htmlspecialchars($reserva['data_inicio']) . "</span>
                                </li>
                                <li>
                                    <span class='textoGeral specific'>End Date: </span>
                                    <span class='textoGeral'>" . htmlspecialchars($reserva['data_fim']) . "</span>
                                </li>
                                <br>
                                <hr>
                                <br>
                            ";
                    }
                    echo "
                            </ul>
                        </div>
                    </section>
                    ";
                } else {
                    echo "<div class='thirdPageSC'>
                            <h1 class='tituloGeral subtitulo'>Reservations</h1>
                            <p class='textoGeral semReserva'>No reservations made</p>
                          </div>";
                }


                // Historico do carro
                //query que vai buscar a informação das reservas de cada carro
                $queryHist = "SELECT custodiario, data_alteracao, administrador_pessoa_nome
                                  FROM hist_preco_carro_
                                  WHERE hist_preco_carro_.carro_matricula = '$matricula'";

                $history = pg_query($connection, $queryHist);

                if ($history && pg_num_rows($history) > 0) {
                    while ($hist = pg_fetch_assoc($history)) {
                        echo "<section class='thirdPage'>
                                <div class='thirdPageSC'>
                                    <h1 class='tituloGeral subtitulo'>Price History</h1>
                                    <ul class='topicos'>
                                        <li>
                                            <span class='textoGeral specific'>Administrator: </span>
                                            <span class='textoGeral'>" . htmlspecialchars($hist['administrador_pessoa_nome']) . "</span>
                                        </li>
                                        <li>
                                            <span class='textoGeral specific'>Modification date: </span>
                                            <span class='textoGeral'>" . htmlspecialchars($hist['data_alteracao']) . "</span>
                                        </li>
                                        <li>
                                            <span class='textoGeral specific'>Daily value: </span>
                                            <span class='textoGeral'>" . htmlspecialchars($hist['custodiario']) . "</span>
                                        </li>
                                    </ul>
                                    <br>
                                    <hr>
                                    <br>
                                </div>
                            </section>
                            ";
                    }
                    echo "
                            </ul>
                        </div>
                    </section>
                    ";
                } else {
                    echo "<div class='thirdPageSC'>
                            <h1 class='tituloGeral subtitulo'>Modifications</h1>
                            <p class='textoGeral semReserva'>No modification made</p>
                          </div>";
                }
            } else {
                echo "<p class='textoGeral erro erroCar'>Car not found</p>";
            }
        } else {
            echo "<p class='textoGeral erro erroCar'>No car selected</p>";
        }
        ?>

    </main>
    <script src="/JS/car.js"></script>
    <script src="/JS/header.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const editButton = document.getElementById("editButton");
            const saveButton = document.getElementById("saveButton");
            const infoFields = document.querySelectorAll(".infoField");
            const editFields = document.querySelectorAll(".editField");

            // Função para alternar para o modo de edição
            const enableEditMode = () => {
                infoFields.forEach(field => (field.style.display = "none"));
                editFields.forEach(field => (field.style.display = "block"));
                editButton.style.display = "none";
                saveButton.style.display = "inline-block";
            };

            // Função para alternar para o modo de visualização
            const disableEditMode = () => {
                infoFields.forEach(field => (field.style.display = "block"));
                editFields.forEach(field => (field.style.display = "none"));
                editButton.style.display = "inline-block";
                saveButton.style.display = "none";
            };

            // Listener para o botão Editar
            editButton.addEventListener("click", enableEditMode);

            // Listener para o botão Guardar
            saveButton.addEventListener("click", () => {
                const updatedData = {
                    matricula: document.getElementById("editMatricula").value,
                    nmr_lugares: document.getElementById("editSeats").value,
                    cor: document.getElementById("editColor").value,
                    ano: document.getElementById("editYear").value,
                    custo_max_dia: document.getElementById("editCost").value,
                    oculto: document.getElementById("editOcult").checked ? 'true' : 'false' // Certifique-se de enviar como string ou booleano
                };

                // Atualizar os valores exibidos
                document.getElementById("matricula").textContent = updatedData.matricula;
                document.getElementById("nmr_lugares").textContent = updatedData.nmr_lugares;
                document.getElementById("cor").textContent = updatedData.cor;
                document.getElementById("ano").textContent = updatedData.ano;
                document.getElementById("custo_max_dia").textContent = updatedData.custo_max_dia + "€";

                // Desativa o modo de edição
                disableEditMode();

                // Fazer a chamada AJAX
                fetch("updateCar.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify(updatedData),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Car information updated successfully!");
                        } else {
                            console.error("Error:", data.error);
                            alert("Failed to update car information.");
                        }
                    })
                    .catch(error => console.error("Error:", error));
            });
        });
    </script>
</body>

</html>