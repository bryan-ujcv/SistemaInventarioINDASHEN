<?php
include 'conexion.php';
session_start();

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="shortcut icon" href="CSS/IMG/image001.ico">
    <title>Menu Principal</title>

<body>
    <nav class="navbar sticky-top navbar-light justify-content-between" style="background-color: #e3f2fd;">
        <ul class="nav justify-content-end">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Contenedores
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="ModuloContenedores/inventarioMes.php">Inventario</a>
                    <a class="dropdown-item" href="ModuloContenedores/historialCompleto.php">Historial Completo</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="ModuloContenedores/gate-in.php">Gate - In</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Parqueo de Pilotos</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="ModuloPilotos/pilotosDisponibles.php">Pilotos en Predio</a>
                    <a class="dropdown-item" href="ModuloPilotos/historialCompletoPilotos.php">Historial Completo</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="ModuloPilotos/ingresoPilotos.php">Ingreso de Pilotos</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Condiciones
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="ModuloCondiciones/condiciones.php">Historial Condiciones</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="changePass.php">Cambiar Contraseña</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="register.php">Crear Usuario</a>
            </li>
        </ul>
        <a class="nav-link btn btn-danger " href="logout.php">Cerrar Sesion</a>
    </nav>
    <div class="container">
        <div class="col-sm-7">
            <div class="page-header">
                <h1>Sistema de Inventario INDASHEN Tegucigalpa.</h1>
                <h3>Bienvenido, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b> </h3>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <img src="CSS/IMG/image001.png" class="img-fluid" alt="Responsive image">
                    </div>
                </div>
            </div>
            <br><br><br>
        </div>
    </div>
    <nav class="navbar fixed-bottom " style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <h6 class="navbar-brand" href="#"><small>Desarrollado por Bryan Nuñez.</small></h6>
        </div>
    </nav>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>