<?php include 'conexion.php';
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.css">
    <link rel="shortcut icon" href="CSS/IMG/image001.ico">
    <title>Menu</title>
</head>

<body>
    <div class="page-header">
        <h1>Bienvenido, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Sistema de Inventario INDASHEN Tegucigalpa.</h1>
        <a href="changePass.php" class="btn btn-info">Cambiar Contraseña</a><br><br><br>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <button type="button" class="btn btn-primary btn-lg" onclick="location.href='gate-in.php'">GATE-IN</button>
            </div>
            <div class="col-sm">
                <button class="btn btn-primary btn-lg" onclick="location.href='inventarioMes.php'">Inventario del Mes</button>
            </div>
            <div class="col-sm">
                <button class="btn btn-primary btn-lg" onclick="location.href='historialCompleto.php'">Historial completo</button>
            </div>
        </div>
    </div>
    <br><br><br><div class="page-footer">
       
    </div>
    <footer>
<p>
            <a href="logout.php" class="btn btn-danger">Cerrar Sesion</a>
            <a href="register.php" class="btn btn-info">Registrar Usuario</a>
        </p>
</footer>
    <script src='js/jquery.min.js'></script>
    <script src="JS/bootstrap.js"></script>
</body>

</html>