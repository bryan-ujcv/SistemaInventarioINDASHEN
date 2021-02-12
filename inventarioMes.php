<?php
include 'conexion.php';
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: index.php");
  exit;
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="CSS/IMG/image001.ico"> 
    <link rel="stylesheet" href="CSS/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario del Mes</title>
</head>
<body>
<table class="table table-bordered">
    <th scope="col">ID</th>
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
    $sel = $con->query("SELECT * FROM contenedores WHERE estado='1'");
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
        <td scope="row"><?php echo $fila['observacion'] ?></td>
      </tr>
    <?php } ?>
  </table>
  <script src='js/jquery.min.js'></script>
  <script src="JS/bootstrap.js"></script>
</body>
</html>