
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

carroForm.addEventListener('submit', function (event) { //depois do formulário ser submetido
  event.preventDefault(); //não há refresh da página

  let dadosForm = new FormData(this); //obtém os dados do formulário

  //envia os dados via fetch
  fetch('../comuns/processar_reserva.php', {//envia os dados do formulário (data_inicio e data_fim das reservas) para o ficheiro processar_reserva
    method: 'POST',
    body: dadosForm,
  })
    .then(response => response.text()) //lê a resposta do PHP como texto
    .then(data => {
      console.log('Resposta do servidor:', data); // Exibe a resposta na consola
      toggleCarrinho();
    })
    .catch(error => {
      console.error('Erro na submissão:', error);
    });
});




/*-------------- funções que vão buscar o valor das reservas e mostram quais são as datas disponíveis --------------*/

document.addEventListener('DOMContentLoaded', function () {
  let matricula = document.getElementById('matricula').value; //vai buscar o valor da matricula
  let startDateInput = document.getElementById('startDate');  //o valor da data_inico
  let endDateInput = document.getElementById('endDate');      //e o valor da data_fim

  //requisição para obter as datas reservadas
  fetch(`../comuns/get_reserved_dates.php?matricula=${encodeURIComponent(matricula)}`)
    .then(response => response.json())
    .then(reservas => {
      if (reservas.error) {
        console.error(reservas.error);
        return;
      }

      console.log(reservas);

      //desativa as datas reservadas
      reservas.forEach(reserva => {
        let start = new Date(reserva.start);
        let end = new Date(reserva.end);

        //adiciona as datas como inválidas no campo de data
        while (start <= end) {
          let dateStr = start.toISOString().split('T')[0];
          disableDate(startDateInput, dateStr);
          disableDate(endDateInput, dateStr);
          start.setDate(start.getDate() + 1);
        }
      });
    })
    .catch(error => console.error('Erro ao carregar datas reservadas:', error));

  //função para desativar uma data
  function disableDate(input, date) {
    let option = document.createElement('option');
    console.log(option);
    option.value = date;
    option.disabled = true;
    input.appendChild(option);
  }
});




