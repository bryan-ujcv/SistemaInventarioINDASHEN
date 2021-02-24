<?php 
include 'conexion.php';

header('Content-type:application/xls');
header('Content-Disposition: attachment; filename=historial completo.xls');

if (isset($_POST['search'])) {
    $date1 = date("Y-m-d", strtotime($_POST['date1']));
    $date2 = date("Y-m-d", strtotime($_POST['date2']));}
?>

<table border="1">
    <tr>
      <th class="bg-light" scope="col">ID</th>
      <th class="bg-light" scope="col">Numero de Contenedor</th>
      <th class="bg-light" scope="col">Chasis</th>
      <th class="bg-light" scope="col">Genset</th>
      <th class="bg-success" scope="col">Fecha Ingreso</th>
      <th class="bg-success" scope="col">Piloto de Ingreso</th>
      <th class="bg-success" scope="col">Placa de Piloto de Ingreso</th>
      <th class="bg-success" scope="col">Empresa de Ingreso</th>
      <th class="bg-danger" scope="col">Fecha de Salida</th>
      <th class="bg-danger" scope="col">Booking de Salida</th>
      <th class="bg-danger" scope="col">Piloto de Salida</th>
      <th class="bg-danger" scope="col">Placa de Piloto de Salida</th>
      <th class="bg-danger" scope="col">Empresa de Salida</th>
      <th class="bg-light" scope="col">Dias</th>
      <th class="bg-light" scope="col">Tamaño</th>
    </tr>
    <?php
    //$sel=$con->query("SELECT * FROM `contenedores` WHERE `fecha_ingreso` BETWEEN '$date1' AND '$date2'");
    $sel = $con->query("SELECT `id`, `num_contenedor`, `chasis`, `placa_chasis`,DATE_FORMAT(`fecha_ingreso`,'%e/%M/%Y','es_HN') as 'fecha_ingreso', `piloto_ingreso`, `placa_piloto_ingreso`, `empresa_ingreso`, DATE_FORMAT( `fecha_salida`,'%e/%M/%Y','es_HN') as 'fecha_salida', `piloto_salida`, `placa_piloto_salida`, `empresa_salida`, `dias`, `genset`, `booking`, `tamano`, `ejes`, `observacion`, DATE_FORMAT(`hora_ingreso`,'%r') as 'hora_ingreso', DATE_FORMAT(`hora_salida`,'%r') as 'hora_salida' FROM `contenedores`");
    while ($fila = $sel->fetch_assoc()) {
    ?>
      <tr>
        <td scope="row"><?php echo $fila['id'] ?></td>
        <td scope="row"><?php echo $fila['num_contenedor'] ?></td>
        <td scope="row"><?php echo $fila['chasis'] ?></td>
        <td scope="row"><?php echo $fila['genset'] ?></td>
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