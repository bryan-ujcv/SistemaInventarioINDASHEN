<?php
include '../conexion.php';
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index.php");
    exit;
}
$id = $_REQUEST['id'];

$sel = "select * from contenedores where id='$id'";
$result = mysqli_query($con, $sel);
$rowi = mysqli_fetch_array($result);

$sel = "select * from condiciones where contenedor_id='$id'";
$res = mysqli_query($con, $sel);
$row = mysqli_fetch_array($res);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Condicion de Salida</title>
    <link rel="shortcut icon" href="../CSS/IMG/image001.ico">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript" src="../JS/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="../JS/jquery.signature.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../CSS/jquery.signature.css">

    <style>
        .kbw-signature {
            width: 400px;
            height: 200px;
        }

        #sig canvas {
            width: 100% !important;
            height: auto;
        }
    </style>

</head>

<body>
    <nav class="navbar sticky-top navbar-light justify-content-between" style="background-color: #e3f2fd;">
        <img src="../CSS/IMG/image001.png" class="img-fluid" alt="Responsive image">
    </nav>
    <form action="output.php" method="post">
        <div class="row">
            <div class="col-md-3">
                <input type="text" hidden name="id" value="<?php echo $rowi['id'] ?>">
                <h5>Numero del Contenedor</h5>
                <input type="text" disabled class="form-control" id="num" name="num_contenedor" placeholder="Numero del Contenedor" value="<?php echo $rowi['num_contenedor'] ?>"><br>
            </div>
            <div class="form-group col-md-3">
                <h5>Chasis</h5>
                <input type="text" disabled class="form-control" id="chasis" name="chasis" value="<?php echo $rowi['chasis'] ?>" placeholder="Chasis"><br>
            </div>
            <div class="form-group col-md-2">
                <h5>Placa Chasis</h5>
                <input disabled value="<?php echo $rowi['placa_chasis'] ?>" type="text" class="form-control" id="placa" name="placa_chasis" placeholder="Placa Chasis"><br>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <h5>Piloto de Salida</h5>
                <input type="text" disabled value="<?php echo $rowi['piloto_salida'] ?>" class="form-control" id="piloto" name="piloto_ingreso" placeholder="Piloto de Ingreso"><br>
            </div>
            <div class="form-group col-md-3">
                <h5>Placa del Piloto de Salida</h5>
                <input type="text" disabled class="form-control" value="<?php echo $rowi['placa_piloto_salida'] ?>" id="placapiloto" name="placa_piloto_ingreso" placeholder="Placa del Piloto de Ingreso"><br>
            </div>
            <div class="col-md-3">
                <h5>Empresa de Salida</h5>
                <input type="text" disabled class="form-control" id="empresa" value="<?php echo $rowi['empresa_salida'] ?>" name="empresa" placeholder="Empresa de Ingreso"><br>
            </div>
        </div>
        <h5>Llantas</h5><br>
        <?php if ($rowi['ejes'] == 3) { ?>
            <div class="row">
                <div class="form-group col-md-3">
                    <h5>Llanta #1</h5>
                    <input type="text" class="form-control" id="llanta1" name="llanta1" placeholder="llanta1" value="<?php echo $row['llanta1'] ?>"><br>
                </div>
                <div class="form-group col-md-3">
                    <h5>Llanta #2</h5>
                    <input type="text" class="form-control" value="<?php echo $row['llanta2'] ?>" id="llanta2" name="llanta2" placeholder="llanta2"><br>
                </div>
                <div class="form-group col-md-3">
                    <h5>Llanta #3</h5>
                    <input type="text" class="form-control" id="llanta3" name="llanta3" value="<?php echo $row['llanta3'] ?>" placeholder="llanta3"><br>
                </div>
                <div class="form-group col-md-3">
                    <h5>Llanta #4</h5>
                    <input value="<?php echo $row['llanta4'] ?>" type="text" class="form-control" id="llanta4" name="llanta4" placeholder="llanta4"><br>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <h5>Llanta #5</h5>
                    <input type="text" class="form-control" value="<?php echo $row['llanta5'] ?>" id="llanta5" name="llanta5" placeholder="llanta5"><br>
                </div>
                <div class="form-group col-md-3">
                    <h5>Llanta #6</h5>
                    <input type="text" class="form-control" id="llanta6" name="llanta6" value="<?php echo $row['llanta6'] ?>" placeholder="llanta6"><br>
                </div>
                <div class="form-group col-md-3">
                    <h5>Llanta #7</h5>
                    <input type="text" value="<?php echo $row['llanta7'] ?>" class="form-control" id="llanta7" name="llanta7" placeholder="llanta7"><br>
                </div>
                <div class="form-group col-md-3">
                    <h5>Llanta #8</h5>
                    <input type="text" class="form-control" id="llanta8" value="<?php echo $row['llanta8'] ?>" name="llanta8" placeholder="llanta8"><br>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <h5>Llanta #9</h5>
                    <input type="text" class="form-control" id="llanta9" name="llanta9" value="<?php echo $row['llanta9'] ?>" placeholder="llanta9"><br>
                </div>
                <div class="form-group col-md-3">
                    <h5>Llanta #10</h5>
                    <input value="<?php echo $row['llanta10'] ?>" type="text" class="form-control" id="llanta10" name="llanta10" placeholder="llanta10"><br>
                </div>
                <div class="form-group col-md-3">
                    <h5>Llanta #11</h5>
                    <input type="text" class="form-control" value="<?php echo $row['llanta11'] ?>" id="llanta11" name="llanta11" placeholder="llanta11"><br>
                </div>
                <div class="form-group col-md-3">
                    <h5>Llanta #12</h5>
                    <input type="text" class="form-control" id="llanta12" name="llanta12" value="<?php echo $row['llanta12'] ?>" placeholder="llanta12"><br>
                </div>
            </div>
        <?php } else { ?>
            <div class="row">
                <div class="form-group col-md-3">
                    <h5>Llanta #1</h5>
                    <input type="text" class="form-control" id="llanta1" name="llanta1" value="<?php echo $row['llanta1'] ?>" placeholder="llanta1"><br>
                </div>
                <div class="form-group col-md-3">
                    <h5>Llanta #2</h5>
                    <input type="text" class="form-control" value="<?php echo $row['llanta2'] ?>" id="llanta2" name="llanta2" placeholder="llanta2"><br>
                </div>
                <div class="form-group col-md-3">
                    <h5>Llanta #3</h5>
                    <input value="<?php echo $row['llanta3'] ?>" type="text" class="form-control" id="llanta3" name="llanta3" placeholder="llanta3"><br>
                </div>
                <div class="form-group col-md-3">
                    <h5>Llanta #4</h5>
                    <input type="text" class="form-control" id="llanta4" name="llanta4" value="<?php echo $row['llanta4'] ?>" placeholder="llanta4"><br>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <h5>Llanta #5</h5>
                    <input type="text" class="form-control" value="<?php echo $row['llanta5'] ?>" id="llanta5" name="llanta5" placeholder="llanta5"><br>
                </div>
                <div class="form-group col-md-3">
                    <h5>Llanta #6</h5>
                    <input value="<?php echo $row['llanta6'] ?>" type="text" class="form-control" id="llanta6" name="llanta6" placeholder="llanta6"><br>
                </div>
                <div class="form-group col-md-3">
                    <h5>Llanta #7</h5>
                    <input type="text" class="form-control" id="llanta7" name="llanta7" value="<?php echo $row['llanta7'] ?>" placeholder="llanta7"><br>
                </div>
                <div class="form-group col-md-3">
                    <h5>Llanta #8</h5>
                    <input type="text" class="form-control" id="llanta8" value="<?php echo $row['llanta8'] ?>" name="llanta8" placeholder="llanta8"><br>
                </div>
            </div>
        <?php }  ?>

        <div class="row">
            <div class="form-group col-md">
                <h5>Observaciones Generales</h5>
                <textarea name="observacion" id="observacion" cols="90" rows="5"><?php echo $row['observacion'] ?></textarea>
            </div>
            <div class="form-group col-md">
                <h5>Firma:</h5>
                <div id="sig"></div>
                <br />
                <button id="clear">Limpiar Firma</button>
                <textarea id="signature64" name="signed" style="display: none"></textarea>
            </div>
        </div>
        <button type="submit" id="btn" class="btn btn-primary">Guardar</button>
    </form>
    <script type="text/javascript">
        var sig = $('#sig').signature({
            syncField: '#signature64',
            syncFormat: 'PNG'
        });
        $('#clear').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });
    </script>
    <br><br><br>
    <nav class="navbar fixed-bottom" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <h6 class="navbar-brand" href="#"><small>Desarrollado por Bryan Nuñez.</small></h6>
        </div>
    </nav>
</body>

</html>