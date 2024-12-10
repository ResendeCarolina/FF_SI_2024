//função responsável por mudar a cor do select na barra de filtros
function colorChange(id) {

  let selectElement = document.getElementById(id);

  //define a cor inicial como cinza
  selectElement.style.color = "gray";

  selectElement.addEventListener('change', function () {
    if (selectElement.value === "") {
      selectElement.style.color = "gray"; //se a opção padrão for a escolhida, mantém-se a cor cinza
    } else {
      selectElement.style.color = "black"; //caso contrário, muda para preto
    }
  });
}

colorChange('nmr_lugares');
colorChange('sort');

