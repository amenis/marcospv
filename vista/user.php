<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
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
        <div id="box1">
            <h3>Usuarios</h3>
        </div>
        <div id="box2">
            <button class="btn btn-primary" data-toggle="modal" data-target="#new_user"><i class="fa fa-plus mr-3"></i>Nuevo</button>
        </div>
        <div id="box3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>DOMICILIO</th>
                        <th>CIUDAD</th>
                        <th>ESTADO</th>
                        <th>TELEFONO</th>
                        <th>TIPO USUARIO</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($empleados as $e) : ?>
                        <tr>
                            <td>
                                <?php echo $e['id_empleado']; ?>
                            </td>
                            <td>
                                <?php echo $e['nombre'] . ' ' . $e['apellidos']; ?>
                            </td>
                            <td>
                                <?php echo $e['domicilio']; ?>
                            </td>
                            <td>
                                <?php echo $e['ciudad']; ?>
                            </td>
                            <td>
                                <?php echo $e['estado']; ?>
                            </td>
                            <td>
                                <?php echo $e['telefono']; ?>
                            </td>
                            <td>
                                <?php echo $e['tipo_usuario']; ?>
                            </td>
                            <td>
                                <div class="dropdown dropdown-action" style="display:'.$display.'">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(68px, 27px, 0px);">
                                        <a class="dropdown-item" href="#" onclick="getUser(<?php echo $e['id_empleado']; ?>)"><i class="fa fa-pencil-alt m-r-5"></i> Editar</a>
                                        <a class="dropdown-item" href="#" onclick="deleteUser(<?php echo $e['id_empleado']; ?>)"><i class="fa fa-trash m-r-5"></i> Eliminar</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

    <div class="modal fade bs-example-modal-lg-udp" tabindex="-1" id="new_user" role="dialog" aria-labelledby="search" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="newUser">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa Nombre del cliente">
                        </div>
                        <div class="form-group">
                            <label for="">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Ingresa apellidos del cliente">
                        </div>
                        <div class="form-group">
                            <label for="">domicilio</label>
                            <input type="text" class="form-control" id="domicilio" name="domicilio" placeholder="Ingresa el domicilio del cliente">
                        </div>
                        <div class="form-group">
                            <label for="">Ciudad</label>
                            <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ingresa la ciudad del cliente">
                        </div>
                        <div class="form-group">
                            <label for="">Estado</label>
                            <select name="estado" id="estado" class="form-control">
                                <option>-- Seleccione Estado --</option>
                                <option value="Aguascalientes">Aguascalientes</option>
                                <option value="Baja California">Baja California</option>
                                <option value="Baja California Sur">Baja California Sur</option>
                                <option value="Campeche">Campeche</option>
                                <option value="Chiapas">Chiapas</option>
                                <option value="Chihuahua">Chihuahua</option>
                                <option value="Coahuila de Zaragoza">Coahuila de Zaragoza</option>
                                <option value="Colima">Colima</option>
                                <option value="Durango">Durango</option>
                                <option value="Estado de Mexico">Estado de Mexico</option>
                                <option value="Guanajuato">Guanajuato</option>
                                <option value="Guerrero">Guerrero</option>
                                <option value="Hidalgo">Hidalgo</option>
                                <option value="Jalisco">Jalisco</option>
                                <option value="Michoacan de Ocampo">Michoacan de Ocampo</option>
                                <option value="Morelos">Morelos</option>
                                <option value="Nayarit">Nayarit</option>
                                <option value="Nuevo Leon">Nuevo Leon</option>
                                <option value="Oaxaca">Oaxaca</option>
                                <option value="Puebla">Puebla</option>
                                <option value="Queretaro">Queretaro</option>
                                <option value="Quintana Roo">Quintana Roo</option>
                                <option value="San Luis Potosi­">San Luis Potosi­</option>
                                <option value="Sinaloa">Sinaloa</option>
                                <option value="Sonora">Sonora</option>
                                <option value="Tabasco">Tabasco</option>
                                <option value="Tamaulipas">Tamaulipas</option>
                                <option value="Tlaxcala">Tlaxcala</option>
                                <option value="Veracruz">Veracruz</option>
                                <option value="Yucatan">Yucatan</option>
                                <option value="Zacatecas">Zacatecas</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Codigo Postal</label>
                            <input type="text" class="form-control" id="codigopostal" name="codigopostal" placeholder="Ingresa el Codigo Postal del cliente">
                        </div>
                        <div class="form-group">
                            <label for="">Telefono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ingresa tu Numero Telefonico">
                        </div>
                        <div class="form-group">
                            <label for="usuario">Usuario *</label>
                            <input type="text" class="form-control" id="usuario" name="userName" placeholder="Ingresa el nombre de usuario" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password *</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="tipoUser">Tipo</label>
                            <select name="tipoUser" id="tipoUser" class="form-control">
                                <option value="Administrador">Administrador</option>
                                <option value="Usuario">Usuario</option>
                            </select>
                        </div>
                    </form>

                    <div class="text-right m-t-20">
                        <button type="button" class="btn btn-primary" onclick="newUser()">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="newClient()">Close</button>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-lg-udp" tabindex="-1" id="edit_user" role="dialog" aria-labelledby="search" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editUser">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control" id="editnombre" name="nombre" placeholder="Ingresa Nombre del cliente">
                        </div>
                        <div class="form-group">
                            <label for="">Apellidos</label>
                            <input type="text" class="form-control" id="editapellidos" name="apellidos" placeholder="Ingresa apellidos del cliente">
                        </div>
                        <div class="form-group">
                            <label for="">domicilio</label>
                            <input type="text" class="form-control" id="editdomicilio" name="domicilio" placeholder="Ingresa el domicilio del cliente">
                        </div>
                        <div class="form-group">
                            <label for="">Ciudad</label>
                            <input type="text" class="form-control" id="editciudad" name="ciudad" placeholder="Ingresa la ciudad del cliente">
                        </div>
                        <div class="form-group">
                            <label for="">Estado</label>
                            <select name="estado" id="editestado" class="form-control">
                                <option>-- Seleccione Estado --</option>
                                <option value="Aguascalientes">Aguascalientes</option>
                                <option value="Baja California">Baja California</option>
                                <option value="Baja California Sur">Baja California Sur</option>
                                <option value="Campeche">Campeche</option>
                                <option value="Chiapas">Chiapas</option>
                                <option value="Chihuahua">Chihuahua</option>
                                <option value="Coahuila de Zaragoza">Coahuila de Zaragoza</option>
                                <option value="Colima">Colima</option>
                                <option value="Durango">Durango</option>
                                <option value="Estado de Mexico">Estado de Mexico</option>
                                <option value="Guanajuato">Guanajuato</option>
                                <option value="Guerrero">Guerrero</option>
                                <option value="Hidalgo">Hidalgo</option>
                                <option value="Jalisco">Jalisco</option>
                                <option value="Michoacan de Ocampo">Michoacan de Ocampo</option>
                                <option value="Morelos">Morelos</option>
                                <option value="Nayarit">Nayarit</option>
                                <option value="Nuevo Leon">Nuevo Leon</option>
                                <option value="Oaxaca">Oaxaca</option>
                                <option value="Puebla">Puebla</option>
                                <option value="Queretaro">Queretaro</option>
                                <option value="Quintana Roo">Quintana Roo</option>
                                <option value="San Luis Potosi­">San Luis Potosi­</option>
                                <option value="Sinaloa">Sinaloa</option>
                                <option value="Sonora">Sonora</option>
                                <option value="Tabasco">Tabasco</option>
                                <option value="Tamaulipas">Tamaulipas</option>
                                <option value="Tlaxcala">Tlaxcala</option>
                                <option value="Veracruz">Veracruz</option>
                                <option value="Yucatan">Yucatan</option>
                                <option value="Zacatecas">Zacatecas</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Codigo Postal</label>
                            <input type="text" class="form-control" id="editcodigopostal" name="codigopostal" placeholder="Ingresa el Codigo Postal del cliente">
                        </div>
                        <div class="form-group">
                            <label for="">Telefono</label>
                            <input type="text" class="form-control" id="edittelefono" name="telefono" placeholder="Ingresa tu Numero Telefonico">
                        </div>
                        <div class="form-group">
                            <label for="usuario">Usuario *</label>
                            <input type="text" class="form-control" id="editusuario" name="userName" placeholder="Ingresa el nombre de usuario" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password *</label>
                            <input type="password" class="form-control" id="editpassword" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="edittipoUser">Tipo</label>
                            <select name="tipoUser" id="edittipoUser" class="form-control">
                                <option value="Administrador">Administrador</option>
                                <option value="Usuario">Usuario</option>
                            </select>
                        </div>
                    </form>

                    <div class="text-right m-t-20">
                        <button type="button" class="btn btn-primary" id="btnEditUser" >Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
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
    <script src="<?php echo urlsite; ?>vista/js/funciones.js"></script>
    <script src="<?php echo urlsite; ?>vista/js/user.js"></script>
</body>

</html>