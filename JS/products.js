
//coloca a data dentro do botão depois de ter sido selecionada
function updateButtonText(inputClass, buttonClass) {
    // Seleciona todos os inputs e botões com as classes da função
    let inputs = document.querySelectorAll(inputClass);
    let buttons = document.querySelectorAll(buttonClass);
  
    // Corre todos inputs e botões e adiciona o evento de mudança naqueles que foram "acionados"
    inputs.forEach((input, index) => {
        input.addEventListener('change', function() {
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