<?php
include 'conexion.php';
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
$query = "SELECT id, nombre from empresas";
$result = mysqli_query($con, $query);

$id = $_REQUEST['id'];
$sel = $con->query("SELECT * FROM contenedores WHERE id = '$id';");
if ($fila = $sel->fetch_assoc()) {}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.css">
    <link rel="shortcut icon" href="CSS/IMG/image001.png">
    <title>Gate Out</title>
</head>

<body>
    <form action="update.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id ?>">
        <h5>Numero del Contenedor</h5>
        <input type="text" name="num_contenedor" placeholder="Numero del Contenedor" disabled value="<?php echo $fila['num_contenedor'] ?>"><br>
        <h5>Chasis</h5>
        <input type="text" name="chasis" placeholder="Chasis" disabled value="<?php echo $fila['chasis'] ?>"><br>
        <h5>Placa Chasis</h5>
        <input type="text" name="placa_chasis" placeholder="Placa Chasis" disabled value="<?php echo $fila['placa_chasis'] ?>"><br>
        <h5>Piloto de Salida</h5>
        <input type="text" name="piloto_salida" placeholder="Piloto de Salida"><br>
        <h5>Placa del Piloto de Salida</h5>
        <input type="text" name="placa_piloto_salida" placeholder="Placa del Piloto de Salida"><br>
        <h5>Empresa de Salida</h5>
        <select type="text" name="empresa_salida" placeholder="Empresa de Salida">
            <?php
            while ($row = mysqli_fetch_array($result)) {
            ?>

                <option value="<?php echo $row['nombre'] ?>"><?php echo $row['nombre']; ?></option>
            <?php
            }
            ?>
        </select><br>
        <h5>Booking</h5>
        <input type="text" name="booking" placeholder="Booking"><br><br>
        <input type="submit" value="Actualizar">
    </form>

    <script src='js/jquery.min.js'></script>
    <script src="JS/bootstrap.js"></script>
</body>

</html>