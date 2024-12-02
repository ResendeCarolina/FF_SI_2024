//coloca a data dentro do botão depois de ter sido selecionada
function updateButtonText(inputClass, buttonClass) {
  // Seleciona todos os inputs e botões com as classes da função
  let inputs = document.querySelectorAll(inputClass);
  let buttons = document.querySelectorAll(buttonClass);

  // Corre todos inputs e botões e adiciona o evento de mudança naqueles que foram "acionados"
  inputs.forEach((input, index) => {
    input.addEventListener('change', function () {
      if (input.value) { //se alguma data foi selecionada
        let selectedDate = new Date(input.value); //vai ser escrito o valor dessa data
        //formata o modo como a data vai ser escrita
        let options = { year: 'numeric', month: '2-digit', day: '2-digit' };
        //transforma os valores de data numa string 
        let formattedDate = selectedDate.toLocaleDateString(options);
        //atualiza o texto do botão correspondente
        buttons[index].textContent = formattedDate;
      }
    });
  });
}

// Chama a função para os inputs de data e seus respectivos botões
updateButtonText('.startDate', '.startBtn');
updateButtonText('.endDate', '.endBtn');


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