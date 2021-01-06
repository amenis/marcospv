<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corte Caja</title>
    <link rel="stylesheet" href="<?php echo urlsite; ?>assets/alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="<?php echo urlsite; ?>assets/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" href="<?php echo urlsite; ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo urlsite; ?>assets/bootstrap/css/all.css" media="screen">
    <link rel="stylesheet" href="<?php echo urlsite; ?>vista/css/main.css">
    <link rel="stylesheet" href="<?php echo urlsite; ?>/vista/css/corteCaja.css">
    
</head>
<body>
    <?php
    include('layout/menu2.php');
    include('layout/sider.php');
    ?>
    <div class="wrapper">
        
        <div><h3>Corte Caja</h3></div>
        <div id="box-form">
            <form id="corte">
                <div class="input-group">
                    <label for="">Fecha Inicio</label>
                    <input type="date" name="facha_in" id="fecha_in" class="form-control ml-2 mb-3"> 
                </div>
                <div class="input-group">
                    <label for="">Fecha Final</label>
                    <input type="date" name="" id="fecha_end" class="form-control ml-2">
                </div>
            </form>

            <button class="btn btn-primary" onclick="generar()">Generar</button>
        </div>
        <button id="corte" style ="display:none"></button>
    </div>
    <script src="<?php echo urlsite; ?>assets/alertifyjs/alertify.js"></script>
    <script src="<?php echo urlsite; ?>assets/bootstrap/js/jquery-3.3.1.js"></script>
    <script src="<?php echo urlsite; ?>assets/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo urlsite; ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo urlsite; ?>assets/bootstrap/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo urlsite; ?>assets/bootstrap/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo urlsite;?>assets/bootstrap/js/printPage.js"></script>
    <script src="<?php echo urlsite; ?>vista/js/funciones.js"></script>
    <script src="<?php echo urlsite; ?>vista/js/corteCaja.js"></script>
</body>
</html>