<?php
include '../conexion.php';

session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index.php");
    exit;
}

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

$LC = "SELECT id, ejes, piloto_ingreso, cliente FROM contenedores ORDER BY id DESC LIMIT 1";
$resultID = mysqli_query($con, $LC);
$row = mysqli_fetch_array($resultID);
$id = $row['id'];
$eje=$row['ejes'];
$cliente=$row['cliente'];

$folderPath = "firmas/";
$image_parts = explode(";base64,", $_POST['signed']); 
$image_type_aux = explode("image/", $image_parts[0]);
$image_type = $image_type_aux[1];
$image_base64 = base64_decode($image_parts[1]);
$firma = $folderPath . $row['piloto_ingreso'].'Entrada'. uniqid() . '.'.$image_type;
file_put_contents($firma, $image_base64);

if ($eje==3) {
    
$llanta9=$_POST['llanta9'];
$llanta10=$_POST['llanta10'];
$llanta11=$_POST['llanta11'];
$llanta12=$_POST['llanta12'];

    $ins="INSERT INTO `condiciones`(`id`, `contenedor_id`, `tipo_condicion`, `observacion`, `llanta1`, `llanta2`, `llanta3`, `llanta4`, `llanta5`, `llanta6`, `llanta7`, `llanta8`, `llanta9`, `llanta10`, `llanta11`, `llanta12`,`firma_entrada`) VALUES (null,'$cont','Entrada','$obs','$llanta1','$llanta2','$llanta3','$llanta4','$llanta5','$llanta6','$llanta7','$llanta8','$llanta9','$llanta10','$llanta11','$llanta12','$firma')";
$resin=mysqli_query($con,$ins);

} else {
    $ins="INSERT INTO `condiciones`(`id`, `contenedor_id`, `tipo_condicion`, `observacion`, `llanta1`, `llanta2`, `llanta3`, `llanta4`, `llanta5`, `llanta6`, `llanta7`, `llanta8`,`firma_entrada`) VALUES (null,'$cont','Entrada','$obs','$llanta1','$llanta2','$llanta3','$llanta4','$llanta5','$llanta6','$llanta7','$llanta8','$firma')";
$resin=mysqli_query($con,$ins);

}

if($resin){
    if($cliente=='MAERSK' && $_SESSION["rol"]=='Administrador'){
        echo "<script> 
    location.href='../Admin/ModuloContenedores/Maersk/inventarioMes.php'        
    </script>";
    }else{
        echo "<script> 
    location.href='../Admin/ModuloContenedores/Otros/inventarioMes.php'        
    </script>";
    }
}else{
    echo "Error al Ingresar Datos ERROR: Could not able to execute $resin. " . mysqli_error($con);
}
