<?php
include '../../conexion.php';
date_default_timezone_set('America/Guatemala');

$id=$_POST['id'];
$hora=$_POST['hora_ingreso'];
$fecha=$_POST['fecha_ingreso'];
$piloto=$_POST['piloto_ingreso'];
$placa=$_POST['placa_piloto_ingreso'];
$empresa=$_POST['empresa_piloto'];

$query="UPDATE `pilotos` SET `fecha_ingreso`='$fecha',`hora_ingreso`='$hora',`nombre_piloto`='$piloto',`placa_piloto`='$placa',`empresa_piloto`='$empresa' WHERE `id`='$id'";

$up=mysqli_query($con,$query);

if ($up) {
    echo "<script>location.href='pilotosDisponibles.php'</script>";
}else{
    echo "Error al Ingresar Datos ERROR: Could not able to execute $up. " . mysqli_error($con);
}
?>