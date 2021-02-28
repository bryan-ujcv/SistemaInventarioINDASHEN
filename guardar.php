<?php
include 'conexion.php';
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

$query="INSERT INTO `contenedores` (`id`, `num_contenedor`, `genset`, `chasis`, `placa_chasis`, `fecha_ingreso`, `piloto_ingreso`, `placa_piloto_ingreso`, `empresa_ingreso`, `estado`,`tamano`,`ejes`,`observacion`,`hora_ingreso`) VALUES (NULL, '$cont','$gen', '$chas' ,'$placha', CURRENT_DATE(), '$pilotoi', '$placai', '$empresai','Activo','$tamano','$ejes','$observacion', CURRENT_TIME());";

$ins=mysqli_query($con,$query);
//$ins=$con->query("INSERT INTO `contenedores` (`id`, `num_contenedor`, `genset`, `chasis`, `placa_chasis`, `fecha_ingreso`, `piloto_ingreso`, `placa_piloto_ingreso`, `empresa_ingreso`, `estado`,`tamano`,`ejes`,`observacion`,`hora_ingreso`) VALUES (NULL, '$cont','$gen', '$chas' ,'$placha', CURRENT_DATE(), '$pilotoi', '$placai', '$empresai','Activo','$tamano','$ejes','$observacion', CURRENT_TIME());");

if($ins){
    echo "<script> 
    location.href='inventarioMes.php'        
    </script>";
}else{
    echo "Error al Ingresar Datos ERROR: Could not able to execute $ins. " . mysqli_error($con);
    //<script> 
    // alert(');
    // location.href='gate-in.php'        
    // </script>";
}
?>