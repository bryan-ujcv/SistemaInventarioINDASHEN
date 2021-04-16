<?php

require '../fpdf/fpdf.php';
include '../conexion.php';

$idcon = $_REQUEST['conid'];

class PDF extends FPDF
{
    function Header()
    {
        include '../conexion.php';
        $idcon = $_REQUEST['conid'];

        $sql = "SET lc_time_names = 'es_HN';";
        $sql .= "SELECT cond.id as ide, con.id as conid,con.num_contenedor as container, con.chasis as chasis, con.placa_chasis as placa, `tipo_condicion`,DATE_FORMAT(con.fecha_ingreso,'%e / %M / %Y') as fecha,con.piloto_ingreso as piloto,con.placa_piloto_ingreso as placa_piloto,con.empresa_ingreso as empresa 
    from condiciones as cond 
    join contenedores as con on con.id=contenedor_id
    where contenedor_id = '$idcon' and tipo_condicion='Entrada'";

        $this->Image('../CSS/IMG/image001.png', 10, 6, 60);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(75);

        if (mysqli_multi_query($con, $sql)) {
            do {
                if ($result = mysqli_store_result($con)) {
                    while ($rowi = mysqli_fetch_array($result)) {
                        $this->Cell(30, 10, "Condicion de " . $rowi['tipo_condicion'], 0, 0, 'C');
                        $this->Cell(50);

                        $this->Cell(30, 0, "Fecha : " . $rowi['fecha'], 0, 0);
                        $this->Cell(50);
                        $this->Ln(10);

                        $this->Cell(155);
                        $this->Cell(30, 0, "No. " . $rowi['ide'], 0, 0);
                        // Line break

                        $this->Ln(16);
                        $this->Cell(10);
                        $this->Cell(50, 5, "Num. Contenedor : " . $rowi['container'], 1, 0);
                        $this->Cell(70, 5, "Placa de Piloto : " . $rowi['placa_piloto'], 1, 0);
                        $this->Cell(50, 5, "Predio : Tegucigalpa", 1, 0);
                        $this->Ln(5);

                        $this->Cell(10);
                        $this->Cell(50, 5, "Num. Chasis : " . $rowi['chasis'], 1, 0);
                        $this->Cell(70, 5, "Nombre de Piloto : " . $rowi['piloto'], 1, 0);
                        $this->Cell(50, 5, "Ubicacion : HNTGLTM", 1, 0);
                        $this->Ln(5);

                        $this->Cell(10);
                        $this->Cell(50, 5, "Num. Placa : " . $rowi['placa'], 1, 0);
                        $this->Cell(70, 5, "Transporte : " . $rowi['empresa'], 1, 0);
                        $this->Cell(50, 5, "Cliente : Maersk", 1, 0);
                        $this->Ln(15);
                    }
                }
            } while (mysqli_next_result($con));
        }
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'B', 10);

        $this->Cell(50, 10, "Firma Piloto",'T',0,'C');
        $this->Cell(20);
        $this->Cell(50, 10, "Firma Condicionista",'T',0,'C');
    }
}
$sql = "SELECT cond.id as ide, con.id as conid, llanta1,llanta2,llanta3,llanta4,llanta5,llanta6,llanta7,llanta8,llanta9,llanta10,llanta11,llanta12,cond.observacion
    from condiciones as cond 
    join contenedores as con on con.id=contenedor_id
    where contenedor_id = '$idcon' and tipo_condicion='Entrada'";
$output = mysqli_query($con, $sql);
$rowi = mysqli_fetch_array($output);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 8);
if ($rowi['llanta9'] == '' && $rowi['llanta10'] == '' && $rowi['llanta11'] == '' && $rowi['llanta12'] == '') {

    $pdf->Cell(50);
    $pdf->Cell(30, 5, "Llanta 1", 1, 0, 'C');
    $pdf->MultiCell(60, 5, $rowi['llanta1'], 1, 'C');

    $pdf->Cell(50);
    $pdf->Cell(30, 5, "Llanta 2", 1, 0, 'C');
    $pdf->MultiCell(60, 5, $rowi['llanta2'], 1, 'C');

    $pdf->Cell(50);
    $pdf->Cell(30, 5, "Llanta 3", 1, 0, 'C');
    $pdf->MultiCell(60, 5, $rowi['llanta3'], 1, 'C');

    $pdf->Cell(50);
    $pdf->Cell(30, 5, "Llanta 4", 1, 0, 'C');
    $pdf->MultiCell(60, 5, $rowi['llanta4'], 1, 'C');

    $pdf->Cell(50);
    $pdf->Cell(30, 5, "Llanta 5", 1, 0, 'C');
    $pdf->MultiCell(60, 5, $rowi['llanta5'], 1, 'C');

    $pdf->Cell(50);
    $pdf->Cell(30, 5, "Llanta 6", 1, 0, 'C');
    $pdf->MultiCell(60, 5, $rowi['llanta6'], 1, 'C');

    $pdf->Cell(50);
    $pdf->Cell(30, 5, "Llanta 7", 1, 0, 'C');
    $pdf->MultiCell(60, 5, $rowi['llanta7'], 1, 'C');

    $pdf->Cell(50);
    $pdf->Cell(30, 5, "Llanta 8", 1, 0, 'C');
    $pdf->MultiCell(60, 5, $rowi['llanta8'], 1, 'C');
    $pdf->Ln(50);

    $pdf->Cell(30, 10, "Observacion");
    $pdf->MultiCell(150, 30, $rowi['observacion'], 1);

    $pdf->Image('../CSS/IMG/chasis2.2.jpg', 10, 105, 190);
    $pdf->Image('../CSS/IMG/condicion.jpg', 10, 200, 190);
} else {

    $pdf->Cell(50);
    $pdf->Cell(30, 5, "Llanta 1", 1, 0, 'C');
    $pdf->MultiCell(60, 5, $rowi['llanta1'], 1, 'C');

    $pdf->Cell(50);
    $pdf->Cell(30, 5, "Llanta 2", 1, 0, 'C');
    $pdf->MultiCell(60, 5, $rowi['llanta2'], 1, 'C');

    $pdf->Cell(50);
    $pdf->Cell(30, 5, "Llanta 3", 1, 0, 'C');
    $pdf->MultiCell(60, 5, $rowi['llanta3'], 1, 'C');

    $pdf->Cell(50);
    $pdf->Cell(30, 5, "Llanta 4", 1, 0, 'C');
    $pdf->MultiCell(60, 5, $rowi['llanta4'], 1, 'C');

    $pdf->Cell(50);
    $pdf->Cell(30, 5, "Llanta 5", 1, 0, 'C');
    $pdf->MultiCell(60, 5, $rowi['llanta5'], 1, 'C');

    $pdf->Cell(50);
    $pdf->Cell(30, 5, "Llanta 6", 1, 0, 'C');
    $pdf->MultiCell(60, 5, $rowi['llanta6'], 1, 'C');

    $pdf->Cell(50);
    $pdf->Cell(30, 5, "Llanta 7", 1, 0, 'C');
    $pdf->MultiCell(60, 5, $rowi['llanta7'], 1, 'C');

    $pdf->Cell(50);
    $pdf->Cell(30, 5, "Llanta 8", 1, 0, 'C');
    $pdf->MultiCell(60, 5, $rowi['llanta8'], 1, 'C');

    $pdf->Cell(50);
    $pdf->Cell(30, 5, "Llanta 9", 1, 0, 'C');
    $pdf->MultiCell(60, 5, $rowi['llanta9'], 1, 'C');

    $pdf->Cell(50);
    $pdf->Cell(30, 5, "Llanta 10", 1, 0, 'C');
    $pdf->MultiCell(60, 5, $rowi['llanta10'], 1, 'C');

    $pdf->Cell(50);
    $pdf->Cell(30, 5, "Llanta 11", 1, 0, 'C');
    $pdf->MultiCell(60, 5, $rowi['llanta11'], 1, 'C');

    $pdf->Cell(50);
    $pdf->Cell(30, 5, "Llanta 12", 1, 0, 'C');
    $pdf->MultiCell(60, 5, $rowi['llanta12'], 1, 'C');
    $pdf->Ln(50);

    $pdf->Cell(30, 10, "Observacion");
    $pdf->MultiCell(150, 30, $rowi['observacion'], 1);

    $pdf->Image('../CSS/IMG/chasis3.jpg', 10, 125, 190);
    $pdf->Image('../CSS/IMG/condicion.jpg', 10, 210, 190);
}
$pdf->Output();
