<?php include 'conexion.php'; 
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
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
  <table class="table table-bordered">
    <th scope="col">ID</th>
    <th scope="col">Numero de Contenedor</th>
    <th scope="col">Chasis</th>
    <th scope="col">Genset</th>
    <th scope="col">Placa Chasis</th>
    <th scope="col">Fecha Ingreso</th>
    <th scope="col">Piloto de Ingreso</th>
    <th scope="col">Placa de Piloto de Ingreso</th>
    <th scope="col">Empresa de Ingreso</th>
    <th scope="col">Fecha de Salida</th>
    <th scope="col">Booking</th>
    <th scope="col">Piloto de Salida</th>
    <th scope="col">Placa de Piloto de Salida</th>
    <th scope="col">Empresa de Salida</th>
    <th scope="col">Dias</th>
    <th scope="col">Tamaño</th>
    <?php
    $sel = $con->query("SELECT * FROM contenedores");
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
  </table>
  <script src='js/jquery.min.js'></script>
  <script src="JS/bootstrap.js"></script>
</body>

</html>