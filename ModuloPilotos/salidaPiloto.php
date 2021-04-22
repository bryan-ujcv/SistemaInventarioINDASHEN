<?php
include '../conexion.php';
date_default_timezone_set('America/Guatemala');

$fecha=$_POST['fecha_salida'];
$hora = $_POST['hora_salida'];
$id = $_POST['id'];

$query="UPDATE `pilotos` SET `fecha_salida`='$fecha',`hora_salida`='$hora',`dias`=(SELECT DATEDIFF(fecha_salida,fecha_ingreso)+1),`estado`='Inactivo' WHERE `id`='$id'";

$up=mysqli_query($con,$query);

if ($up) {
    echo "<script> 
    location.href='historialCompletoPilotos.php'</script>";
}else{
    echo "Error al Ingresar Datos ERROR: Could not able to execute $up. " . mysqli_error($con);
}
?>