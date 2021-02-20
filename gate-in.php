<?php
include 'conexion.php';
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}
$query = "SELECT * from empresas";
$result = mysqli_query($con, $query);

$query2 = "SELECT * FROM `tamaños`";
$result2 = mysqli_query($con, $query2);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gate In</title>
    <link rel="shortcut icon" href="CSS/IMG/image001.ico">
    <link rel="stylesheet" href="CSS/bootstrap.css">
</head>
<header>
    <nav class="navbar sticky-top navbar-light justify-content-between" style="background-color: #e3f2fd;">
        <div>
            <a class="btn btn-danger" href="menuPrincipal.php">Atras</a>
        </div>
    </nav>
</header>

<body>
<img src="CSS/IMG/image001.png" class="img-fluid" alt="Responsive image">
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
    
    <script src='js/jquery.min.js'></script>
    <script src="JS/bootstrap.js"></script>
    <script src="js/validaciones.js"></script>
</body>

</html>