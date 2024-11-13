let video = document.querySelector('.firstSection');

window.addEventListener('scroll', function() {
  // Calculando a opacidade com base no scroll, com limite máximo de 1 e mínimo de 0.
  let value = 1 - window.scrollY / 800; 
  // Garantir que a opacidade não seja maior que 1 nem menor que 0
  value = Math.max(0, Math.min(1, value)); 
  video.style.opacity = value;
});