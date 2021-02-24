<?php include 'conexion.php';
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: index.php");
  exit;
}
include 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$connect = new PDO("mysql:host=localhost;dbname=prueba_dashen", "root", "");


$query = "SELECT `id`, `num_contenedor`, `chasis`, `placa_chasis`,DATE_FORMAT(`fecha_ingreso`,'%e/%M/%Y','es_HN') as 'fecha_ingreso', `piloto_ingreso`, `placa_piloto_ingreso`, `empresa_ingreso`, DATE_FORMAT( `fecha_salida`,'%e/%M/%Y','es_HN') as 'fecha_salida', `piloto_salida`, `placa_piloto_salida`, `empresa_salida`, `dias`, `genset`, `booking`, `tamano`, `ejes`, `observacion`, DATE_FORMAT(`hora_ingreso`,'%r','es_HN') as 'hora_ingreso', DATE_FORMAT(`hora_salida`,'%r') as 'hora_salida' FROM `contenedores`";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

if (isset($_POST["export"])) {

  $file = new Spreadsheet();
  $Excel_writer = new Xlsx($file);

  $active_sheet = $file->getActiveSheet();
  $active_sheet->setTitle("Historial Completo");
  
  $active_sheet->setCellValue('A1', 'ID');
  $active_sheet->setCellValue('B1', 'Numero de Contenedor');
  $active_sheet->setCellValue('C1', 'Chasis');
  $active_sheet->setCellValue('D1', 'Genset');
  $active_sheet->setCellValue('E1', 'Tamaño');
  $active_sheet->setCellValue('F1', 'Fecha de Ingreso');
  $active_sheet->setCellValue('G1', 'Piloto de Ingreso');
  $active_sheet->setCellValue('H1', 'Placa de Piloto de Ingreso');
  $active_sheet->setCellValue('I1', 'Empresa de Ingreso');
  $active_sheet->setCellValue('J1', 'Fecha de Salida');
  $active_sheet->setCellValue('K1', 'Booking de Salida');
  $active_sheet->setCellValue('L1', 'Piloto de Salida');
  $active_sheet->setCellValue('M1', 'Placa de Piloto de Salida');
  $active_sheet->setCellValue('N1', 'Empresa de Salida');
  $active_sheet->setCellValue('O1', 'Dias');

  $count = 2;
  
  foreach ($result as $fila) {
    $active_sheet->setCellValue('A' . $count, $fila["id"]);
    $active_sheet->setCellValue('B' . $count, $fila["num_contenedor"]);
    $active_sheet->setCellValue('C' . $count, $fila["chasis"]);
    $active_sheet->setCellValue('D' . $count, $fila["genset"]);
    $active_sheet->setCellValue('E' . $count, $fila["tamano"]);
    $active_sheet->setCellValue('F' . $count, $fila["fecha_ingreso"]);
    $active_sheet->setCellValue('G' . $count, $fila["piloto_ingreso"]);
    $active_sheet->setCellValue('H' . $count, $fila["placa_piloto_ingreso"]);
    $active_sheet->setCellValue('I' . $count, $fila["empresa_ingreso"]);
    $active_sheet->setCellValue('J' . $count, $fila["fecha_salida"]);
    $active_sheet->setCellValue('K' . $count, $fila["booking"]);
    $active_sheet->setCellValue('L' . $count, $fila["piloto_salida"]);
    $active_sheet->setCellValue('M' . $count, $fila["placa_piloto_salida"]);
    $active_sheet->setCellValue('N' . $count, $fila["empresa_salida"]);
    $active_sheet->setCellValue('O' . $count, $fila["dias"]);

    $count = $count + 1;
  }

  $file_name = 'Historial Completo.xlsx';

  $Excel_writer->save($file_name);

  header('Content-Type: application/x-www-form-urlencoded');

  header('Content-Transfer-Encoding: Binary');

  header("Content-disposition: attachment; filename=\"" . $file_name . "\"");

  readfile($file_name);

  unlink($file_name);

  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="CSS/IMG/image001.ico">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Historial Completo</title>
  <style type="text/css"> 
        thead tr th { 
            position: sticky;
            top: 0;
            z-index: 10;
            background-color: #ffffff;
        }
    
        .table-responsive { 
            height:435px;
            overflow:scroll;
        }
    </style>
</head>

<body>
    <nav class="navbar sticky-top navbar-light justify-content-between" style="background-color: #e3f2fd;">
      <a class="btn btn-danger" href="menuPrincipal.php">Atras</a>
      <form method="post">
      <input type="submit" value="Exportar Historial Completo" name="export" class="btn btn-success"></input>
    </form>
      <a href="reporte-fecha.php" type="button" class="btn btn-success">Reporte por Fecha</a>
      <form class="form-inline" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <input class="form-control mr-sm-1" id="search" type="search" placeholder="Buscar" aria-label="Search">
      </form>
    </nav>
    <img src="CSS/IMG/image001.png" class="img-fluid" alt="Responsive image">
  <div class="table-responsive">
    <table id="mytable" class="table table-fixed table-bordered table-hover table-sm table-condensed">
      <thead>
        <tr>
          <th class="bg-light" scope="col">ID</th>
          <th class="bg-light" scope="col">Numero de Contenedor</th>
          <th class="bg-light" scope="col">Chasis</th>
          <th class="bg-light" scope="col">Genset</th>
          <th class="bg-light" scope="col">Tamaño</th>
          <th class="bg-success" scope="col">Fecha Ingreso</th>
          <th class="bg-success" scope="col">Piloto de Ingreso</th>
          <th class="bg-success" scope="col">Placa de Piloto de Ingreso</th>
          <th class="bg-success" scope="col">Empresa de Ingreso</th>
          <th class="bg-info" scope="col">Fecha de Salida</th>
          <th class="bg-info" scope="col">Booking de Salida</th>
          <th class="bg-info" scope="col">Piloto de Salida</th>
          <th class="bg-info" scope="col">Placa de Piloto de Salida</th>
          <th class="bg-info" scope="col">Empresa de Salida</th>
          <th class="bg-light" scope="col">Dias</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($result as $fila) {
        ?>
          <tr>
            <td scope="row"><?php echo $fila['id'] ?></td>
            <td scope="row"><?php echo $fila['num_contenedor'] ?></td>
            <td scope="row"><?php echo $fila['chasis'] ?></td>
            <td scope="row"><?php echo $fila['genset'] ?></td>
            <td scope="row"><?php echo $fila['tamano'] ?></td>
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
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
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
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>