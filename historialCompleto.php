<?php include 'conexion.php';
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
  <link rel="shortcut icon" href="CSS/IMG/image001.ico">
  <link rel="stylesheet" href="CSS/bootstrap.css">
  <title>Historial Completo</title>
  <style type="text/css">
    tr th {
      position: sticky;
      top: 0;
      z-index: 10;
      background-color: #ffffff;
    }

    .table-responsive {
      height: 436px;
      overflow: scroll;
    }
  </style>
</head>

<body>
  <div>
    <nav class="navbar sticky-top navbar-light justify-content-between" style="background-color: #e3f2fd;">
      <a class="btn btn-danger" href="menuPrincipal.php">Atras</a>
      <button type="submit" id="export_data" name='export_data' value="Export to excel" class="btn btn-info">Export to excel</button>
      <form class="form-inline" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <input class="form-control mr-sm-1" id="search" type="search" placeholder="Buscar" aria-label="Search">
      </form>
    </nav>
    <img src="CSS/IMG/image001.png" class="img-fluid" alt="Responsive image">
  </div>
  <div class="table-responsive"">
    <table id=" mytable" class="table table-bordered table-hover table-sm table-condensed">
    <tr>
      <th class="bg-light" scope="col">ID</th>
      <th class="bg-light" scope="col">Numero de Contenedor</th>
      <th class="bg-light" scope="col">Chasis</th>
      <th class="bg-light" scope="col">Genset</th>
      <th class="bg-light" scope="col">Fecha Ingreso</th>
      <th class="bg-light" scope="col">Piloto de Ingreso</th>
      <th class="bg-light" scope="col">Placa de Piloto de Ingreso</th>
      <th class="bg-light" scope="col">Empresa de Ingreso</th>
      <th class="bg-light" scope="col">Fecha de Salida</th>
      <th class="bg-light" scope="col">Booking de Salida</th>
      <th class="bg-light" scope="col">Piloto de Salida</th>
      <th class="bg-light" scope="col">Placa de Piloto de Salida</th>
      <th class="bg-light" scope="col">Empresa de Salida</th>
      <th class="bg-light" scope="col">Dias</th>
      <th class="bg-light" scope="col">Tamaño</th>
    </tr>
    <?php
    $sel = $con->query("SELECT * FROM contenedores ");
    while ($fila = $sel->fetch_assoc()) {
    ?>
      <tr>
        <td scope="row"><?php echo $fila['id'] ?></td>
        <td scope="row"><?php echo $fila['num_contenedor'] ?></td>
        <td scope="row"><?php echo $fila['chasis'] ?></td>
        <td scope="row"><?php echo $fila['genset'] ?></td>
        <td scope="row"><?php echo $fila['fecha_ingreso'] ?></td>
        <td scope="row"><?php echo $fila['piloto_ingreso'] ?></td>
        <td scope="row"><?php echo $fila['placa_piloto_ingreso'] ?></td>
        <td scope="row"><?php echo $fila['empresa_ingreso'] ?></td>
        <td scope="row"><?php echo $fila['fecha_salida'] ?></td>
        <td scope="row"><?php echo $fila['booking'] ?></td>
        <td scope="row"><?php echo $fila['piloto_salida'] ?></td>
        <td scope="row"><?php echo $fila['placa_piloto_salida'] ?></td>
        <td scope="row"><?php echo $fila['empresa_salida'] ?></td>
        <td scope="row"><?php echo $fila['dias'] ?></td>
        <td scope="row"><?php echo $fila['tamano'] ?></td>
      </tr>
    <?php } ?>
    </table>
  </div>

  <script src='js/jquery.min.js'></script>
  <script src="JS/bootstrap.js"></script>
  <script>
    $(document).ready(function() {
      $("#search").keyup(function() {
        _this = this;
        $.each($("#mytable tbody tr"), function() {
          if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
            $(this).hide();
          else
            $(this).show();
        });
      });
    });
  </script>
</body>

</html>