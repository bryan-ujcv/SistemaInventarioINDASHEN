<?php 
require '../conexion.php';
include '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$connect = new PDO("mysql:host=localhost;dbname=invent", "root", "");
$date1 = date("Y-m-d", strtotime($_POST['date1']));
$date2 = date("Y-m-d", strtotime($_POST['date2']));

$query2 = "SELECT `id`, `nombre_piloto`, `placa_piloto`, `empresa_piloto`, DATE_FORMAT( `fecha_ingreso`,'%e/%M/%Y','es_HN') as 'fecha_ingreso', DATE_FORMAT(`hora_ingreso`,'%r') as 'hora_ingreso', DATE_FORMAT( `fecha_salida`,'%e/%M/%Y','es_HN') as 'fecha_salida', DATE_FORMAT(`hora_salida`,'%r') as 'hora_salida', `dias`, `estado` FROM `pilotos` WHERE `fecha_salida` BETWEEN '$date1' AND '$date2'";

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
  $x=1;

  foreach ($result2 as $fila) {
    $active_sheet->setCellValue('A' . $count, $x++);
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
  $file_name = 'Historial Parqueo desde '.$date1.' hasta '.$date2.'.xlsx';

  $Excel_writer->save($file_name);

  header('Content-Type: application/x-www-form-urlencoded');

  header('Content-Transfer-Encoding: Binary');

  header("Content-disposition: attachment; filename=\"" . $file_name . "\"");

  readfile($file_name);

  unlink($file_name);

  exit;
}
?>