<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="/CSS/main.css">
</head>

<body>
    <header class="cabecalhoHP">
        <div class="logotipo">
            <a href="homepage.php">
                <img id="logo" src="/IMAGENS/LogoBranco.png" alt="logotipo">
            </a>
        </div>

        <div class="menuContainer">
            <nav class="menu">
                <a class="tituloGeral sobreEfeito" id="secao1" href="#secondSection">ABOUT US</a>
                <a class="tituloGeral sobreEfeito" id="secao2" href="products.php">PRODUCTS</a>
                <a class="tituloGeral sobreEfeito" id="secao3" href="#fourthSection">CONTACTS</a>
            </nav>
        </div>

        <div class="icones">
            <a>
                <img id="perfil" src="/IMAGENS/pictogramaPerfil.png" alt="perfil">
            </a>
        </div>
    </header>
    <main>
        <article>
            <section class="firstSection">
                <div class="videoInicial">
                    <video class="video" muted autoplay loop src="/IMAGENS/videoInicial.mp4" alt="videoInicial"></video>
                </div>
                <div class="sloganInicial">
                    <p class="tituloGeral slogan">
                        GO FAST<br>
                        AND FURIOUS.
                    </p>
                </div>
            </section>
            <section class="secondSection" id="secondSection">
                <div class="textContainer">
                    <div class="textoGeral text">
                        <h2 class="tituloGeral title">ABOUT US</h2>
                        <p><strong>Fast & Furious Cars Inc.</strong>  is a leading company in the luxury car rental market. We offer a unique experience for clients seeking elegance, comfort, and quality.
                        Our fleet consists of the most sophisticated vehicles on the market, from executive sedans to sports cars, and we stand out for our exclusivity.
                        </p>
                        <br>
                        <p>Each car is carefully selected to provide an unforgettable experience, whether for a business trip, a special occasion, or simply enjoying the thrill of driving.
                        Our greatest commitment is to unite luxury and practicality, allowing our clients to enjoy a memorable experience with every booking.
                        </p>
                        <br>
                        <p>
                        In addition to our exceptional fleet, we invest in cutting-edge technology to offer a simple and efficient online booking system.
                        The platform allows clients to search for and select the perfect car based on criteria such as brand, style, and price, scheduling the desired rental period in just a few clicks.
                        For administrators, the system provides advanced management tools, such as vehicle visibility controls and real-time statistics, optimizing business operations.
                        Our goal is to redefine the luxury car rental sector by combining exclusivity with personalized services that prioritize customer satisfaction.
                        </p>
                        <br>
                        <p><a class="sobreEfeito sentence" href="paginadosprodutos">Click now and rent your new car for a few days!</a></p>
                    </div>
                </div>
            </section>
            <section class="thirdSection" id="thirdSection">
                <div class="checkthisout">
                        <h2 class="tituloGeral title" id="titleTS">CHECK THIS OUT</h2>
                        <div class="painel">
                            <img class="imgPainel" src="/IMAGENS/ctocarro1.jpg" alt="carro1">
                            <img class="imgPainel" src="/IMAGENS/ctocarro3.jpg" alt="carro2">
                        </div>
                </div>
            </section>
        </article>
    </main>
    <footer class="textoGeral fourthSection" id="fourthSection">
        <div class="conteudoFooter" id="aluno">
            <div class="iconesContact">
                <img class="icoC" id="mail" src="/IMAGENS/pictogramaMail.jpg" alt="iconeMail">
                <img class="icoC" id="phone" src="/IMAGENS/pictogramaTelefone.jpg" alt="iconePhone">
                <img class="icoC" id="local" src="/IMAGENS/pictogramaLocalizacao.jpg" alt="iconeLocal">
            </div>
            <ul>
                <li>fastandfurious@gmail.com</li>
                <li>+351 239 567 307</li>
                <li>Rua Quinta da Beira, lote 3, nº 25, 3030-240, Coimbra</li>
            </ul>
            <div class="iconesMedia">
                <img class="icoM" id="face" src="/IMAGENS/pictogramaFace.png" alt="iconeFacebook">
                <img class="icoM" id="insta" src="/IMAGENS/pictogramaInsta.png" alt="iconeInsta">
                <img class="icoM" id="twitter" src="/IMAGENS/pictogramaTwitter.png" alt="iconeTwitter">
            </div>
        </div>
    </footer>
    <script src="/JS/script.js"></script>
</body>

</html>