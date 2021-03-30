<?php
include '../conexion.php';
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: index.php");
  exit;
}
include '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$query = "SET lc_time_names = 'es_HN';";
$query .= "SELECT `id`, `num_contenedor`, `chasis`, `placa_chasis`,DATE_FORMAT( `fecha_ingreso`,'%e/%M/%Y') as 'fecha_ingreso', `genset`, `tamano`, `ejes`, `observacion`, DATE_FORMAT(`hora_ingreso`,'%r') as 'hora_ingreso',`tipo_tamano` FROM `contenedores` WHERE `estado`='Activo';";

if (isset($_POST["export"])) {

  $file = new Spreadsheet();
  $Excel_writer = new Xlsx($file);

  $active_sheet = $file->getActiveSheet();
  $active_sheet->setTitle("Inventario Disponible");

  $styleArray = [
    'borders' => [
      'outline' => [
        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
        'color' => ['argb' => 'FF000015'],
      ],
    ],
  ];

  $active_sheet->getColumnDimension('A')->setAutoSize(true);
  $active_sheet->getColumnDimension('B')->setAutoSize(true);
  $active_sheet->getColumnDimension('C')->setAutoSize(true);
  $active_sheet->getColumnDimension('D')->setAutoSize(true);
  $active_sheet->getColumnDimension('E')->setAutoSize(true);
  $active_sheet->getColumnDimension('F')->setAutoSize(true);
  $active_sheet->getColumnDimension('G')->setAutoSize(true);
  $active_sheet->getColumnDimension('H')->setAutoSize(true);
  $active_sheet->getColumnDimension('I')->setAutoSize(true);

  $active_sheet->setCellValue('A1', 'ID');
  $active_sheet->setCellValue('B1', 'Numero de Contenedor');
  $active_sheet->setCellValue('C1', 'Chasis');
  $active_sheet->setCellValue('D1', 'Genset');
  $active_sheet->setCellValue('E1', 'Placa Chasis');
  $active_sheet->setCellValue('F1', 'Fecha de Ingreso');
  $active_sheet->setCellValue('G1', 'Tamaño');
  $active_sheet->setCellValue('H1', 'Ejes');
  $active_sheet->setCellValue('I1', 'Observacion');

  $count = 2;
  $x2 = 1;
  if (mysqli_multi_query($con, $query)) {
    do {
      if ($result = mysqli_store_result($con)) {
        while ($fila = mysqli_fetch_array($result)) {
          $active_sheet->setCellValue('A' . $count, $x2++);
          $active_sheet->setCellValue('B' . $count, $fila["num_contenedor"]);
          $active_sheet->setCellValue('C' . $count, $fila["chasis"]);
          $active_sheet->setCellValue('D' . $count, $fila["genset"]);
          $active_sheet->setCellValue('E' . $count, $fila["placa_chasis"]);
          $active_sheet->setCellValue('F' . $count, $fila["fecha_ingreso"]);
          $active_sheet->setCellValue('G' . $count, $fila["tamano"] . $fila["tipo_tamano"]);
          $active_sheet->setCellValue('H' . $count, $fila["ejes"]);
          $active_sheet->setCellValue('I' . $count, $fila["observacion"]);

          $active_sheet->getStyle("A$count")->applyFromArray($styleArray)->getAlignment()->setWrapText(true);
          $active_sheet->getStyle("B$count")->applyFromArray($styleArray)->getAlignment()->setWrapText(true);
          $active_sheet->getStyle("C$count")->applyFromArray($styleArray)->getAlignment()->setWrapText(true);
          $active_sheet->getStyle("D$count")->applyFromArray($styleArray)->getAlignment()->setWrapText(true);
          $active_sheet->getStyle("E$count")->applyFromArray($styleArray)->getAlignment()->setWrapText(true);
          $active_sheet->getStyle("F$count")->applyFromArray($styleArray)->getAlignment()->setWrapText(true);
          $active_sheet->getStyle("G$count")->applyFromArray($styleArray)->getAlignment()->setWrapText(true);
          $active_sheet->getStyle("H$count")->applyFromArray($styleArray)->getAlignment()->setWrapText(true);
          $active_sheet->getStyle("I$count")->applyFromArray($styleArray)->getAlignment()->setWrapText(true);

          $count = $count + 1;
        }
      }
    } while (mysqli_next_result($con));
  }

  $file_name = 'Inventario.xlsx';

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
  <link rel="shortcut icon" href="../CSS/IMG/image001.ico">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventario</title>
  <style type="text/css">
    thead tr th {
      position: sticky;
      top: 0;
      z-index: 10;
      background-color: #ffffff;
    }

    .table-responsive {
      height: 410px;
      overflow: scroll;
    }
  </style>
</head>

<body>
  <nav class="navbar sticky-top navbar-light justify-content-between" style="background-color: #e3f2fd;">
    <img src="../CSS/IMG/image001.png" class="img-fluid" alt="Responsive image">
    <a class="btn btn-danger" href="../menuPrincipal.php">Atras</a>
    <form method="post">
      <input type="submit" value="Exportar Inventario" name="export" class="btn btn-success"></input>
    </form>
    <form class="form-inline">
      <input class="form-control mr-sm-2" id="search" type="search" placeholder="Buscar" aria-label="Search">
    </form>
  </nav>

  <div class="table-responsive">
    <table id="mytable" class="table table-fixed table-bordered table-hover table-sm table-condensed">
      <thead>
        <tr>
          <th class="bg-light" scope="col">ID</th>
          <th class="bg-light" scope="col">Numero de Contenedor</th>
          <th class="bg-light" scope="col">Chasis</th>
          <th class="bg-light" scope="col">Genset</th>
          <th class="bg-light" scope="col">Placa Chasis</th>
          <th class="bg-light" scope="col">Fecha Ingreso</th>
          <th class="bg-light" scope="col">Hora Ingreso</th>
          <th class="bg-light" scope="col">Tamaño</th>
          <th class="bg-light" scope="col">Tipo</th>
          <th class="bg-light" scope="col">Ejes</th>
          <th class="bg-light" scope="col">Observacion</th>
          <th class="bg-light" scope="col"></th>
        </tr>
      </thead>
      <tbody><?php
              $x = 1;
              if (mysqli_multi_query($con, $query)) {
                do {
                  if ($result = mysqli_store_result($con)) {
                    while ($fila = mysqli_fetch_array($result)) {
              ?>
                <tr>
                  <th scope="row"><?php echo $x++ ?></th>
                  <td scope="row"><a href="gate-out.php?id=<?php echo $fila['id'] ?>"><?php echo $fila['num_contenedor'] ?></a></td>
                  <td scope="row"><?php echo $fila['chasis'] ?></td>
                  <td scope="row"><?php echo $fila['genset'] ?></td>
                  <td scope="row"><?php echo $fila['placa_chasis'] ?></td>
                  <td scope="row"><?php echo $fila['fecha_ingreso'] ?></td>
                  <td scope="row"><?php echo $fila['hora_ingreso'] ?></td>
                  <td scope="row"><?php echo $fila['tamano'] ?></td>
                  <td scope="row"><?php echo $fila['tipo_tamano'] ?></td>
                  <td scope="row"><?php echo $fila['ejes'] ?></td>
                  <td scope="row"><?php echo $fila['observacion'] ?></td>
                  <td scope="row"><a class="btn btn-primary" href="updateObservacion.php?id=<?php echo $fila['id'] ?>">Editar Registro</td>
                </tr>
        <?php }
                  }
                } while (mysqli_next_result($con));
              } ?>
      </tbody>
    </table>
  </div>
  <nav class="navbar " style="background-color: #e3f2fd;">
    <div class="container-fluid">
      <h6 class="navbar-brand" href="#"><small>Desarrollado por Bryan Nuñez.</small></h6>
    </div>
  </nav>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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