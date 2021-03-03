<?php
include '../conexion.php';
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}

$query="SELECT `id`, `nombre_piloto`, `placa_piloto`, `empresa_piloto`, DATE_FORMAT( `fecha_ingreso`,'%e/%M/%Y','es_HN') as 'fecha_ingreso', DATE_FORMAT(`hora_ingreso`,'%r') as 'hora_ingreso' FROM `pilotos` WHERE `estado`='Activo'";
$result=mysqli_query($con,$query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../CSS/IMG/image001.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Pilotos Disponibles</title>
</head>

<body>
    <nav class="navbar sticky-top navbar-light justify-content-between" style="background-color: #e3f2fd;">
        <a class="btn btn-danger" href="../menuPrincipal.php">Atras</a>
        <form method="post">
            <input type="submit" value="Exportar Inventario" name="export" class="btn btn-success"></input>
        </form>
        <form class="form-inline">
            <input class="form-control mr-sm-2" id="search" type="search" placeholder="Search" aria-label="Search">
        </form>
    </nav>
    <img src="../CSS/IMG/image001.png" class="img-fluid" alt="Responsive image">
    <div class="table-responsive">
    <table id="mytable" class="table table-fixed table-bordered table-hover table-sm table-condensed">
      <thead>
        <tr>
          <th class="bg-light" scope="col">ID</th>
          <th class="bg-light" scope="col">Nombre Piloto</th>
          <th class="bg-light" scope="col">Placa Piloto</th>
          <th class="bg-light" scope="col">Empresa Piloto</th>
          <th class="bg-light" scope="col">Fecha Ingreso</th>
          <th class="bg-light" scope="col">Hora Ingreso</th>
          <th class="bg-light" scope="col"></th>
        </tr>
      </thead>
      <tbody><?php
              $x = 1;
              foreach ($result as $fila) {
              ?>
          <tr>
            <th scope="row"><?php echo $x++ ?></th>
            <td scope="row"><?php echo $fila['nombre_piloto'] ?></td>
            <td scope="row"><?php echo $fila['placa_piloto'] ?></td>
            <td scope="row"><?php echo $fila['empresa_piloto'] ?></td>
            <td scope="row"><?php echo $fila['fecha_ingreso'] ?></td>
            <td scope="row"><?php echo $fila['hora_ingreso'] ?></td>
            <td scope="row"><a class="btn btn-danger" href="updatePilotos.php?id=<?php echo $fila['id'] ?>">Salida del Piloto</td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
    <nav class="navbar " style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <h6 class="navbar-brand" href="#"><small>Desarrollado por Bryan Nuñez.</small></h6>
        </div>
    </nav>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>