<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="/CSS/main.css">
</head>

<body>
    <header>
        <div class="logotipo">
            <a href="#firstSection">
                <img id="logo" src="/IMAGENS/LogoBranco.png" alt="logotipo">
            </a>
        </div>

        <div class="menuContainer">
            <nav class="menu">
                <a class="tituloGeral sobreEfeito" id="secao1" href="#secondSection">ABOUT US</a>
                <a class="tituloGeral sobreEfeito" id="secao2" href="#thirddSection">PRODUCTS</a>
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
                        <p>A <strong>Fast & Furious Cars Inc.</strong> é uma empresa de referência no mercado de aluguel de carros de luxo, oferecendo uma experiência única para clientes que buscam elegância, conforto e desempenho.
                            Com uma frota composta pelos veículos mais sofisticados do mercado, desde sedans executivos até supercarros esportivos, a empresa se destaca por atender às mais altas expectativas de qualidade e exclusividade.
                            Cada carro é cuidadosamente selecionado para proporcionar uma experiência premium, seja para uma viagem de negócios, uma ocasião especial ou simplesmente para aproveitar a adrenalina de dirigir um veículo de alto desempenho.
                            Nosso compromisso é unir luxo e praticidade, permitindo que nossos clientes desfrutem de uma experiência memorável a cada reserva.
                        </p>
                        <br>
                        <p>
                            Além da excelência na frota, a <strong>Fast & Furious Cars Inc.</strong> investe em tecnologia de ponta para oferecer um sistema de reservas online simples e eficiente.
                            A plataforma permite que os clientes pesquisem e escolham o carro ideal com base em critérios como marca, estilo e preço, agendando o período desejado em poucos cliques.
                            Para os administradores, o sistema fornece ferramentas avançadas de gestão, como controle de visibilidade de veículos e estatísticas em tempo real, otimizando a operação do negócio.
                            Nosso objetivo é redefinir o setor de aluguel de carros de luxo, combinando uma frota exclusiva com serviços personalizados que priorizam a satisfação do cliente.
                        </p>
                    </div>
                </div>
            </section>
            <section class="thirdSection" id="thirdSection">
                <div class="checkthisout">
                    <div class="containerPainel">
                        <h2 class="tituloGeral title">CHECK THIS OUT</h2>
                        <img class="imgPainel" src="/IMAGENS/ctocarro1.jpg" alt="iconeMail">

                        <img class="imgPainel" src="/IMAGENS/ctocarro3.jpg" alt="iconeMail">
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