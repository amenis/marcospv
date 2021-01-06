<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="<?php echo urlsite; ?>assets/alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="<?php echo urlsite; ?>assets/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" href="<?php echo urlsite; ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo urlsite; ?>assets/bootstrap/css/all.css" media="screen">
    <link rel="stylesheet" href="<?php echo urlsite; ?>vista/css/main.css">
    <link rel="stylesheet" href="<?php echo urlsite; ?>vista/css/user.css">
</head>
<body>
    <?php
    include('layout/menu2.php');
    include('layout/sider.php');      
    ?>
    <div class="wrapper">
        <div id=box1>
            <h3>Perfil</h3>
        </div>
        <div id="box3">
            <form id="formPerfil" onsubmit="event.preventDefault()">
                <img style="position:absolute; right:15%; "src="<?php echo urlsite;?>assets/imagenes/user.png" alt="Perfil" width="210" height="210">
                
                <div class="input-group mt-3">
                    <label for="">Nombre:</label>
                    <input type="text" disabled value="<?php echo $empleados[0]['nombre'];?>" class="form-control" style="margin-left:75px;">
                </div>
                <div class="input-group mt-3">
                    <label for="">Apellidos:</label>
                    <input type="text" disabled value="<?php echo $empleados[0]['apellidos'];?>" class="form-control" style="margin-left:68px;">
                </div>
                <div class="input-group mt-3">
                    <label for="">Nombre Usuario:</label>
                    <input type="text" name="username" id="username" class="form-control ml-3" value="<?php echo $empleados[0]['usuario'];?>"/>
                </div>
                <div class="input-group mt-3">
                    <label for="">contraseña:</label>
                    <input type="password" name="password" id="password" class="form-control" style="margin-left:54px" value="<?php echo $empleados[0]['password'];?>"/>
                </div>
                <div class="btn-group" style="margin-top:30px;margin-left:85%;">
                    <button class="btn btn-primary" onclick="editarPerfil(<?php echo $empleados[0]['id_empleado'];?>)">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="<?php echo urlsite; ?>assets/alertifyjs/alertify.js"></script>
    <script src="<?php echo urlsite; ?>assets/bootstrap/js/jquery-3.3.1.js"></script>
    <script src="<?php echo urlsite; ?>assets/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo urlsite; ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo urlsite; ?>assets/bootstrap/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo urlsite; ?>assets/bootstrap/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo urlsite; ?>vista/js/funciones.js"></script>
    <script src="<?php echo urlsite; ?>vista/js/user.js"></script>
</body>
</html>