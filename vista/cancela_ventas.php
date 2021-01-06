<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancelacion de Documentos</title>
    <link rel="stylesheet" href="../../../assets/alertifyjs/css/alertify.css">
	<link rel="stylesheet" href="../../../assets/alertifyjs/css/themes/default.css">
	<link rel="stylesheet" href="../../../assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../../assets/bootstrap/css/all.css" media="screen">
	<link rel="stylesheet" href="../../../assets/bootstrap/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="../../../assets/css/cventas.css">
	<link rel="stylesheet" href="../../../assets/css/main.css">
</head>
<body>
    <?php
        include('../../headers/menu2.php');
        include('../../siders/sider.php');
    ?>
    <div class="wrapper">
       <span id=box1>
           <h3>Cancelacion de tickets</h3>
       </span>
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
                     <input type="text" id="ticket" class="form-control"   >
                     <button class="btn btn-primary "><i class="fa fa-search pr-3"></i>Buscar</button>

                 </div>
            </div>
       </div>
       <div class="box" id="box4" >
           <table class="table table-stripped" id="table-ventasCancel" style="text-align:center">
               <thead>
                   <th>Fecha</th>
                   <th># Ticket</th>
                   <th>Monto</th>
                   <th>Status</th>
                   <th>Operacion</th>
               </thead>
               <tbody></tbody>
           </table>
       </div>
    </div>
   
    <script src="../../../assets/alertifyjs/alertify.js"></script>
	<script src="../../../assets/bootstrap/js/jquery-3.3.1.js"></script>
	<script src="../../../assets/bootstrap/js/popper.min.js"></script>
	<script src="../../../assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="../../../assets\alertifyjs\alertify.js"></script>
	<script src="../../../assets/bootstrap/js/bootstrap-select.min.js"></script>
	<script src="../../../assets/js/point_sales.js"></script>
	<script src="../../../assets/js/funciones.js"></script>
</body>
</html>