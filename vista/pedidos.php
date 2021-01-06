<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
    <link rel="stylesheet" href="<?php echo urlsite;?>assets/alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="<?php echo urlsite;?>assets/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" href="<?php echo urlsite?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo urlsite?>assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo urlsite?>assets/bootstrap/css/all.css">
    <link rel="stylesheet" href="<?php echo urlsite?>vista/css/main.css">
    <link rel="stylesheet" href="<?php echo urlsite?>vista/css/pedidos.css" >
</head>
<body>
    <?php
        require('layout/menu2.php');
        require('layout/sider.php');
    ?>

    <div class="wrapper">

        <div><h3>Pedidos</h3></div>
        <div></div>
        <div><button class="btn btn-primary" data-toggle="modal" data-target="#new_order"> <i class="fa fa-plus mr-3"></i> Agregar</button></div>

        <div id="info"  >
            <table id="tbl-pedidos" class="table table-striped" style="text-align:center; ">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Descripcion</th>
                        <th>Cantidad</th>
                        <th>Observaciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($orders as $order):?>
                        <tr>
                            <td><?php echo $order['fecha'];?></td>
                            <td><?php echo $order['descripcion'];?></td>
                            <td><?php echo $order['cantidad'];?></td>
                            <td><?php echo $order['observaciones'];?></td>
                            <td>
                                <div class="dropdown dropdown-action" style="display:'.$display.'" >
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(68px, 27px, 0px);">
                                        <a class="dropdown-item" href="#" onclick="getOrder(<?php echo $order['id_pedidos']; ?>)" ><i class="fa fa-pencil-alt m-r-5"></i> Editar</a>
                                        <a class="dropdown-item" href="#" onclick="closeOrder(<?php echo $order['id_pedidos']; ?>)"><i class="fa fa-trash m-r-5"></i> Cerrar Pedido</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>

        <!--New Order-->
        <div class="modal fade bs-example-modal-lg-udp" tabindex="-1" id="new_order" role="dialog" aria-labelledby="search" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nuevo Pedido</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="newO">
                            <div class="form-group">
                                <label for="">Fecha</label>
                                <input type="date" name="fecha" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="">Articulos</label>
                                <select name="articulo" class="form-control">
                                    <option value="">Selecciona Articulo</option>
                                    <?php foreach($inventario as $inv):?>
                                        <option value="<?php echo $inv['id_inventario'];?>"><?php echo $inv['descripcion'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Cantidad</label>
                                <input type="text" name="cantidad" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Observaciones</label>
                                <textarea name="observaciones" id="" cols="30" rows="5" class="form-control"> </textarea>
                            </div>
                        </form>

                        <div class="text-right m-t-20">
                            <button type="button" class="btn btn-primary" onclick="newOrder()">Guardar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="event.preventDefault()">Close</button>
                        </div>

                    </div>

                </div>
            </div>
        </div>

         <!--Edit Order-->
         <div class="modal fade bs-example-modal-lg-udp" tabindex="-1" id="edit_order" role="dialog" aria-labelledby="search" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nuevo Pedido</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editO">
                            <input type="hidden" name="ref" id='ref'>   
                             <div class="form-group">
                                <label for="">Fecha</label>
                                <input type="date" name="fecha" id="editFecha" class="form-control" data-date-format="YYYY-MM-DD" >
                            </div>
                            <div class="form-group">
                                <label for="">Articulos</label>
                                <select name="articulo" class="form-control" id="editArticulo">
                                    <option value="">Selecciona Articulo</option>
                                    <?php foreach($inventario as $inv):?>
                                        <option value="<?php echo $inv['id_inventario'];?>"><?php echo $inv['descripcion'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Cantidad</label>
                                <input type="text" name="cantidad" class="form-control" id="editCantidad">
                            </div>
                            <div class="form-group">
                                <label for="">Observaciones</label>
                                <textarea name="observaciones" cols="30" rows="5" class="form-control" id="editObservaciones"> </textarea>
                            </div>
                        </form>

                        <div class="text-right m-t-20">
                            <button type="button" class="btn btn-primary" onclick="editOrder()">Guardar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="event.preventDefault()">Close</button>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>

    <script src="<?php echo urlsite;?>assets/alertifyjs/alertify.js"></script>
    <script src="<?php echo urlsite?>assets/bootstrap/js/jquery-3.3.1.js"></script>
    <script src="<?php echo urlsite?>assets/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo urlsite?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo urlsite;?>assets/bootstrap/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo urlsite;?>assets/bootstrap/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo urlsite?>vista/js/funciones.js"></script>
    <script src="<?php echo urlsite?>vista/js/pedidos.js"></script>
</body>
</html>