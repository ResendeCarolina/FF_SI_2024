//interação com carrinho
var botao = document.querySelector("#cart");
botao.addEventListener('click', toggleCarrinho);

function toggleCarrinho() {
  var contentor = document.querySelector("#cartBar");
  contentor.classList.toggle("show");
}

