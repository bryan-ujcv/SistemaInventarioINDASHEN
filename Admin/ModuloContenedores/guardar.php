<?php
include '../../conexion.php';

date_default_timezone_set('America/Guatemala');

$fecha=date("Y-m-d");
$hora = date("H:i:s");

$cont=$_POST['num_contenedor'];
$chas=$_POST['chasis'];
$gen=$_POST['genset'];
$placha=$_POST['placa_chasis'];
$pilotoi=$_POST['piloto_ingreso'];
$placai=$_POST['placa_piloto_ingreso'];
$empresai=$_POST['empresa_ingreso'];
$tamano=$_POST['tamano'];
$ejes=$_POST['ejes'];
$observacion=$_POST['observacion'];
$tipo=$_POST['tipo'];
$cliente=$_POST['cliente'];

$query="INSERT INTO `contenedores` (`id`, `num_contenedor`, `genset`, `chasis`, `placa_chasis`, `fecha_ingreso`, `piloto_ingreso`, `placa_piloto_ingreso`, `empresa_ingreso`, `estado`,`tamano`,`ejes`,`observacion`,`hora_ingreso`,`tipo_tamano`,`cliente`) VALUES (NULL, '$cont','$gen', '$chas' ,'$placha', '$fecha', '$pilotoi', '$placai', '$empresai','Activo','$tamano','$ejes','$observacion', '$hora','$tipo','$cliente');";

$ins=mysqli_query($con,$query);

if($ins){
    echo "<script> 
    location.href='../../ModuloCondiciones/condicionEntrada.php'        
    </script>";
}else{
    echo "Error al Ingresar Datos ERROR: Could not able to execute $ins. " . mysqli_error($con);
}
?>