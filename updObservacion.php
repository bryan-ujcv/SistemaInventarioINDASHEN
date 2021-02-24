<?php
include 'conexion.php';

$id=$_POST['id'];
$observacion=$_POST['observacion'];

$up=$con->query("UPDATE contenedores SET observacion='$observacion' WHERE id='$id';");

if($up){
    echo "<script> 
    alert('Actualizado Correctamente')
    location.href='inventarioMes.php'</script>";
    
}else{
    echo "<script> 
    alert('Error al Ingresar Datos Verifique Bien')
    location.href='updateObservacion.php'        
    </script>";
}