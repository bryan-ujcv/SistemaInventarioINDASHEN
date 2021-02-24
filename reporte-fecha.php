<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="CSS/IMG/image001.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Reporte por fecha</title>
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
        <a class="btn btn-danger" href="historialCompleto.php">Atras</a>
    </nav>
    <div class="container"><br><br>
        <form class="form-inline" method="POST" action="">
            <label>Fecha Desde:</label>
            <input type="date" class="form-control" placeholder="Start" name="date1" />
            <label>Hasta:</label>
            <input type="date" class="form-control" placeholder="End" name="date2" /><br>
            <button class="btn btn-primary" name="search">buscar</button> <a href="export-data-by-date.php" type="" class="btn btn-success">Reporte por Fecha</a><br><br>
        </form>
    </div><br><br>
    <div class="table-responsive">
        <table id="mytable" border="1" class="table table-bordered table-hover table-sm table-condensed">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Numero de Contenedor</th>
                    <th scope="col">Chasis</th>
                    <th scope="col">Genset</th>
                    <th scope="col">Tamaño</th>
                    <th scope="col">Fecha Ingreso</th>
                    <th scope="col">Piloto de Ingreso</th>
                    <th scope="col">Placa de Piloto de Ingreso</th>
                    <th scope="col">Empresa de Ingreso</th>
                    <th scope="col">Fecha de Salida</th>
                    <th scope="col">Booking de Salida</th>
                    <th scope="col">Piloto de Salida</th>
                    <th scope="col">Placa de Piloto de Salida</th>
                    <th scope="col">Empresa de Salida</th>
                    <th scope="col">Dias</th>
                </tr>
            </thead>
            <tbody>
                <?php include 'date-range.php'; ?>
            </tbody>
        </table>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>