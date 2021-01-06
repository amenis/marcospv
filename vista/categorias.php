<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
    <link rel="stylesheet" href="<?php echo urlsite; ?>assets/alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="<?php echo urlsite; ?>assets/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" href="<?php echo urlsite; ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo urlsite; ?>assets/bootstrap/css/all.css" media="screen">
    <link rel="stylesheet" href="<?php echo urlsite; ?>vista/css/main.css">
    <link rel="stylesheet" href="<?php echo urlsite; ?>vista/css/categorias.css">
</head>

<body>
    <?php
    include('layout/menu2.php');
    include('layout/sider.php');
    ?>

    <div class="wrapper">

        <div> <h3>Categorias</h3> </div>
        <div></div>
        <div> <button class="btn btn-primary" data-toggle="modal" data-target="#new_cat" class="pl-3" ><i class="fa fa-plus mr-3"></i>Agregar</button></div>

        <div id="box2">
            <table class="table table-striped" id="tbl-cat" style="text-align: center;">
                <thead>
                    <tr>
                        <th>Descripcion</th>
                        <th>Grupo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($categorias as $cat):
                    ?>
                        <tr>
                            <td><?php echo $cat['descripcion']?></td>
                            <td><?php echo $cat['grupo']?></td>
                            <td>
                                <div class="dropdown dropdown-action" style="display:'.$display.'" >
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(68px, 27px, 0px);">
                                        <a class="dropdown-item" href="#" onclick="getData(<?php echo $cat['id_categoria'] ;?>)" ><i class="fa fa-pencil-alt m-r-5"></i> Editar</a>
                                        <a class="dropdown-item" href="#" onclick="baja(<?php echo $cat['id_categoria'] ;?>)"><i class="fa fa-trash m-r-5"></i> Eliminar</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach;?>
                </tbody>
            </table>
        </div>

          <!-- new -->
          <div class="modal fade bs-example-modal-lg-udp" tabindex="-1" id="new_cat" role="dialog" aria-labelledby="search" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alta de Articulos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="newC">
                            <div class="form-group">
                                <label for="">Descripción</label>
                                <input type="text" name="descripcion" class="form-control">
                            </div>
                                                     
                            <div class="form-group">
                                <label for="">Grupo</label>
                                <select name="grupo" class="form-control">
                                    <option>Seleccione Grupo</option>
                                    <?php
                                        foreach($grupos as $g):
                                    ?>
                                        <option value="<?php echo $g['id_grupo'];?>"><?php echo $g['descripcion'];?></option>                                       
                                    <?php endforeach;?>
                                </select>
                            </div>                            
                        </form>

                        <div class="text-right m-t-20">
                            <button type="button" class="btn btn-primary" onclick="newCategory()">Guardar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="event.preventDefault()">Close</button>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        
        <!-- update -->
        <div class="modal fade bs-example-modal-lg-udp" tabindex="-1" id="update_cat" role="dialog" aria-labelledby="search" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Actualizar Categorias</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="updateC">
                            <input type="hidden" name="ref" id="mod_ref">
                            <div class="form-group">
                                <label for="">Descripción</label>
                                <input type="text" id="mod_descripcion" name="descripcion" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="">Grupo</label>
                                <select name="grupo" id="mod_group" class="form-control">
                                    <option>Seleccione Grupo</option>
                                    <?php
                                        foreach($grupos as $g):
                                    ?>
                                        <option value="<?php echo $g['id_grupo']?>"><?php echo $g['descripcion']?></option>                                       
                                    <?php endforeach;?>
                                </select>
                            </div>
                            
                        </form>

                        <div class="text-right m-t-20">
                            <button type="button" class="btn btn-primary" id="btn-update" onclick="update()">Actualizar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="event.preventDefault()">Close</button>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>

    <script src="<?php echo urlsite; ?>assets/alertifyjs/alertify.js"></script>
    <script src="<?php echo urlsite; ?>assets/bootstrap/js/jquery-3.3.1.js"></script>
    <script src="<?php echo urlsite; ?>assets/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo urlsite; ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo urlsite; ?>assets/bootstrap/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo urlsite; ?>assets/bootstrap/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo urlsite; ?>vista/js/categorias.js"></script>
    <script src="<?php echo urlsite; ?>vista/js/funciones.js"></script>
</body>

</html>