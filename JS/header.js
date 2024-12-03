//interação com carrinho
var botao = document.querySelector("#reserva");
botao.addEventListener('click', toggleCarrinho);

function toggleCarrinho() {
  var contentor = document.querySelector("#cartBar");
  contentor.classList.toggle("show");
}

document.getElementById('carForm').addEventListener('submit', function (event) {
  event.preventDefault(); // Evita o refresh da página

  toggleCarrinho();
});