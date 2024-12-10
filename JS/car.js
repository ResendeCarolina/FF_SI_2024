
/*---------------------------------- função para colocar data dentro dos inputs -----------------------------*/

//coloca a data dentro do botão depois de ter sido selecionada
function updateButtonText(inputClass, buttonClass) {
  // Seleciona todos os inputs e botões com as classes da função
  let inputs = document.querySelectorAll(inputClass);
  let buttons = document.querySelectorAll(buttonClass);

  //corre todos inputs e botões e adiciona o evento de mudança naqueles que foram "acionados"
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

//chama a função para a data ficar escrita dentro do botão
updateButtonText('.startDate', '.startBtn');
updateButtonText('.endDate', '.endBtn');



/*-----------------guarda os dados submetidos pelo  form do Car para reservar datas e 
 os envia para o ficheiro PHP processar_reserva.php usando o método POST. ----------------*/
let carroForm = document.getElementById('carForm');

carroForm.addEventListener('submit', function (event) {

  let dadosForm = new FormData(this); // Obter os dados do formulário

  fetch('../comuns/processar_reserva.php', { // Enviar dados para o PHP
    method: 'POST',
    body: dadosForm,
  })
    .then(response => {
      if (!response.ok) {
        return response.text().then(errorMessage => {
          throw new Error(errorMessage);
        });
      }
      return response.text(); //envia o texto de resposta de sucesso
    })
    .then(data => {
      //verifica se tem a resposta de sucesso
      if (data.trim() === "Reservation made successfully") {
        alert(data); 
        // Recarrega a página e depois chama a função para abrir a aba lateral
        window.location.reload(); // A página será recarregada
      } else {
        alert(data); // Caso a reserva não tenha sido bem-sucedida, apenas exibe o erro
      }
    })
    .catch(error => {
      // Exibe a mensagem de erro ao cliente
      alert(error.message); // Mostrar o erro no alerta
      window.location.reload(); // Faz o refresh em caso de erro
    });
});

