<?php
include '../conexion.php';
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index.php");
    exit;
}
$query = "SELECT * from empresas";
$result = mysqli_query($con, $query);

$query2 = "SELECT * FROM `tamaños`";
$result2 = mysqli_query($con, $query2);

$query3 = "SELECT * FROM `tipo_tamano`";
$result3 = mysqli_query($con, $query3);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gate In</title>
    <link rel="shortcut icon" href="../CSS/IMG/image001.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar sticky-top navbar-light justify-content-between" style="background-color: #e3f2fd;">
        <div>
            <a class="btn btn-danger" href="../menuPrincipal.php">Atras</a>
        </div>
    </nav>
    <img src="../CSS/IMG/image001.png" class="img-fluid" alt="Responsive image">
    <div class="container">
        <form action="guardar.php" method="post">
            <div class="row">
                <div class="col-md-3">
                    <h5>Numero del Contenedor</h5>
                    <input type="text" class="form-control" id="num" name="num_contenedor" placeholder="Numero del Contenedor"><br>
                </div>
                <div class="col-md-3">
                    <h5>Tamaño</h5>
                    <select type="text" class="form-control" id="size" name="tamano" placeholder="Tamaño del Contenedor">
                        <option disabled value="" selected>Seleccionar una Opcion</option>
                        <?php
                         while ($row = mysqli_fetch_array($result2)) {
                        ?>
                            <option value="<?php echo $row['nombre'] ?>"><?php echo $row['nombre']; ?></option>
                        <?php
                        }
                        ?>
                    </select><br>
                </div>
                <div class="col-md-3">
                    <h5>Tipo de Contenedor</h5>
                    <select type="text" class="form-control" id="sizeTipo" name="tipo" placeholder="Tipo del Contenedor">
                        <option disabled value="" selected>Seleccionar una Opcion</option>
                        <?php
                        while ($row = mysqli_fetch_array($result3)) {
                        ?>
                            <option value="<?php echo $row['tipo'] ?>"><?php echo $row['tipo']; ?></option>
                        <?php
                        }
                        ?>
                    </select><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <h5>Genset</h5>
                    <input type="text" class="form-control" id="genset" name="genset" placeholder="Genset"><br>
                </div>
                <div class="form-group col-md-3">
                    <h5>Chasis</h5>
                    <input type="text" class="form-control" id="chasis" name="chasis" placeholder="Chasis"><br>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-2">
                    <h5>Placa Chasis</h5>
                    <input type="text" class="form-control" id="placa" name="placa_chasis" placeholder="Placa Chasis"><br>
                </div>
                <div class="form-group col-md-3">
                    <h5>Piloto de Ingreso</h5>
                    <input type="text" class="form-control" id="piloto" name="piloto_ingreso" placeholder="Piloto de Ingreso"><br>
                </div>
                <div class="form-group col-md-3">
                    <h5>Placa del Piloto de Ingreso</h5>
                    <input type="text" class="form-control" id="placapiloto" name="placa_piloto_ingreso" placeholder="Placa del Piloto de Ingreso"><br>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <h5>Empresa de Ingreso</h5>
                    <select type="text" class="form-control" id="empresai" name="empresa_ingreso" placeholder="Empresa de Ingreso">
                        <option disabled value="" selected>Seleccionar una Opcion</option>
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                        ?>

                            <option value="<?php echo $row['nombre'] ?>"><?php echo $row['nombre']; ?></option>
                        <?php
                        }
                        ?>
                    </select><br>
                </div>
                <div class="form-group col-md-1">
                    <h5>Ejes</h5>
                    <input type="text" class="form-control" id="eje" name="ejes" placeholder="Ejes"><br>
                </div>
                <div class="form-group col-md-4">
                    <h5>Observacion</h5>
                    <input type="text" class="form-control" id="obs" name="observacion" placeholder="Observacion"><br>
                </div>
            </div>

            <button type="submit" id="btn" disabled class="btn btn-primary">Guardar</button>
        </form>
    </div>
    <nav class="navbar" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <h6 class="navbar-brand" href="#"><small>Desarrollado por Bryan Nuñez.</small></h6>
        </div>
    </nav>
    <script src="../JS/validaciones.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>