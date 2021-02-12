<?php 
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: menuPrincipal.php");
    exit;
}

require_once "conexion.php";

$username = $password = "";
$username_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["username"]))) {
        $username_err = "Por Favor Ingrese un Usuario.";
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Por Favor Ingrese una Contraseña.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($username_err) && empty($password_err)) {
      
        $sql = "SELECT id, usuario, contrasena FROM usuarios WHERE usuario = ?";

        if ($stmt = mysqli_prepare($con, $sql)) {
  
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = $username;

            if (mysqli_stmt_execute($stmt)) {

                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
             
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            header("location: menuPrincipal.php");
                        } else {
                            $password_err = "La Contraseña no es valida.";
                        }
                    }
                } else {
                    $username_err = "No existe ningun usuario con ese nombre.";
                }
            } else {
                echo "Ocurrio algo imprevisto. Pruebe otra vez mas tarde.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($con);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="CSS/IMG/image001.ico">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Login</title>
</head>

<body class="row m-0 bg-white justify-content-center align-items-center vh-100">
    <div class="col-sm-4">
        <img src="CSS/IMG/image001.png" class="img-fluid" alt="Responsive image">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Usuario</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span><br><br>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-lg" value="Iniciar Sesion">
            </div>
        </form>
    </div>
    <script src='js/jquery.min.js'></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>