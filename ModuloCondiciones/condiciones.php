<?php
include '../conexion.php';

$entrada = "SELECT cond.id as ide, con.num_contenedor as container, con.chasis as chasis, con.placa_chasis as placa, `tipo_condicion` from condiciones as cond join contenedores as con where contenedor_id = con.id ";
$input = mysqli_query($con, $entrada);

$salida = "SELECT cond.id as ide, con.num_contenedor as container, con.chasis as chasis, con.placa_chasis as placa, `tipo_condicion` from condiciones as cond join contenedores as con where contenedor_id = con.id and tipo_condicion='Salida'";
$output = mysqli_query($con, $salida);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="../CSS/IMG/image001.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Condiciones</title>

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
        <a class="btn btn-danger" href="../menuPrincipal.php">Atras</a>
        <img src="../CSS/IMG/image001.png" class="img-fluid" alt="Responsive image">
        <form method="post">
            <input type="submit" value="Exportar Condiciones" name="export" class="btn btn-success"></input>
        </form>
    </nav>
    <div class="table-responsive">
        <table id="mytable" class="table table-fixed table-bordered border-primary table-hover table-sm table-condensed">
            <thead>
                <tr>
                    <th class="bg-light" scope="col">ID</th>
                    <th class="bg-light" scope="col">Numero de Contenedor</th>
                    <th class="bg-light" scope="col">Chasis</th>
                    <th class="bg-light" scope="col">Placa Chasis</th>
                    <th class="bg-light" scope="col">Tipo de Condicion</th>
                    <th class="bg-light"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($fila = mysqli_fetch_array($input)) {
                ?>
                    <tr>
                        <td scope="row"><?php echo $fila['ide'] ?></td>
                        <td scope="row"><?php echo $fila['container'] ?></td>
                        <td scope="row"><?php echo $fila['chasis'] ?></td>
                        <td scope="row"><?php echo $fila['placa'] ?></td>
                        <td scope="row"><?php echo $fila['tipo_condicion'] ?></td>
                        <td scope="row"><a class="btn btn-primary" href="#">Imprimir</td>
                    </tr>
                <?php
                }
                ?>
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
<script src="../JS/table.js"></script>

</html>