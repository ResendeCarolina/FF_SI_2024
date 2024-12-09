
/*-----------------permite ao administrador editar os detalhes do carro, 
guardando os novos valores e transitando entre o modo de visualização e de edição----------------*/

document.addEventListener("DOMContentLoaded", () => {
  const editButton = document.getElementById("editButton");
  const saveButton = document.getElementById("saveButton");
  const infoFields = document.querySelectorAll(".infoField");
  const editFields = document.querySelectorAll(".editField");

  //para ativar o modo de edição
  const enableEditMode = () => {
    infoFields.forEach(field => (field.style.display = "none"));
    editFields.forEach(field => (field.style.display = "block"));
    editButton.style.display = "none";//quando aparece o botão editar
    saveButton.style.display = "inline-block";//desaparece o botão salvar
  };

  //para sair do modo de edição
  const disableEditMode = () => {
    infoFields.forEach(field => (field.style.display = "block"));
    editFields.forEach(field => (field.style.display = "none"));
    editButton.style.display = "inline-block";//quando aparecer o botão salvar
    saveButton.style.display = "none";//desaparece o botão editar
  };

  //adiciona um evento de click ao botão de editar ("edit")
  editButton.addEventListener("click", enableEditMode);

  //adiciona um evento de click ao botão guarda ("save")
  saveButton.addEventListener("click", () => {
    const updatedData = {
      matricula: document.getElementById("editMatricula").value,
      nmr_lugares: document.getElementById("editSeats").value,
      cor: document.getElementById("editColor").value,
      ano: document.getElementById("editYear").value,
      custo_max_dia: document.getElementById("editCost").value,
      //a visibilidade do carro será alterada consoante o valor da checkbox seja retornado true ou false
      oculto: document.getElementById("editOcult").checked ? 'true' : 'false' 
    };

    //atualiza os valores que foram registados
    document.getElementById("matricula").textContent = updatedData.matricula;
    document.getElementById("nmr_lugares").textContent = updatedData.nmr_lugares;
    document.getElementById("cor").textContent = updatedData.cor;
    document.getElementById("ano").textContent = updatedData.ano;
    document.getElementById("custo_max_dia").textContent = updatedData.custo_max_dia + "€";

    //desativa o modo de edição
    disableEditMode();

    //os novos valores serão enviados para o ficheiro updateCar.php através do fetch e o 
    //php do ficheiro updateCar.php vai processar esta
    fetch("updateCar.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(updatedData),
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert("Car information updated successfully!");
        } else {
          console.error("Error:", data.error);
          alert("Failed to update car information.");
        }
      })
      .catch(error => console.error("Error:", error));
  });
});
