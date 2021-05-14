<?php

require ('../fpdf/fpdf.php');
include '../conexion.php';
$idcon = $_REQUEST['conid'];

class PDF extends FPDF
{
    function Header()
    {
        include '../conexion.php';
        $idcon = $_REQUEST['conid'];

        $sql = "SET lc_time_names = 'es_HN';";
        $sql .= "SELECT cond.id as ide, con.id as conid,con.num_contenedor as container, con.chasis as chasis, con.placa_chasis as placa, `tipo_condicion`,DATE_FORMAT(con.fecha_salida,'%e / %M / %Y') as fecha,con.piloto_salida as piloto,con.placa_piloto_salida as placa_piloto,con.empresa_salida as empresa 
    from condiciones as cond 
    join contenedores as con on con.id=contenedor_id
    where contenedor_id = '$idcon' and tipo_condicion='Salida'";

        $this->Image('../CSS/IMG/image001.png', 10, 6, 60);
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(75);

        if (mysqli_multi_query($con, $sql)) {
            do {
                if ($result = mysqli_store_result($con)) {
                    while ($rowi = mysqli_fetch_array($result)) {
                        $this->Cell(45, 10, "Condicion de " . $rowi['tipo_condicion'], 0, 0, 'C');
                        $this->Cell(42);
                    }
                }
            } while (mysqli_next_result($con));
        }
    }
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'B', 10);

        $this->Cell(50, 10, "Firma Piloto", 'T', 0, 'C');
        $this->Cell(20);
        $this->Cell(50, 10, "Firma Condicionista", 'T', 0, 'C');
    }
}
$sql = "SELECT cond.id as ide, con.id as conid, llanta1,llanta2,llanta3,llanta4,llanta5,llanta6,llanta7,llanta8,llanta9,llanta10,llanta11,llanta12,firma_salida,cond.observacion
    from condiciones as cond 
    join contenedores as con on con.id=contenedor_id
    where contenedor_id = '$idcon' and tipo_condicion='Salida'";
$output = mysqli_query($con, $sql);
$rowi = mysqli_fetch_array($output);

$pdf = new PDF('P', 'mm', 'Letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 8);

$sql2 = "SET lc_time_names = 'es_HN';";
$sql2 .= "SELECT cond.id as ide, con.id as conid,con.num_contenedor as container, con.chasis as chasis, con.placa_chasis as placa, `tipo_condicion`,DATE_FORMAT(con.fecha_salida,'%e / %M / %Y') as fecha,con.piloto_salida as piloto,con.placa_piloto_salida as placa_piloto,con.empresa_salida as empresa, con.cliente as cliente 
    from condiciones as cond 
    join contenedores as con on con.id=contenedor_id
    where contenedor_id = '$idcon' and tipo_condicion='Salida'";

if (mysqli_multi_query($con, $sql2)) {
    do {
        if ($result = mysqli_store_result($con)) {
            while ($rowi2 = mysqli_fetch_array($result)) {
                $pdf->Cell(35, 0, "Fecha : " . $rowi2['fecha'], 0, 0);
                $pdf->Cell(50);
                $pdf->Ln(10);

                $pdf->Cell(170);
                $pdf->Cell(40, 0, "No. " . $rowi2['ide'], 0, 0);

                $pdf->Ln(16);
                $pdf->Cell(10);
                $pdf->Cell(50, 5, "Contenedor : " . $rowi2['container'], 1, 0);
                $pdf->Cell(70, 5, "Placa de Piloto : " . $rowi2['placa_piloto'], 1, 0);
                $pdf->Cell(50, 5, "Predio : Tegucigalpa", 1, 0);
                $pdf->Ln(5);

                $pdf->Cell(10);
                $pdf->Cell(50, 5, "Chasis : " . $rowi2['chasis'], 1, 0);
                $pdf->Cell(70, 5, "Nombre de Piloto : " . $rowi2['piloto'], 1, 0);
                $pdf->Cell(50, 5, "Ubicacion : HNTGLTM", 1, 0);
                $pdf->Ln(5);

                $pdf->Cell(10);
                $pdf->Cell(50, 5, "Placa : " . $rowi2['placa'], 1, 0);
                $pdf->Cell(70, 5, "Transporte : " . $rowi2['empresa'], 1, 0);
                $pdf->Cell(50, 5, "Cliente : ". $rowi2['cliente'], 1, 0);
                $pdf->Ln(10);
            }
        }
    } while (mysqli_next_result($con));
}

if ($rowi['llanta9'] == '' && $rowi['llanta10'] == '' && $rowi['llanta11'] == '' && $rowi['llanta12'] == '') {
    if ($rowi['firma_salida'] == null) {
        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 1", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta1'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 2", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta2'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 3", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta3'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 4", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta4'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 5", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta5'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 6", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta6'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 7", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta7'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 8", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta8'], 1, 'C');
        $pdf->Ln(45);

        $pdf->Cell(30, 10, "Observacion");
        $pdf->MultiCell(150, 5, $rowi['observacion'], 1);

        $pdf->Image('../CSS/IMG/chasis2.2.jpg', 10, 97, 190);
        $pdf->Image('../CSS/IMG/condicion.jpg', 10, 180, 190);
        $pdf->Image('../CSS/IMG/firma.jpg', 92, 243, 30);
    } else {
        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 1", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta1'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 2", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta2'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 3", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta3'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 4", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta4'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 5", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta5'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 6", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta6'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 7", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta7'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 8", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta8'], 1, 'C');
        $pdf->Ln(45);

        $pdf->Cell(30, 10, "Observacion");
        $pdf->MultiCell(150, 5, $rowi['observacion'], 1);

        $pdf->Image('../CSS/IMG/chasis2.2.jpg', 10, 97, 190);
        $pdf->Image('../CSS/IMG/condicion.jpg', 10, 180, 190);
        $pdf->Image('../CSS/IMG/firma.jpg', 92, 243, 30);
        $pdf->Image($rowi['firma_salida'], 15, 244, 50);
    }
} else {
    if ($rowi['firma_salida'] == null) {
        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 1", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta1'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 2", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta2'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 3", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta3'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 4", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta4'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 5", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta5'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 6", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta6'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 7", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta7'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 8", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta8'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 9", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta9'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 10", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta10'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 11", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta11'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 12", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta12'], 1, 'C');
        $pdf->Ln(40);

        $pdf->Cell(30, 10, "Observacion");
        $pdf->MultiCell(150, 5, $rowi['observacion'], 1);

        $pdf->Image('../CSS/IMG/chasis3.jpg', 10, 117, 190);
        $pdf->Image('../CSS/IMG/condicion.jpg', 10, 185, 190);
        $pdf->Image('../CSS/IMG/firma.jpg', 92, 243, 30);
    } else {
        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 1", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta1'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 2", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta2'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 3", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta3'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 4", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta4'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 5", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta5'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 6", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta6'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 7", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta7'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 8", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta8'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 9", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta9'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 10", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta10'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 11", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta11'], 1, 'C');

        $pdf->Cell(40);
        $pdf->Cell(20, 5, "Llanta 12", 1, 0, 'C');
        $pdf->MultiCell(100, 5, $rowi['llanta12'], 1, 'C');
        $pdf->Ln(40);

        $pdf->Cell(30, 10, "Observacion");
        $pdf->MultiCell(150, 5, $rowi['observacion'], 1);

        $pdf->Image('../CSS/IMG/chasis3.jpg', 10, 117, 190);
        $pdf->Image('../CSS/IMG/condicion.jpg', 10, 185, 190);
        $pdf->Image('../CSS/IMG/firma.jpg', 92, 243, 30);
        $pdf->Image($rowi['firma_salida'], 15, 244, 50);
    }
}
$pdf->Output('I','Condicion Salida.pdf');
