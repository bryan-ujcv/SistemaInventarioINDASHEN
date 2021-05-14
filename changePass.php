<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}

require_once "conexion.php";

$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["new_password"]))) {
        $new_password_err = "Porfavor ingrese la nueva contrasena.";
    } elseif (strlen(trim($_POST["new_password"])) < 6) {
        $new_password_err = "la contrasena debe tener al menos 6 caracteres.";
    } else {
        $new_password = trim($_POST["new_password"]);
    }

    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Porfavor confirmar contrasena.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($new_password_err) && ($new_password != $confirm_password)) {
            $confirm_password_err = "Contrasenas no coinciden.";
        }
    }

    if (empty($new_password_err) && empty($confirm_password_err)) {
        $new_pass = password_hash($new_password, PASSWORD_DEFAULT);
        $user = $_SESSION["username"];
        $sql = "UPDATE usuarios SET contrasena = '$new_pass' WHERE usuario = '$user'";
        $resul = mysqli_query($con, $sql);

        if ($resul) {
            session_destroy();
            header("location: index.php");
            exit();
        } else {
            echo "Ocurrio algo imprevisto. Pruebe otra vez mas tarde.";
        }
    }
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cambio de Contraseña</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="shortcut icon" href="CSS/IMG/image001.ico">
    <style type="text/css">
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 350px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <nav class="navbar sticky-top navbar-light justify-content-between" style="background-color: #e3f2fd;">
        <div>
            <?php if ($_SESSION["rol"] == 'Administrador') { ?>
                <a class="btn btn-danger" href="Admin/menuPrincipal.php">Atras</a>
            <?php } else { ?>
                <a class="btn btn-danger" href="Estandar/menuPrincipal.php">Atras</a>
            <?php } ?>
        </div>
    </nav>
    <div class="container">
        <div class="col-sm-4 wrapper">
            <img src="CSS/IMG/image001.png" class="img-fluid" alt="Responsive image">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <h5>Usuario</h5>
                    <input type="text" class="form-control" disabled value="<?php echo $_SESSION['username'] ?>">
                </div>
                <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                    <h5>Nueva Contraseña</h5>
                    <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                    <span class="help-block"><?php echo $new_password_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <h5>Confirmar Contraseña</h5>
                    <input type="password" name="confirm_password" class="form-control">
                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Cambiar">
                </div>
            </form>
        </div>
    </div>
    <br><br><br>
    <nav class="navbar fixed-bottom" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <h6 class="navbar-brand" href="#"><small>Desarrollado por Bryan Nuñez.</small></h6>
        </div>
    </nav>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>