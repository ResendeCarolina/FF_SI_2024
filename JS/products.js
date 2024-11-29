/*let countP = document.getElementById("countP");
let i = 0;

let test = (id) => {
  console.log(id);
  i++;
  countP.innerHTML = i;
}*/



//função responsável por mudar a cor do select
function colorChange(id) {

  let selectElement = document.getElementById(id);

  // Define a cor inicial como cinza
  selectElement.style.color = "gray";

  selectElement.addEventListener('change', function () {
    if (selectElement.value === "") {
      selectElement.style.color = "gray"; // Se a opção padrão for a escolhida, mantém-se a cor cinza
    } else {
      selectElement.style.color = "black"; // Caso contrário, muda para preto
    }
  });
}

colorChange('nmr_lugares');
colorChange('sort');

