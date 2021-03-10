<?php
include '../conexion.php';

$id=$_POST['id'];
$observacion=$_POST['observacion'];
$fecha=$_POST['fecha_ingreso'];

$up=$con->query("UPDATE contenedores SET observacion='$observacion', fecha_ingreso='$fecha' WHERE id='$id';");

if($up){
    echo "<script> 
    location.href='inventarioMes.php'</script>";
    
}else{
    echo "<script> 
    location.href='updateObservacion.php'        
    </script>";
}