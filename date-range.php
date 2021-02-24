<?php
require 'conexion.php';

if (isset($_POST['search'])) {
    $date1 = date("Y-m-d", strtotime($_POST['date1']));
    $date2 = date("Y-m-d", strtotime($_POST['date2']));

    $query = mysqli_query($con, "SELECT * FROM `contenedores` WHERE `fecha_ingreso` BETWEEN '$date1' AND '$date2'");

    header('Content-type:application/xls');
    header('Content-Disposition: attachment; filename=historial desde ' . $date1 . ' hasta ' . $date2 . '.xls');

    $row = mysqli_num_rows($query);
    if ($row > 0) {
        while ($fila = mysqli_fetch_array($query)) {
?>
            <tr>
                <td scope="row"><?php echo $fila['id'] ?></td>
                <td scope="row"><?php echo $fila['num_contenedor'] ?></td>
                <td scope="row"><?php echo $fila['chasis'] ?></td>
                <td scope="row"><?php echo $fila['genset'] ?></td>
                <td scope="row"><?php echo $fila['tamano'] ?></td>
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
            </tr>
        <?php
        }
    } else {
        echo '
      <tr>
        <td colspan = "4"><center>Registros no Existen</center></td>
      </tr>';
    }
} else {
    $query = mysqli_query($con, "SELECT * FROM `contenedores`");
    while ($fila = mysqli_fetch_array($query)) {
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
<?php
    }
}
?>