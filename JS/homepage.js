//reduz suavemente a opacidade do videoInicial através do scroll
let video = document.querySelector('.firstSection');

window.addEventListener('scroll', function() {
  //calculando a opacidade com base no scroll, com limite máximo de 1 e mínimo de 0.
  let value = 1 - window.scrollY / 800; 
  //garante que a opacidade não seja maior que 1 nem menor que 0
  value = Math.max(0, Math.min(1, value)); 
  video.style.opacity = value;
});


//aumenta suavemente a opacidade do header através do scroll
let header = document.querySelector('.cabecalhoHP');

window.addEventListener('scroll', function () {
  //calcula a opacidade com base no scroll, variando entre 1 (no topo) e 0 (após 600px de scroll)
  let cabecalhoValor = window.scrollY / 600;
  cabecalhoValor = Math.max(0, Math.min(1, cabecalhoValor));
  header.style.background = 'rgba(0, 0, 0, ' + cabecalhoValor + ')';
});
