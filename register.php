<?php
require_once "conexion.php";
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}

$query = "SELECT * FROM `roles`";
$result = mysqli_query($con, $query);

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $username_err = "Por Favor Ingrese un Usuario.";
    } else {
        $sql = "SELECT id FROM usuarios WHERE usuario = ?";

        if ($stmt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = trim($_POST["username"]);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "Este Usuario ya Existe.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Ocurrio algo imprevisto. Pruebe otra vez mas tarde";
            }
            mysqli_stmt_close($stmt);
        }
    }
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por Favor Ingrese una Contraseña.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "La Contraseña debe tener minimo 6 caracteres.";
    } else {
        $password = trim($_POST["password"]);
    }
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Por favor confirme la Contraseña.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Contraseñas distintas Verifique bien.";
        }
    }
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

        $new_user = $username;
        $new_pass = password_hash($password, PASSWORD_DEFAULT);
        $rol = $_POST['rol'];
        $sql = "INSERT INTO usuarios (usuario, contrasena, rol, estado) VALUES ('$new_user', '$new_pass', '$rol', 'Activo')";
        $resul = mysqli_query($con, $sql);
        if ($resul) {
            if ($_SESSION['rol'] == 'Administrador') {
                header("location: Admin/menuPrincipal.php");
            } else {
                header("location: Estandar/menuPrincipal.php");
            }
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
    <title>Registrar Usuario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="shortcut icon" href="CSS/IMG/image001.ico">
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
    <div class="">
        <div class="col-md-4">
            <img src="CSS/IMG/image001.png" class="img-fluid" alt="Responsive image">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <h5>Usuario Nuevo</h5>
                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                    <span class="help-block"><?php echo $username_err; ?></span>
                </div>
                <div class="form-group">
                    <h5>Rol del Usuario</h5>
                    <select type="text" class="form-control" id="rol" name="rol" placeholder="Rol de Usuario">
                        <option disabled value="" selected>Seleccionar una Opcion</option>
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <option value="<?php echo $row['rol'] ?>"><?php echo $row['rol']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <h5>Contraseña</h5>
                    <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                    <span class="help-block"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <h5>Confirmar Contraseña</h5>
                    <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Registrar">
                    <input type="reset" class="btn btn-default" value="Limpiar Campos">
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