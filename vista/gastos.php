
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gastos</title>
    <link rel="stylesheet" href="<?php echo urlsite;?>assets/alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="<?php echo urlsite;?>assets/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" href="<?php echo urlsite;?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo urlsite;?>assets/bootstrap/css/all.css" media="screen">
    <link rel="stylesheet" href="<?php echo urlsite;?>vista/css/main.css">
    <link rel="stylesheet" href="<?php echo urlsite;?>vista/css/gastos.css">
</head>

<body>
    <?php
    include('layout/menu2.php');
    include_once('layout/sider.php');
   
    ?>
    <div class="wrapper">
        <div class="box1">
            <h2>Gastos</h2>
        </div>
        <div class="box2"> <button class="btn btn-primary" data-toggle="modal" data-target="#AddExpense">+ Agregar Gastos</button> </div>
        <div class="box3">
            <div class="row">
                <div class="col col-sm-3">
                    <label for="date-in">Fecha de Inicio</label>
                    <input type="date" name="" id="date-in" class="form-control" required>
                </div>
                <div class="col col-sm-3">
                    <label for="date-out">Fecha Final</label>
                    <input type="date" name="" id="date-end" class="form-control" required>
                </div>
                <div class="col col-md-3">
                    <label for="cat">Nombre</label>
                    <select name="" id="cat" class="form-control">
                        <option value="0">-- Buscar Categoria --</option>
                        <?php
                        foreach ($categoria as $key) {
                            echo '<option value="' . $key['id_categoria'] . '">' . $key['descripcion'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col col-sm-1">
                    <button class="btn btn-success" style="margin-top:30px" onclick="searchBy()"><i class="fa fa-search" aria-hidden="true"></i></button>

                </div>
                <div class="col col-sm-2">
                    <button class="btn btn-info" style="margin-top:30px" onclick="window.location.reload()"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                </div>

            </div>
            <div style="position: relative; top: 15%; padding-left: 70px; text-align:center; ">
                <table class="table table-stripped" id="tbl-gastos" style="width:100%;">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Empleado</th>
                            <th>Categoria</th>
                            <th>Descripcion</th>
                            <th>Cantidad</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($expenses as $exp): ?>
                            <tr>
                                <td> <?php echo $exp['fecha']; ?>  </td>
                                <td> <?php echo $exp['empleado'] ?></td>
                                <td> <?php echo $exp['categoria'];?></td>
                                <td> <?php echo $exp['descripcion'];?></td>
                                <td> <?php echo $exp['cantidad'];?></td>
                                <td>
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(68px, 27px, 0px);">
                                        <a class="dropdown-item" href="#" onclick="getExpense(<?php echo $exp['id_gastos']; ?>);" ><i class="fa fa-pencil-alt m-r-5"></i> Editar</a>
                                        <a class="dropdown-item" href="#" onclick="deleteExpense(<?php echo $exp['id_gastos'];?>)"><i class="fa fa-trash m-r-5"></i> Eliminar</a>
                                    </div>
                                </div>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <div class="modal fade" id="AddExpense" role="dialog" aria-labelledby="search" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Gasto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="form-expense">
                        <div class="form-group">
                            <label for="date">Fecha</label>
                            <input type="datetime" name="fecha" id="date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="employe">Empleado</label>
                            <input type="hidden" name="id_empleado" value="<?php echo $userId; ?>">
                            <input type="text" id="employe" class="form-control" value="<?php echo $userName; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripcion</label>
                            <textarea name="descripcion" id="description"  cols="10" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="category">Categoria</label>
                            <select name="categoria" id="category" class="form-control" required>
                                <option value="">-- selecciona Categoria --</option>
                                <?php

                                foreach ($categoria as $key) {
                                    echo '<option value="' . $key['id_categoria'] . '">' . $key['descripcion'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Cantidad</label>
                            <input type="text" name="cantidad" id="quantity" class="form-control" required>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="saveExpense()">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg-udp" id="update_expences" role="dialog" aria-labelledby="search" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Gasto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="mod_form-expense">
                        <input type="hidden" name="ref" id="mod_ref">
                        <div class="form-group">
                            <label for="date">Fecha</label>
                            <input type="datetime" name="fecha" id="mod_date" class="form-control"  required>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripcion</label>
                            <textarea name="descripcion" id="mod_description" cols="10" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="category">Categoria</label>
                            <select name="categoria" id="mod_category" class="form-control" required>
                                <option value="0">-- selecciona Categoria --</option>
                                <?php

                                foreach ($categoria as $key) {
                                    echo '<option value="' . $key['id_categoria'] . '">' . $key['descripcion'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Cantidad</label>
                            <input type="text" name="cantidad" id="mod_cantidad" class="form-control" required>
                        </div>
                    </form>
                    <div class="text-right m-t-20">
                        <button type="button" class="btn btn-primary" onclick="updateExpense()">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="event.preventDefault()">Close</button>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <script src="<?php echo urlsite;?>assets/alertifyjs/alertify.js"></script>
    <script src="<?php echo urlsite;?>assets/bootstrap/js/jquery-3.3.1.js"></script>
    <script src="<?php echo urlsite;?>assets/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo urlsite;?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo urlsite;?>assets/bootstrap/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo urlsite;?>assets/bootstrap/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo urlsite;?>vista/js/funciones.js"></script>
    <script src="<?php echo urlsite;?>vista/js/gastos.js"></script>
</body>

</html>