<?php include 'conexion.php';
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="CSS/IMG/image001.ico">
  <link rel="stylesheet" href="CSS/bootstrap.css">
  <title>Historial Completo</title>
</head>

<body>
  <div>
    <nav class="navbar sticky-top navbar-light" style="background-color: #e3f2fd;" justify-content-between">
      <a class="btn btn-danger" href="menuPrincipal.php">Atras</a>
      <form class="form-inline">
        <input class="form-control mr-sm-2" id="search" type="search" placeholder="Buscar" aria-label="Search">
      </form>
    </nav>
    <img src="CSS/IMG/image001.png" class="img-fluid" alt="Responsive image">
  </div>
  <div class="table-responsive">
    <table id="mytable" class="table table-hover">
      <thead class="thead-dark">
        <tr>
          <th class="header" scope="col">ID</th>
          <th class="header" scope="col">Numero de Contenedor</th>
          <th class="header" scope="col">Chasis</th>
          <th class="header" scope="col">Genset</th>
          <th class="header" scope="col">Placa Chasis</th>
          <th class="header" scope="col">Fecha Ingreso</th>
          <th class="header" scope="col">Piloto de Ingreso</th>
          <th class="header" scope="col">Placa de Piloto de Ingreso</th>
          <th class="header" scope="col">Empresa de Ingreso</th>
          <th class="header" scope="col">Fecha de Salida</th>
          <th class="header" scope="col">Booking</th>
          <th class="header" scope="col">Piloto de Salida</th>
          <th class="header" scope="col">Placa de Piloto de Salida</th>
          <th class="header" scope="col">Empresa de Salida</th>
          <th class="header" scope="col">Dias</th>
          <th class="header" scope="col">Tamaño</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sel = $con->query("SELECT * FROM contenedores ");
        while ($fila = $sel->fetch_assoc()) {
        ?>
          <tr>
            <td scope="row"><?php echo $fila['id'] ?></td>
            <td scope="row"><?php echo $fila['num_contenedor'] ?></td>
            <td scope="row"><?php echo $fila['chasis'] ?></td>
            <td scope="row"><?php echo $fila['genset'] ?></td>
            <td scope="row"><?php echo $fila['placa_chasis'] ?></td>
            <td scope="row"><?php echo $fila['fecha_ingreso'] ?></td>
            <td scope="row"><?php echo $fila['piloto_ingreso'] ?></td>
            <td scope="row"><?php echo $fila['placa_piloto_ingreso'] ?></td>
            <td scope="row"><?php echo $fila['empresa_ingreso'] ?></td>
            <td scope="row"><?php echo $fila['fecha_salida'] ?></td>
            <td scope="row"><?php echo $fila['booking'] ?></td>
            <td scope="row"><?php echo $fila['piloto_salida'] ?></td>
            <td scope="row"><?php echo $fila['placa_piloto_salida'] ?></td>
            <td scope="row"><?php echo $fila['empresa_salida'] ?></td>
            <td scope="row"><?php echo $fila['dias'] ?></td>
            <td scope="row"><?php echo $fila['tamano'] ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  
  <script src='js/jquery.min.js'></script>
  <script src="JS/bootstrap.js"></script>
  <script>
    // Write on keyup event of keyword input element
    $(document).ready(function() {
      $("#search").keyup(function() {
        _this = this;
        // Show only matching TR, hide rest of them
        $.each($("#mytable tbody tr"), function() {
          if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
            $(this).hide();
          else
            $(this).show();
        });
      });
    });
  </script>
</body>

</html>