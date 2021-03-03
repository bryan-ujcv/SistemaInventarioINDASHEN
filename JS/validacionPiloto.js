function habilitar() {
    piloto = document.getElementById("piloto").value;
    placapilo = document.getElementById("placapiloto").value;
    empresa = document.getElementById("empresa").value;
  
    val = 0;
  
    if (piloto == "") {
      val++;
    }
    if (placapilo == "") {
      val++;
    }
    if (empresa == "") {
      val++;
    }
  
    if (val == 0) {
      document.getElementById("btn").disabled = false;
    } else {
      document.getElementById("btn").disabled = true;
    }
  }

  piloto = document.getElementById("piloto").addEventListener("keyup", habilitar);
  placapilo = document.getElementById("placapiloto").addEventListener("keyup", habilitar);
  empresa = document.getElementById("empresa").addEventListener("change", habilitar);
  
  document.getElementById("btn").addEventListener("click", () => {
    alert("Ingresado Correctamente");
  });