<?php
require '../conexion.php';
include '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$connect = new PDO("mysql:host=localhost;dbname=indashen", "root", "");
$date1 = date("Y-m-d", strtotime($_POST['date1']));
$date2 = date("Y-m-d", strtotime($_POST['date2']));

$query2 = "SELECT `id`, `num_contenedor`, `chasis`, `placa_chasis`, DATE_FORMAT(`fecha_ingreso`,'%e/%M/%Y','es_HN') as 'fecha_ingreso', `piloto_ingreso`, `placa_piloto_ingreso`, `empresa_ingreso`, DATE_FORMAT(`fecha_salida`,'%e/%M/%Y','es_HN') as 'fecha_salida', `piloto_salida`, `placa_piloto_salida`, `empresa_salida`, `dias`, `genset`, `booking`, `tamano`, `ejes`, `observacion`, DATE_FORMAT(`hora_ingreso`,'%r','es_HN') as 'hora_ingreso', DATE_FORMAT(`hora_salida`,'%r','es_HN') as 'hora_salida' FROM `contenedores` WHERE `fecha_salida` BETWEEN '$date1' AND '$date2'";

$statement2 = $connect->prepare($query2);
$statement2->execute();
$result2 = $statement2->fetchAll();

if (isset($_POST["date-repo"])) {

  $file = new Spreadsheet();
  $Excel_writer = new Xlsx($file);

  $active_sheet = $file->getActiveSheet();
  $active_sheet->setTitle("$date1 hasta $date2");

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
  $active_sheet->getColumnDimension('J')->setAutoSize(true);
  $active_sheet->getColumnDimension('K')->setAutoSize(true);
  $active_sheet->getColumnDimension('L')->setAutoSize(true);
  $active_sheet->getColumnDimension('M')->setAutoSize(true);
  $active_sheet->getColumnDimension('N')->setAutoSize(true);
  $active_sheet->getColumnDimension('O')->setAutoSize(true);

  $active_sheet->getStyle('A1:O1')->applyFromArray($styleArray)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

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
  $x2 = 1;

  foreach ($result2 as $fila) {
    $active_sheet->setCellValue('A' . $count, $x2++);
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

    $active_sheet->getStyle("A$count")->applyFromArray($styleArray)->getAlignment()->setWrapText(true);
    $active_sheet->getStyle("B$count")->applyFromArray($styleArray)->getAlignment()->setWrapText(true);
    $active_sheet->getStyle("C$count")->applyFromArray($styleArray)->getAlignment()->setWrapText(true);
    $active_sheet->getStyle("D$count")->applyFromArray($styleArray)->getAlignment()->setWrapText(true);
    $active_sheet->getStyle("E$count")->applyFromArray($styleArray)->getAlignment()->setWrapText(true);
    $active_sheet->getStyle("F$count")->applyFromArray($styleArray)->getAlignment()->setWrapText(true);
    $active_sheet->getStyle("G$count")->applyFromArray($styleArray)->getAlignment()->setWrapText(true);
    $active_sheet->getStyle("H$count")->applyFromArray($styleArray)->getAlignment()->setWrapText(true);
    $active_sheet->getStyle("I$count")->applyFromArray($styleArray)->getAlignment()->setWrapText(true);
    $active_sheet->getStyle("J$count")->applyFromArray($styleArray)->getAlignment()->setWrapText(true);
    $active_sheet->getStyle("K$count")->applyFromArray($styleArray)->getAlignment()->setWrapText(true);
    $active_sheet->getStyle("L$count")->applyFromArray($styleArray)->getAlignment()->setWrapText(true);
    $active_sheet->getStyle("M$count")->applyFromArray($styleArray)->getAlignment()->setWrapText(true);
    $active_sheet->getStyle("N$count")->applyFromArray($styleArray)->getAlignment()->setWrapText(true);
    $active_sheet->getStyle("O$count")->applyFromArray($styleArray)->getAlignment()->setWrapText(true);
    $count = $count + 1;
  }
  $file_name = 'Historial desde ' . $date1 . ' hasta ' . $date2 . '.xlsx';

  $Excel_writer->save($file_name);

  header('Content-Type: application/x-www-form-urlencoded');

  header('Content-Transfer-Encoding: Binary');

  header("Content-disposition: attachment; filename=\"" . $file_name . "\"");

  readfile($file_name);

  unlink($file_name);

  exit;
}
