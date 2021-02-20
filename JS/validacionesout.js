function habilitar() {
  pilotosal = document.getElementById("pilotosal").value;
  placasal = document.getElementById("placasal").value;
  empresasal = document.getElementById("empresasal").value;

  val = 0;

  if (pilotosal == "") {
    val++;
  }
  if (placasal == "") {
    val++;
  }
  if (empresasal == "") {
    val++;
  }

  if (val == 0) {
    document.getElementById("update").disabled = false;
  } else {
    document.getElementById("update").disabled = true;
  }
}

pilotosal = document
  .getElementById("pilotosal")
  .addEventListener("keyup", habilitar);
placasal = document
  .getElementById("placasal")
  .addEventListener("keyup", habilitar);
empresasal = document
  .getElementById("empresasal")
  .addEventListener("change", habilitar);

document.getElementById("update").addEventListener("click", () => {
  alert("Actualizado Correctamente");
});
