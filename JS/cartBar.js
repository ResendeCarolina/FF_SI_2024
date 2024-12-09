//interação com a aba lateral que lista todas as reservas que aparece só no cliente
let botao = document.querySelector("#reserva");
let aba = document.querySelector("#cartBar");

botao.addEventListener('click', toggleCarrinho);
document.addEventListener('click', foraCarrinho);
aba.addEventListener('click', dentroCarrinho);

function toggleCarrinho() {
  aba.classList.toggle("show");
}

// se carregar dentro do contentor/aba esta não se fecha
function dentroCarrinho(event) {
  event.stopPropagation();
}

function foraCarrinho(event) {
  //verifica se clicámos fora do contentor/aba lateral e do botão
  if (!aba.contains(event.target) && !botao.contains(event.target)) {
    aba.classList.remove("show");
  }
}