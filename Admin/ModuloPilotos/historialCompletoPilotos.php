<?php
include '../../conexion.php';
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../../index.php");
    exit;
}

include '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$query = "SET lc_time_names = 'es_HN';";
$query .= "SELECT `id`, `nombre_piloto`, `placa_piloto`, `empresa_piloto`, DATE_FORMAT( `fecha_ingreso`,'%e/%M/%Y') as fecha_ingreso, DATE_FORMAT(`hora_ingreso`,'%r') as hora_ingreso, DATE_FORMAT( `fecha_salida`,'%e/%M/%Y') as fecha_salida, DATE_FORMAT(`hora_salida`,'%r') as hora_salida, `dias`, `estado` FROM `pilotos` ";

if (isset($_POST["export"])) {

    $file = new Spreadsheet();
    $Excel_writer = new Xlsx($file);

    $active_sheet = $file->getActiveSheet();
    $active_sheet->setTitle("Historial Parqueo");

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

    $active_sheet->getStyle('A1:I1')->applyFromArray($styleArray)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

    $active_sheet->setCellValue('A1', 'ID');
    $active_sheet->setCellValue('B1', 'Nombre del Piloto');
    $active_sheet->setCellValue('C1', 'Placa del Piloto');
    $active_sheet->setCellValue('D1', 'Empresa');
    $active_sheet->setCellValue('E1', 'Fecha de Ingreso');
    $active_sheet->setCellValue('F1', 'Hora de Ingreso');
    $active_sheet->setCellValue('G1', 'Fecha de Salida');
    $active_sheet->setCellValue('H1', 'Hora de Salida');
    $active_sheet->setCellValue('I1', 'Dias');

    $count = 2;

    if (mysqli_multi_query($con, $query)) {
        do {
            if ($result = mysqli_store_result($con)) {
                while ($fila = mysqli_fetch_array($result)) {
                    $active_sheet->setCellValue('A' . $count, $fila["id"]);
                    $active_sheet->setCellValue('B' . $count, $fila["nombre_piloto"]);
                    $active_sheet->setCellValue('C' . $count, $fila["placa_piloto"]);
                    $active_sheet->setCellValue('D' . $count, $fila["empresa_piloto"]);
                    $active_sheet->setCellValue('E' . $count, $fila["fecha_ingreso"]);
                    $active_sheet->setCellValue('F' . $count, $fila["hora_ingreso"]);
                    $active_sheet->setCellValue('G' . $count, $fila["fecha_salida"]);
                    $active_sheet->setCellValue('H' . $count, $fila["hora_salida"]);
                    $active_sheet->setCellValue('I' . $count, $fila["dias"]);

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

    $file_name = 'Historial Parqueo Completo.xlsx';

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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../CSS/IMG/image001.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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

    <title>Historial de Pilotos</title>
</head>

<body>
    <nav class="navbar sticky-top navbar-light justify-content-between" style="background-color: #e3f2fd;">
        <img src="../../CSS/IMG/image001.png" class="img-fluid" alt="Responsive image">
        <a class="btn btn-danger" href="../menuPrincipal.php">Atras</a>
        <form method="post">
            <input type="submit" value="Exportar Historial Completo" name="export" class="btn btn-success"></input>
        </form>
        <a href="#reporteFecha" role="button" class="btn btn-large btn-success" data-toggle="modal">Reporte por Fecha</a>
    </nav>

    <div id="reporteFecha" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="POST" action="date-range.php">
                        <label>Fecha Desde:</label>
                        <input type="date" class="form-control" placeholder="Start" name="date1" /><br><br>
                        <label>Hasta:</label>
                        <input type="date" class="form-control" placeholder="End" name="date2" /><br>
                        <input type="submit" name="date-repo" class="btn btn-success" value="Generar Reporte por Fecha"></input>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button><br><br>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table id="mytable" class="table table-fixed table-bordered table-hover table-sm table-condensed">
            <thead>
                <tr>
                    <th class="bg-light" scope="col">ID</th>
                    <th class="bg-light" scope="col">Nombre Piloto</th>
                    <th class="bg-light" scope="col">Placa Piloto</th>
                    <th class="bg-light" scope="col">Empresa Piloto</th>
                    <th class="bg-light" scope="col">Fecha Ingreso</th>
                    <th class="bg-light" scope="col">Hora Ingreso</th>
                    <th class="bg-light" scope="col">Fecha Salida</th>
                    <th class="bg-light" scope="col">Hora Salida</th>
                    <th class="bg-light" scope="col">Dias</th>
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
                                    <th scope="row"><?php echo $fila['id'] ?></th>
                                    <td scope="row"><?php echo $fila['nombre_piloto'] ?></td>
                                    <td scope="row"><?php echo $fila['placa_piloto'] ?></td>
                                    <td scope="row"><?php echo $fila['empresa_piloto'] ?></td>
                                    <td scope="row"><?php echo $fila['fecha_ingreso'] ?></td>
                                    <td scope="row"><?php echo $fila['hora_ingreso'] ?></td>
                                    <td scope="row"><?php echo $fila['fecha_salida'] ?></td>
                                    <td scope="row"><?php echo $fila['hora_salida'] ?></td>
                                    <td scope="row"><?php echo $fila['dias'] ?></td>
                                </tr>
                <?php }
                            }
                        } while (mysqli_next_result($con));
                    } ?>
            </tbody>
        </table>
    </div>
    <nav class="navbar fixed-bottom" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <h6 class="navbar-brand" href="#"><small>Desarrollado por Bryan Nuñez.</small></h6>
        </div>
    </nav>

</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.23/datatables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.23/datatables.min.js"></script>
<script src="../../JS/table.js"></script>

</html>