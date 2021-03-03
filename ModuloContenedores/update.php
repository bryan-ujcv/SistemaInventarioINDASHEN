<?php
include '../conexion.php';
date_default_timezone_set('America/Guatemala');

$fecha=date("Y-m-d");
$hora = date("H:i:s");

$id=$_POST['id'];
$pilotos=$_POST['piloto_salida'];
$placas=$_POST['placa_piloto_salida'];
$empresas=$_POST['empresa_salida'];
$booking=$_POST['booking'];

$ins=$con->query("UPDATE contenedores SET fecha_salida='$fecha', hora_salida='$hora', piloto_salida='$pilotos',placa_piloto_salida='$placas',empresa_salida='$empresas',estado= 'Inactivo',booking='$booking',dias=(SELECT DATEDIFF(fecha_salida,fecha_ingreso)+1) WHERE id='$id';");

if($ins){
    echo "<script> 
    location.href='historialCompleto.php'</script>";
    
}else{
    echo "Error al Ingresar Datos ERROR: Could not able to execute $ins. " . mysqli_error($con);
}
?>