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

<body>
    <form action="guardar.php" method="post">
        <h5>Numero del Contenedor</h5>
        <input type="text" name="num_contenedor" placeholder="Numero del Contenedor"><br>
        <h5>Tamaño</h5>
        <select type="text" name="tamano" placeholder="Tamaño del Contenedor">
            <?php
            while ($row = mysqli_fetch_array($result2)) {
            ?>

                <option value="<?php echo $row['nombre'] ?>"><?php echo $row['nombre']; ?></option>
            <?php
            }
            ?>
        </select><br>
        <h5>Genset</h5>
        <input type="text" name="genset" placeholder="Genset"><br>
        <h5>Chasis</h5>
        <input type="text" name="chasis" placeholder="Chasis"><br>
        <h5>Placa Chasis</h5>
        <input type="text" name="placa_chasis" placeholder="Placa Chasis"><br>
        <h5>Piloto de Ingreso</h5>
        <input type="text" name="piloto_ingreso" placeholder="Piloto de Ingreso"><br>
        <h5>Placa del Piloto de Ingreso</h5>
        <input type="text" name="placa_piloto_ingreso" placeholder="Placa del Piloto de Ingreso"><br>
        <h5>Empresa de Ingreso</h5>
        <select type="text" name="empresa_ingreso" placeholder="Empresa de Ingreso">
            <?php
            while ($row = mysqli_fetch_array($result)) {
            ?>

                <option value="<?php echo $row['nombre'] ?>"><?php echo $row['nombre']; ?></option>
            <?php
            }
            ?>
        </select><br>
        <h5>Ejes</h5>
        <input type="text" name="ejes" placeholder="Ejes"><br>
        <h5>Observacion</h5>
        <input type="text" name="observacion" placeholder="Observacion"><br><br>
        <input type="submit" value="Guardar">
    </form>
    <script src='js/jquery.min.js'></script>
    <script src="JS/bootstrap.js"></script>
</body>

</html>