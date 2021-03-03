<?php
include '../conexion.php';

$id=$_POST['id'];
$pilotos=$_POST['piloto_salida'];
$placas=$_POST['placa_piloto_salida'];
$empresas=$_POST['empresa_salida'];
$booking=$_POST['booking'];

$ins=$con->query("UPDATE contenedores SET fecha_salida=CURRENT_DATE(), hora_salida=CURRENT_TIME(), piloto_salida='$pilotos',placa_piloto_salida='$placas',empresa_salida='$empresas',estado= 'Inactivo',booking='$booking',dias=(SELECT DATEDIFF(fecha_salida,fecha_ingreso)+1) WHERE id='$id';");

if($ins){
    echo "<script> 
    alert('Actualizado Correctamente')
    location.href='historialCompleto.php'</script>";
    
}else{
    echo "<script> 
    alert('Error al Ingresar Datos Verifique Bien')
    location.href='gate-out.php'        
    </script>";
}