
/*-----------------guarda os dados submetidos pelo  form do Car para reservar datas e 
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
 
 