<?php 
include 'conexion.php';

header('Content-type:application/xls');
header('Content-Disposition: attachment; filename=inventario.xls');
?>

<table border="1">
      <tr>
        <th >ID</th>
        <th >Numero de Contenedor</th>
        <th >Chasis</th>
        <th >Genset</th>
        <th >Placa Chasis</th>
        <th >Fecha Ingreso</th>
        <th >Hora Ingreso</th>
        <th >Tamaño</th>
        <th >Ejes</th>
        <th >Observacion</th>
      </tr>
      <?php
      $sel = $con->query("SELECT * FROM contenedores WHERE estado='Activo'");
      while ($fila = $sel->fetch_assoc()) {
      ?>
        <tr>
          <td ><?php echo $fila['id'] ?></td>
          <td ><?php echo $fila['num_contenedor'] ?></td>
          <td ><?php echo $fila['chasis'] ?></td>
          <td ><?php echo $fila['genset'] ?></td>
          <td ><?php echo $fila['placa_chasis'] ?></td>
          <td ><?php echo $fila['fecha_ingreso'] ?></td>
          <td ><?php echo $fila['hora_ingreso'] ?></td>
          <td ><?php echo $fila['tamano'] ?></td>
          <td ><?php echo $fila['ejes'] ?></td>
          <td ><?php echo $fila['observacion'] ?></td>
        </tr>
      <?php } ?>
    </table>