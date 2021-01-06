<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancela Venta</title>
    <link rel="stylesheet" href="<?php echo urlsite; ?>assets/alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="<?php echo urlsite; ?>assets/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" href="<?php echo urlsite; ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo urlsite; ?>assets/bootstrap/css/all.css" media="screen">
    <link rel="stylesheet" href="<?php echo urlsite; ?>vista/css/main.css">
    <link rel="stylesheet" href="<?php echo urlsite; ?>vista/css/cventas.css">
</head>
<body>
    <?php
        include('layout/menu2.php');
        include('layout/sider.php');
    ?>
    <div class="wrapper">
        <div id="box1"><h3>Cancela Ventas</h3></div>
        <div class="box">
            <div class="pl-5 pt-4" style="width:300px;">
                <label for="type">Buscar por</label>
                <select name="" id="type" class="form-control" >
                    <option value="fechas">Busqueda por Fecha</option>
                    <option value="tickets">Busqueda por # ticket</option>
                </select>
                <button class="btn btn-primary mt-2" style="margin-left:400px" onclick="change_type()">Continuar...</button>
            </div>
       </div>
       <div class="box">
            <div id="byDates" >
                <label >Busqueda por fecha</label>
                <div class="input-group">
                    <input type="date" name="" id="date-in" class="form-control mr-2" >
                    <input type="date" name="" id="date-end" class="form-control mr-2" >
                    <button class="btn btn-primary mr-2" onclick="searchByDate()"><i class="fa fa-search pr-3"></i>Buscar</button>
                </div>
            </div>
            <div id="ByNumber" >
                <label for="ticket" >Numero de ticket</label>
                 <div class="input-group">
                     <input type="text" id="ticket" class="form-control mr-2"   >                    
                     <button class="btn btn-primary" onclick="searchTicket()">Buscar</button>
                 </div>
            </div>
       </div>
        <div  class="box" id="box4">
            <table  id="table-ventasCancel" class="table table-striped">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Folio</th>
                        <th>Total</th>
                        <th>Tipo Venta</th>
                        <th width="80">Acciones</th>
                        <th width="80">Estado</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    
    </div>
    <script src="<?php echo urlsite; ?>assets/alertifyjs/alertify.js"></script>
    <script src="<?php echo urlsite; ?>assets/bootstrap/js/jquery-3.3.1.js"></script>
    <script src="<?php echo urlsite; ?>assets/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo urlsite; ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo urlsite; ?>assets/bootstrap/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo urlsite; ?>assets/bootstrap/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo urlsite; ?>vista/js/funciones.js"></script>
    <script src="<?php echo urlsite; ?>vista/js/cancelaVentas.js"></script>
    
</body>
</html>