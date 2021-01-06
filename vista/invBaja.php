<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventarios</title>
    <link rel="stylesheet" href="<?php echo urlsite;?>assets/alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="<?php echo urlsite;?>assets/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" href="<?php echo urlsite?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo urlsite?>assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo urlsite?>assets/bootstrap/css/all.css">
    <link rel="stylesheet" href="<?php echo urlsite?>vista/css/main.css">
    <link rel="stylesheet" href="<?php echo urlsite?>vista/css/inventarios.css">
</head>
<body>
    <?php
    include_once('layout/menu2.php');
    include_once('layout/sider.php');
   
    ?>

    <div class="wrapper">
       
        <div><h2 >Inventarios </h2> </div>
        <div></div>
        <div> </div>
           
        
        <div id="box2" >
            <table id="tbl-storage" class="table table-striped" style="text-align:center;">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Costo</th>
                        <th>Categoria</th>
                        <th>Proveedor</th>
                        <th>Operaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($inventario as $a):
                    ?>
                        <tr>
                            <td><?php echo $a['codigo'];?></td>
                            <td><?php echo $a['descripcion'];?></td>
                            <td><?php echo $a['precio'];?></td>
                            <td><?php echo $a['costo']?></td>
                            <td><?php echo $a['nombre_categoria']?></td>
                            <td><?php echo $a['nombre_proveedor']?></td>
                            <td>
                                <div class="dropdown dropdown-action" style="display:'.$display.'" >
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(68px, 27px, 0px);">
                                       <a class="dropdown-item" href="#" onclick="restore(<?php echo $a['id_inventario']; ?>)"><i class="fa fa-reply-all m-r-5"></i> Restarurar</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php
                        endforeach;
                    ?>
                </tbody>
            </table>
        </div>
     

    </div>

    <script src="<?php echo urlsite;?>assets/alertifyjs/alertify.js"></script>
    <script src="<?php echo urlsite?>assets/bootstrap/js/jquery-3.3.1.js"></script>
    <script src="<?php echo urlsite?>assets/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo urlsite?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo urlsite;?>assets/bootstrap/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo urlsite;?>assets/bootstrap/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo urlsite?>vista/js/funciones.js"></script>
    <script src="<?php echo urlsite?>vista/js/inventarios.js"></script>
</body>
</html>