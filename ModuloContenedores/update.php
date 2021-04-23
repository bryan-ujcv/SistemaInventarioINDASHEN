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
$date=$_POST['fecha_salida'];
$destino=$_POST['destino'];

$ins=$con->query("UPDATE contenedores SET fecha_salida='$date', hora_salida='$hora', piloto_salida='$pilotos',placa_piloto_salida='$placas',empresa_salida='$empresas',estado= 'Inactivo',booking='$booking',dias=(SELECT DATEDIFF(fecha_salida,fecha_ingreso)+1), destino='$destino' WHERE id='$id';");

if($ins){
    echo "<script>location.href='../ModuloCondiciones/condicionSalida.php?id=$id'</script>";
}else{
    echo "Error al Ingresar Datos ERROR: Could not able to execute $ins. " . mysqli_error($con);
}
?>