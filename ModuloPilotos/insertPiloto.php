<?php
include '../conexion.php';
date_default_timezone_set('America/Guatemala');

$fecha=date("Y-m-d");
$hora = date("H:i:s");
$piloto=$_POST['piloto_ingreso'];
$placa=$_POST['placa_piloto_ingreso'];
$empresa=$_POST['empresa_ingreso'];

$query="INSERT INTO `pilotos` (`id`, `nombre_piloto`, `placa_piloto`, `empresa_piloto`, `fecha_ingreso`, `hora_ingreso`, `estado`) VALUES (NULL, '$piloto', '$placa', '$empresa', '$fecha', '$hora', 'Activo');";

$ins=mysqli_query($con,$query);

if($ins){
    echo "<script> 
    location.href='pilotosDisponibles.php'        
    </script>";
}else{
    echo "Error al Ingresar Datos $ins. " . mysqli_error($con);
}
?>