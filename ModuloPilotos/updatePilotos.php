<?php
include '../conexion.php';
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index.php");
    exit;
}

$id = $_REQUEST['id'];
$sel = $con->query("SELECT * FROM pilotos WHERE id = '$id';");
if ($fila = $sel->fetch_assoc()) {
}
$query = "SELECT * from empresas";
$result = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../CSS/IMG/image001.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Editar Piloto</title>
</head>

<body>
    <nav class="navbar sticky-top navbar-light justify-content-between" style="background-color: #e3f2fd;">
        <a class="btn btn-danger" href="pilotosDisponibles.php">Atras</a>
    </nav>
    <img src="../CSS/IMG/image001.png" class="img-fluid" alt="Responsive image">
    <div class="container">
        <form action="updPiloto.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <div class="row">
                <div class="form-group col-md-3">
                    <h5>Nombre del Piloto</h5>
                    <input type="text" class="form-control" id="piloto" name="piloto_ingreso" value="<?php echo $fila['nombre_piloto'] ?>" placeholder="Piloto de Ingreso"><br>
                </div>
                <div class="form-group col-md-3">
                    <h5>Placa del Piloto</h5>
                    <input type="text" class="form-control" id="placapiloto" value="<?php echo $fila['placa_piloto'] ?>" name="placa_piloto_ingreso" placeholder="Placa del Piloto de Ingreso"><br>
                </div>
                <div class="form-group col-md-3">
                    <h5>Empresa</h5>
                    <select type="text" class="form-control" id="empresa" name="empresa_piloto" placeholder="Empresa">
                        <option value="<?php echo $fila['empresa_piloto'] ?>" selected><?php echo $fila['empresa_piloto'] ?></option>
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                        ?>

                            <option value="<?php echo $row['nombre'] ?>"><?php echo $row['nombre']; ?></option>
                        <?php
                        }
                        ?>
                    </select><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <h5>Fecha de Ingreso</h5>
                    <input type="date" id="fecha_ingreso" class="form-control" name="fecha_ingreso" value="<?php echo $fila['fecha_ingreso'] ?>"><br>
                </div>
                <div class="col-md-3">
                    <h5>Hora de Ingreso</h5>
                    <input type="time" id="hora_ingreso" class="form-control" name="hora_ingreso" ><br>
                </div>
            </div>
            <button type="submit" id="btn" class="btn btn-primary">Guardar</button>
        </form>
    </div>
    <nav class="navbar fixed-bottom" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <h6 class="navbar-brand" href="#"><small>Desarrollado por Bryan Nuñez.</small></h6>
        </div>
    </nav>
    <script src="../JS/validacionPiloto.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>