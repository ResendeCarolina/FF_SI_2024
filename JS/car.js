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


//Para mudar a cor do botão de reservar quando se carrega
let reservaBtn = document.querySelector('#carBtn');

//Quando se carrega no botão
reservaBtn.addEventListener('mousedown', function () {
  reservaBtn.style.backgroundColor = "darkred";
  reservaBtn.style.border = "solid darkred";
});

// Quando se deixa de carregar no botão
reservaBtn.addEventListener('mouseup', function () {
  reservaBtn.style.backgroundColor = "";
  reservaBtn.style.border = "solid black";
});

document.addEventListener('DOMContentLoaded', function () {
  const matricula = document.getElementById('matricula').value;
  const startDateInput = document.getElementById('startDate');
  const endDateInput = document.getElementById('endDate');

  // Requisição para obter as datas reservadas
  fetch(`../get_reserved_dates.php?matricula=${encodeURIComponent(matricula)}`)
    .then(response => response.json())
    .then(reservas => {
      if (reservas.error) {
        console.error(reservas.error);
        return;
      }

      console.log(reservas);

      // Desativa as datas reservadas
      reservas.forEach(reserva => {
        const start = new Date(reserva.start);
        const end = new Date(reserva.end);

        // Adiciona as datas como inválidas no campo de data
        while (start <= end) {
          const dateStr = start.toISOString().split('T')[0];
          disableDate(startDateInput, dateStr);
          disableDate(endDateInput, dateStr);
          start.setDate(start.getDate() + 1);
        }
      });
    })
    .catch(error => console.error('Erro ao carregar datas reservadas:', error));

  // Função para desativar uma data
  function disableDate(input, date) {
    const option = document.createElement('option');
    console.log(option);
    option.value = date;
    option.disabled = true;
    input.appendChild(option);
  }
});

document.getElementById('carForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita o refresh da página

            const formData = new FormData(this); // Obtém os dados do formulário

            // Envia os dados via fetch
            fetch('../processar_reserva.php', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.text()) // Lê a resposta do PHP como texto
                .then(data => {
                  console.log('Resposta do servidor:', data); // Exibe a resposta no console
                  toggleCarrinho();
                })
                .catch(error => {
                    console.error('Erro na submissão:', error);
                });
});
        

// document.getElementById('carForm').addEventListener('submit', function (event) {
//   event.preventDefault(); // Evita o refresh da página
//   toggleCarrinho();
// });