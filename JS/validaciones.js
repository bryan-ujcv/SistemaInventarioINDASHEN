function habilitar() {
  numero = document.getElementById("num").value;
  tamano = document.getElementById("size").value;
  chasis = document.getElementById("chasis").value;
  placa = document.getElementById("placa").value;
  piloto = document.getElementById("piloto").value;
  placapilo = document.getElementById("placapiloto").value;
  empresa = document.getElementById("empresai").value;
  ejes = document.getElementById("eje").value;

  val = 0;

  if (numero == "") {
    val++;
  }
  if (tamano == "") {
    val++;
  }
  if (chasis == "") {
    val++;
  }
  if (placa == "") {
    val++;
  }
  if (piloto == "") {
    val++;
  }
  if (placapilo == "") {
    val++;
  }
  if (empresa == "") {
    val++;
  }
  if (ejes == "") {
    val++;
  }

  if (val == 0) {
    document.getElementById("btn").disabled = false;
  } else {
    document.getElementById("btn").disabled = true;
  }
}

numero = document.getElementById("num").addEventListener("keyup", habilitar);
tamano = document.getElementById("size").addEventListener("change", habilitar);
chasis = document.getElementById("chasis").addEventListener("keyup", habilitar);
placa = document.getElementById("placa").addEventListener("keyup", habilitar);
piloto = document.getElementById("piloto").addEventListener("keyup", habilitar);
placapilo = document
  .getElementById("placapiloto")
  .addEventListener("keyup", habilitar);
empresa = document
  .getElementById("empresai")
  .addEventListener("change", habilitar);
ejes = document.getElementById("eje").addEventListener("keyup", habilitar);

document.getElementById("btn").addEventListener("click", () => {
  alert("Ingresado Correctamente");
});