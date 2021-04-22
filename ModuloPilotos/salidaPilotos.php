<?php

include '../conexion.php';
$id = $_REQUEST['id'];

$sql = "select * from pilotos where id='$id'";
$result = mysqli_query($con,$sql);
$fila = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="../CSS/IMG/image001.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Salida de Piloto</title>
</head>

<body>

    <nav class="navbar sticky-top navbar-light justify-content-between" style="background-color: #e3f2fd;">
        <a class="btn btn-danger" href="pilotosDisponibles.php">Atras</a>
    </nav>
    <img src="../CSS/IMG/image001.png" class="img-fluid" alt="Responsive image">
    <div class="container">
        <form action="salidaPiloto.php" method="post">
            <div class="row">
                <div class="form-group col-md-3">
                    <input hidden type="text" name="id" value="<?php echo $fila['id']?>">
                    <h5>Nombre del Piloto</h5>
                    <input type="text" disabled class="form-control" id="piloto" name="piloto_ingreso" placeholder="Piloto de Ingreso" value="<?php echo $fila['nombre_piloto']?>"><br>
                </div>
                <div class="form-group col-md-3">
                    <h5>Placa del Piloto</h5>
                    <input type="text" disabled class="form-control" id="placapiloto" name="placa_piloto_ingreso" placeholder="Placa del Piloto de Ingreso" value="<?php echo $fila['placa_piloto']?>"><br>
                </div>
                <div class="form-group col-md-3">
                    <h5>Empresa</h5>
                    <input type="text" disabled class="form-control" id="empresaPiloto" name="empresaPiloto" placeholder="Empresa" value="<?php echo $fila['empresa_piloto']?>"><br>
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <h5>Fecha de Salida</h5>
                    <input class="form-control" type="date" name="fecha_salida" id="fecha_salida"><br>
                </div>
                <div class="form-group col-md-3">
                    <h5>Hora de salida</h5>
                    <input class="form-control" type="time" name="hora_salida" id="hora_salida">
                </div>
            </div>
            <button type="submit" id="btn" class="btn btn-primary">Guardar</button><br><br>
        </form>
    </div>
    <nav class="navbar fixed-bottom" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <h6 class="navbar-brand" href="#"><small>Desarrollado por Bryan Nuñez.</small></h6>
        </div>
    </nav>

</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>