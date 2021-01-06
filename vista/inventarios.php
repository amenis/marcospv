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
       
        <div><h2 >Inventarios</h2> </div>
        <div></div>
        <div> <button class="btn btn-primary" data-toggle="modal" data-target="#new_product" class="pl-3"><i class="fa fa-plus mr-3"></i>Agregar</button> </div>
           
        
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
                                        <a class="dropdown-item" href="#" onclick="getProduct(<?php echo $a['id_inventario']; ?>)" ><i class="fa fa-pencil-alt m-r-5"></i> Editar</a>
                                        <?php if($_SESSION['permition']==='Administrador'):?>
                                        <a class="dropdown-item" href="#" onclick="unsubcribe(<?php echo $a['id_inventario']; ?>)"><i class="fa fa-trash m-r-5"></i> Eliminar</a>
                                        <?php endif;?>
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
        <!-- new -->
        <div class="modal fade bs-example-modal-lg-udp" tabindex="-1" id="new_product" role="dialog" aria-labelledby="search" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alta de Articulos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="newA">
                            <div class="form-group">
                                <label for="">Descripción</label>
                                <input type="text" name="descripcion" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Codigo</label>
                                <input type="text" name="codigo" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Precio</label>
                                <input type="text" name="precio" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Costo</label>
                                <input type="text" name="costo" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Stock min</label>
                                <input type="text" name="stockMin" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Stock max</label>
                                <input type="text" name="stockMax" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Existencia</label>
                                <input type="text" name="existencia" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Categoria</label>
                                <select name="categoria" class="form-control">
                                    <option>Seleccione Categoria</option>
                                    <?php
                                        foreach($categorias as $c):
                                    ?>
                                        
                                        <option value="<?php echo $c['id_categoria'];?>"><?php echo $c['descripcion'];?></option>
                                    <?php
                                        endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Proveedor</label>
                                <select name="proveedor"  class="form-control">
                                    <option>Seleccione Proveedor</option>
                                    <?php
                                        foreach($proveedores as $prove):
                                    ?>
                                       
                                        <option value="<?php echo $prove['id_proveedor'];?>"><?php echo $prove['nombre'];?></option>
                                    <?php
                                        endforeach;
                                    ?>
                                </select>
                            </div>
                        </form>

                        <div class="text-right m-t-20">
                            <button type="button" class="btn btn-primary" onclick="newProduct()">Guardar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="event.preventDefault()">Close</button>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        
        <!-- update -->
        <div class="modal fade bs-example-modal-lg-udp" tabindex="-1" id="update_product" role="dialog" aria-labelledby="search" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alta de Articulos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="update">
                            <div class="form-group">
                                <label for="">Descripción</label>
                                <input type="text" id="descripcion" name="descripcion" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Codigo</label>
                                <input type="text" id="codigo" name="codigo" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Precio</label>
                                <input type="text" id="precio" name="precio" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Costo</label>
                                <input type="text" id="costo" name="costo" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Stock min</label>
                                <input type="text" id="stMin" name="stockMin" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Stock max</label>
                                <input type="text" id="stMax" name="stockMax" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Existencia</label>
                                <input type="text" id="existencia" name="existencia" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Categoria</label>
                                <select name="categoria" id="categoria" class="form-control">
                                    <option>Seleccione Categoria</option>
                                    <?php
                                        foreach($categorias as $c):
                                    ?>
                                        
                                        <option value="<?php echo $c['id_categoria'];?>"><?php echo $c['descripcion'];?></option>
                                    <?php
                                        endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                 <label for="">Proveedor</label>
                                <select name="proveedor" id="proveedor" class="form-control">
                                    <option>Seleccione Categoria</option>
                                    <?php
                                        foreach($proveedores as $prove):
                                    ?>
                                       
                                        <option value="<?php echo $prove['id_proveedor'];?>"><?php echo $prove['nombre'];?></option>
                                    <?php
                                        endforeach;
                                    ?>
                                </select>
                            </div>
                        </form>

                        <div class="text-right m-t-20">
                            <button type="button" class="btn btn-primary" id="btn-update" disabled="<?php echo $d = $_SESSION['permition'] === 'Administrador'? 'true' : 'false'; ?>">Actualizar</button>
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
    <script src="<?php echo urlsite?>vista/js/inventarios.js"></script>
</body>
</html>