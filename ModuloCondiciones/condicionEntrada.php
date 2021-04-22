<?php

include '../conexion.php';
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index.php");
    exit;
}
$LC = "SELECT id, ejes FROM contenedores ORDER BY id DESC LIMIT 1";
$resultID = mysqli_query($con, $LC);
$row = mysqli_fetch_array($resultID);
$id = $row['id'];
$eje=$row['ejes'];

$sel = "select * from contenedores where id='$id'";
$result = mysqli_query($con, $sel);
$rowi = mysqli_fetch_array($result);

$id = $rowi['id'];
$num = $rowi['num_contenedor'];
$cha = $rowi['chasis'];
$placha = $rowi['placa_chasis'];
$piloto = $rowi['piloto_ingreso'];
$plapi = $rowi['placa_piloto_ingreso'];
$empresa = $rowi['empresa_ingreso'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Condicion de Entrada</title>
    <link rel="shortcut icon" href="../CSS/IMG/image001.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar sticky-top navbar-light justify-content-between" style="background-color: #e3f2fd;">
        <img src="../CSS/IMG/image001.png" class="img-fluid" alt="Responsive image">
    </nav>
    <form action="input.php" method="post">
        <div class="row">
            <div class="col-md-3">
                <input type="text" hidden name="id" value="<?php echo $id ?>">
                <h5>Numero del Contenedor</h5>
                <input type="text" disabled class="form-control" id="num" name="num_contenedor" placeholder="Numero del Contenedor" value="<?php echo $num ?>"><br>
            </div>
            <div class="form-group col-md-3">
                <h5>Chasis</h5>
                <input type="text" disabled class="form-control" id="chasis" name="chasis" value="<?php echo $cha ?>" placeholder="Chasis"><br>
            </div>
            <div class="form-group col-md-2">
                <h5>Placa Chasis</h5>
                <input value="<?php echo $placha ?>" disabled type="text" class="form-control" id="placa" name="placa_chasis" placeholder="Placa Chasis"><br>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <h5>Piloto de Ingreso</h5>
                <input type="text" value="<?php echo $piloto ?>" disabled class="form-control" id="piloto" name="piloto_ingreso" placeholder="Piloto de Ingreso"><br>
            </div>
            <div class="form-group col-md-3">
                <h5>Placa del Piloto de Ingreso</h5>
                <input type="text" class="form-control" disabled value="<?php echo $plapi ?>" id="placapiloto" name="placa_piloto_ingreso" placeholder="Placa del Piloto de Ingreso"><br>
            </div>
            <div class="col-md-3">
                <h5>Empresa de Ingreso</h5>
                <input type="text" class="form-control" id="empresa" disabled value="<?php echo $empresa ?>" name="empresa" placeholder="Empresa de Ingreso"><br>
            </div>
        </div>
        <h5>Llantas</h5><br>
        <?php if ($eje==3) {?>
            <div class="row">
            <div class="form-group col-md-3">
                <h5>Llanta #1</h5>
                <input type="text" class="form-control" id="llanta1" name="llanta1" placeholder="llanta1"><br>
            </div>
            <div class="form-group col-md-3">
                <h5>Llanta #2</h5>
                <input type="text" class="form-control" id="llanta2" name="llanta2" placeholder="llanta2"><br>
            </div>
            <div class="form-group col-md-3">
                <h5>Llanta #3</h5>
                <input type="text" class="form-control" id="llanta3" name="llanta3" placeholder="llanta3"><br>
            </div>
            <div class="form-group col-md-3">
                <h5>Llanta #4</h5>
                <input type="text" class="form-control" id="llanta4" name="llanta4" placeholder="llanta4"><br>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <h5>Llanta #5</h5>
                <input type="text" class="form-control" id="llanta5" name="llanta5" placeholder="llanta5"><br>
            </div>
            <div class="form-group col-md-3">
                <h5>Llanta #6</h5>
                <input type="text" class="form-control" id="llanta6" name="llanta6" placeholder="llanta6"><br>
            </div>
            <div class="form-group col-md-3">
                <h5>Llanta #7</h5>
                <input type="text" class="form-control" id="llanta7" name="llanta7" placeholder="llanta7"><br>
            </div>
            <div class="form-group col-md-3">
                <h5>Llanta #8</h5>
                <input type="text" class="form-control" id="llanta8" name="llanta8" placeholder="llanta8"><br>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <h5>Llanta #9</h5>
                <input type="text" class="form-control" id="llanta9" name="llanta9" placeholder="llanta9"><br>
            </div>
            <div class="form-group col-md-3">
                <h5>Llanta #10</h5>
                <input type="text" class="form-control" id="llanta10" name="llanta10" placeholder="llanta10"><br>
            </div>
            <div class="form-group col-md-3">
                <h5>Llanta #11</h5>
                <input type="text" class="form-control" id="llanta11" name="llanta11" placeholder="llanta11"><br>
            </div>
            <div class="form-group col-md-3">
                <h5>Llanta #12</h5>
                <input type="text" class="form-control" id="llanta12" name="llanta12" placeholder="llanta12"><br>
            </div>
        </div>
        <?php } else { ?>
            <div class="row">
            <div class="form-group col-md-3">
                <h5>Llanta #1</h5>
                <input type="text" class="form-control" id="llanta1" name="llanta1" placeholder="llanta1"><br>
            </div>
            <div class="form-group col-md-3">
                <h5>Llanta #2</h5>
                <input type="text" class="form-control" id="llanta2" name="llanta2" placeholder="llanta2"><br>
            </div>
            <div class="form-group col-md-3">
                <h5>Llanta #3</h5>
                <input type="text" class="form-control" id="llanta3" name="llanta3" placeholder="llanta3"><br>
            </div>
            <div class="form-group col-md-3">
                <h5>Llanta #4</h5>
                <input type="text" class="form-control" id="llanta4" name="llanta4" placeholder="llanta4"><br>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <h5>Llanta #5</h5>
                <input type="text" class="form-control" id="llanta5" name="llanta5" placeholder="llanta5"><br>
            </div>
            <div class="form-group col-md-3">
                <h5>Llanta #6</h5>
                <input type="text" class="form-control" id="llanta6" name="llanta6" placeholder="llanta6"><br>
            </div>
            <div class="form-group col-md-3">
                <h5>Llanta #7</h5>
                <input type="text" class="form-control" id="llanta7" name="llanta7" placeholder="llanta7"><br>
            </div>
            <div class="form-group col-md-3">
                <h5>Llanta #8</h5>
                <input type="text" class="form-control" id="llanta8" name="llanta8" placeholder="llanta8"><br>
            </div>
        </div>
        <?php }  ?>
        
        <div class="row">
            <div class="form-group col-md">
                <h5>Observaciones Generales</h5>
                <textarea name="observacion" id="observacion" cols="90" rows="5"></textarea>
            </div>
        </div>
        <button type="submit" id="btn" class="btn btn-primary">Guardar</button><br><br>
    </form>

    <nav class="navbar fixed-bottom" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <h6 class="navbar-brand" href="#"><small>Desarrollado por Bryan Nuñez.</small></h6>
        </div>
    </nav>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.23/datatables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.23/datatables.min.js"></script>

</html>