<?php
include 'conexion.php';
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: index.php");
  exit;
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="shortcut icon" href="CSS/IMG/image001.ico">
  <link rel="stylesheet" href="CSS/bootstrap.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventario</title>
</head>
<header>
<nav class="navbar navbar-light" style="background-color: #e3f2fd;" justify-content-between navbar-static-top">
      <a class="btn btn-danger" href="menuPrincipal.php">Atras</a>
      <form class="form-inline">
        <input class="form-control mr-sm-2" id="search" type="search" placeholder="Search" aria-label="Search">
      </form>
    </nav>
</header>

<body>
<img src="CSS/IMG/image001.png" class="img-fluid" alt="Responsive image">
  <table id="mytable" class="table table-bordered">
    <th scope="col thead-dark">ID</th>
    <th scope="col">Numero de Contenedor</th>
    <th scope="col">Chasis</th>
    <th scope="col">Genset</th>
    <th scope="col">Placa Chasis</th>
    <th scope="col">Fecha Ingreso</th>
    <th scope="col">Hora Ingreso</th>
    <th scope="col">Tamaño</th>
    <th scope="col">Ejes</th>
    <th scope="col">Observacion</th>
    <?php
    $sel = $con->query("SELECT * FROM contenedores WHERE estado='Activo'");
    while ($fila = $sel->fetch_assoc()) {
    ?>
      <tr>
        <td scope="row"><?php echo $fila['id'] ?></td>
        <td scope="row"><a href="gate-out.php?id=<?php echo $fila['id'] ?>"><?php echo $fila['num_contenedor'] ?></a></td>
        <td scope="row"><?php echo $fila['chasis'] ?></td>
        <td scope="row"><?php echo $fila['genset'] ?></td>
        <td scope="row"><?php echo $fila['placa_chasis'] ?></td>
        <td scope="row"><?php echo $fila['fecha_ingreso'] ?></td>
        <td scope="row"><?php echo $fila['hora_ingreso'] ?></td>
        <td scope="row"><?php echo $fila['tamano'] ?></td>
        <td scope="row"><?php echo $fila['ejes'] ?></td>
        <td scope="row"><a href="gate-out.php?id=<?php echo $fila['id'] ?>"><?php echo $fila['observacion'] ?></a></td>
      </tr>
    <?php } ?>
  </table>
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