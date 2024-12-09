
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




/*---------------------------------- função para mudar cor do botão ao carregar -----------------------------*/

//para mudar a cor do botão de reservar quando se carrega
let reservaBtn = document.querySelector('#carBtn');

//quando se carrega no botão
reservaBtn.addEventListener('mousedown', function () {
  reservaBtn.style.backgroundColor = "darkred";
  reservaBtn.style.border = "solid darkred";
});

//quando se deixa de carregar no botão
reservaBtn.addEventListener('mouseup', function () {
  reservaBtn.style.backgroundColor = "";
  reservaBtn.style.border = "solid black";
});



/*----------------- função que guarda os dados submetidos pelo  form do Car e 
 os envia para o ficheiro PHP processar_reserva.php usando o método POST. ----------------*/
let carroForm = document.getElementById('carForm');

carroForm.addEventListener('submit', function (event) {
  event.preventDefault(); // Evitar o envio normal do formulário e o refresh

  let dadosForm = new FormData(this); // Obter os dados do formulário

  fetch('../comuns/processar_reserva.php', { // Enviar dados para o PHP
    method: 'POST',
    body: dadosForm,
  })
    .then(response => {
      if (!response.ok) {
        // Se o status da resposta não for 200, processar o erro
        return response.text().then(errorMessage => {
          throw new Error(errorMessage);
        });
      }
      return response.text(); // Retornar o texto da resposta em caso de sucesso
    })
    .then(data => {
      // Verifica se a resposta do servidor contém a mensagem de sucesso
      if (data.trim() === "Reservation made successfully") {
        alert(data); // Exibe a mensagem de sucesso
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


