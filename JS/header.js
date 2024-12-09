//interação icone de perfil
let perfil = document.querySelector("#perfil");
let opcoesCont = document.querySelector("#opcoesCont");

perfil.addEventListener('click', mostraOpcoes);

function mostraOpcoes() {
  if (opcoesCont.style.display === "block") {
    opcoesCont.style.display = "none";  // Esconde as opções
  } else {
    opcoesCont.style.display = "block"; // Exibe as opções
  }
}

