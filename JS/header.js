
/*função para adicionar ao carrinho o produto*/
let countP = document.getElementById("countP");
let i = 0;

let nCar = (id) => { //nCar - nº das reservas que vão para o carrinho
  console.log(id);
  i++;
  countP.innerHTML = i;
}

let form = document.getElementById("carForm");
form.addEventListener("submit", function (event) {
  event.preventDefault(); // Impede que o formulário seja enviado automaticamente

  let startDate = document.getElementById("startDate").value;
  let endDate = document.getElementById("endDate").value;

  if (startDate && endDate) { // Verifica se os campos obrigatórios estão preenchidos
    nCar("<?php echo htmlspecialchars($carro['matricula']); ?>");
    this.submit(); // Submete o formulário após adicionar ao carrinho
  }
});


//interação com carrinho
var botao = document.querySelector("#cart");
botao.addEventListener('click', toggleCarrinho);

function toggleCarrinho() {
  var contentor = document.querySelector("#cartBar");
  contentor.classList.toggle("show");
}

