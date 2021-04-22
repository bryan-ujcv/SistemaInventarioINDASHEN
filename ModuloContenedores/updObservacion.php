<?php
include '../conexion.php';

$id=$_POST['id'];
$observacion=$_POST['observacion'];
$fecha=$_POST['fecha_ingreso'];
$contenedor=$_POST['num_contenedor'];
$chas=$_POST['chasis'];
$placacha=$_POST['placa_chasis'];

$up=$con->query("UPDATE contenedores SET observacion='$observacion', fecha_ingreso='$fecha', num_contenedor='$contenedor',chasis='$chas',placa_chasis='$placacha' WHERE id='$id';");

if($up){
    echo "<script> 
    location.href='inventarioMes.php'</script>";
    
}else{
    echo "<script> 
    location.href='updateObservacion.php'        
    </script>";
}