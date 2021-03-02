<?php
include 'conexion.php';
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}
$query = "SELECT id, nombre from empresas";
$result = mysqli_query($con, $query);

$id = $_REQUEST['id'];
$sel = $con->query("SELECT * FROM contenedores WHERE id = '$id';");
if ($fila = $sel->fetch_assoc()) {
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="shortcut icon" href="CSS/IMG/image001.png">
    <title>Gate Out</title>
</head>

<body>
    <nav class="navbar sticky-top navbar-light justify-content-between" style="background-color: #e3f2fd;">
        <div>
            <a class="btn btn-danger" href="inventarioMes.php">Atras</a>
        </div>
    </nav>
    <div class="container">
        <img src="CSS/IMG/image001.png" class="img-fluid" alt="Responsive image">
        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <div class="row">
                <div class="col-md-3">
                    <h5>Numero del Contenedor</h5>
                    <input type="text" class="form-control" name="num_contenedor" placeholder="Numero del Contenedor" disabled value="<?php echo $fila['num_contenedor'] ?>"><br>
                </div>
                <div class="col-md-2">
                    <h5>Chasis</h5>
                    <input type="text" class="form-control" name="chasis" placeholder="Chasis" disabled value="<?php echo $fila['chasis'] ?>"><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <h5>Placa Chasis</h5>
                    <input type="text" class="form-control" name="placa_chasis" placeholder="Placa Chasis" disabled value="<?php echo $fila['placa_chasis'] ?>"><br>
                </div>
                <div class="col-md-2">
                    <h5>Piloto de Salida</h5>
                    <input type="text" id="pilotosal" class="form-control" name="piloto_salida" placeholder="Piloto de Salida"><br>
                </div>
                <div class="col-md-3">
                    <h5>Placa del Piloto de Salida</h5>
                    <input type="text" id="placasal" class="form-control" name="placa_piloto_salida" placeholder="Placa del Piloto de Salida"><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <h5>Empresa de Salida</h5>
                    <select type="text" id="empresasal" class="form-control" name="empresa_salida" placeholder="Empresa de Salida">
                        <option value="" disabled selected>Seleccionar una Opcion</option>
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                        ?>

                            <option value="<?php echo $row['nombre'] ?>"><?php echo $row['nombre']; ?></option>
                        <?php
                        }
                        ?>
                    </select><br>
                </div>
                <div class="col-md-2">
                    <h5>Booking</h5>
                    <input type="text" class="form-control" name="booking" placeholder="Booking"><br><br>
                </div>
            </div>
            <button type="submit" id="update" disabled class="btn btn-primary">Actualizar</button>
        </form>
    </div>
    <nav class="navbar fixed-bottom ">
        <div class="container-fluid">
            <h6 class="navbar-brand" href="#"><small>Desarrollado por Bryan Nuñez.</small></h6>
        </div>
    </nav>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/validacionesout.js"></script>
</body>

</html>