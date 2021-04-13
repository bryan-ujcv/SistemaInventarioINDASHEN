<?php

include '../conexion.php';

$cont=$_POST['id'];
$obs=$_POST['observacion'];
$llanta1=$_POST['llanta1'];
$llanta2=$_POST['llanta2'];
$llanta3=$_POST['llanta3'];
$llanta4=$_POST['llanta4'];
$llanta5=$_POST['llanta5'];
$llanta6=$_POST['llanta6'];
$llanta7=$_POST['llanta7'];
$llanta8=$_POST['llanta8'];
$llanta9=$_POST['llanta9'];
$llanta10=$_POST['llanta10'];
$llanta11=$_POST['llanta11'];
$llanta12=$_POST['llanta12'];

$ins="INSERT INTO `condiciones`(`id`, `contenedor_id`, `tipo_condicion`, `observacion`, `llanta1`, `llanta2`, `llanta3`, `llanta4`, `llanta5`, `llanta6`, `llanta7`, `llanta8`, `llanta9`, `llanta10`, `llanta11`, `llanta12`) VALUES (null,'$cont','Entrada','$obs','$llanta1','$llanta2','$llanta3','$llanta4','$llanta5','$llanta6','$llanta7','$llanta8','$llanta9','$llanta10','$llanta11','$llanta12')";
$resin=mysqli_query($con,$ins);

if($resin){
    echo "<script> 
    location.href='condiciones.php'        
    </script>";
}else{
    echo "Error al Ingresar Datos ERROR: Could not able to execute $resin. " . mysqli_error($con);
}
?>