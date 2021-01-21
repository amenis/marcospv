<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores</title>
    <link rel="stylesheet" href="<?php echo urlsite;?>assets/alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="<?php echo urlsite;?>assets/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" href="<?php echo urlsite;?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo urlsite;?>assets/bootstrap/css/all.css" media="screen">
    <link rel="stylesheet" href="<?php echo urlsite;?>vista/css/main.css">
    <link rel="stylesheet" href="<?php echo urlsite;?>vista/css/proveedores.css">
</head>

<body>
    <?php
	include('layout/menu2.php');
	include('layout/sider.php');	
	?>

    <div class="wrapper">
        <div class="row1">
            <h3>Proveedores</h3>
        </div>
        <div class="row2">
            <button class="btn btn-primary" data-toggle="modal" data-target="#new_provider"><i class="fa fa-plus mr-3"></i>Agregar</button>
        </div>
        <div class="row3">
            <table class="table table-striped" style="margin-top:80px;" id="tbl-provider">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Ciudad</th>
                        <th>Estado</th>
                        <th>Telefono</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php                  
                     foreach ($providers as $p) {
                       
                        echo '
                        <tr>
                            <td>' .$p['nombre'] . '</td>                           
                            <td>' .$p['ciudad'] . '</td>
                            <td>' .$p['estado'] . '</td>
                            <td>' .$p['telefono'] . '</td>
                            <td>
                                <div class="dropdown dropdown-action"  >
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(68px, 27px, 0px);">
                                        <a class="dropdown-item" href="#" onclick="getProve(' .$p['id_proveedor'] . ')" ><i class="fa fa-pencil-alt m-r-5"></i> Editar</a>
                        ';
                        if($_SESSION['permition'] === 'Administrador'){
                                    echo'<a class="dropdown-item" href="#" onclick="eliminar(' .$p['id_proveedor'] . ')"><i class="fa fa-trash m-r-5"></i> Eliminar</a>
                                    </div>
                                </div>
                            </td>
                        </tr>               
                            ';
                        }
                      
                    }

                    ?>
                </tbody>
            </table>
        </div>

    </div>
    <div class="modal fade bs-example-modal-lg-udp" tabindex="-1" id="update_provider" role="dialog" aria-labelledby="search" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_mod_prove">
                        <input type="hidden" name="ref" id="ref">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control" id="mod_nombre" name="nombre" placeholder="Ingresa Nombre del cliente" >
                        </div>
                      
                        <div class="form-group">
                            <label for="">domicilio</label>
                            <input type="text" class="form-control" id="mod_domicilio" name="domicilio" placeholder="Ingresa el domicilio del cliente" >
                        </div>       
                        
                        <div class="form-group">
                            <label for="">Ciudad</label>
                            <input type="text" class="form-control" id="mod_ciudad" name="ciudad" placeholder="Ingresa la ciudad del cliente" >
                        </div>

                        <div class="form-group">
                            <label for="">Estado</label>
                            <select name="estado" id="mod_estado" class="form-control">
                                <option >-- Seleccione Estado --</option>
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
                            <input type="text" class="form-control" id="mod_codigopostal" name="codigopostal" placeholder="Ingresa el Codigo Postal del cliente" >
                        </div>
                        <div class="form-group">
                            <label for="">Telefono</label>
                            <input type="text" class="form-control" id="mod_telefono" name="telefono" placeholder="Ingresa tu Numero Telefonico" >
                        </div>
                    </form>

                    <div class="text-right m-t-20">
                        <?php if($_SESSION['permition'] === 'Administrador'):?>                        
                        <button type="button" class="btn btn-primary" onclick="actualizar()">Guardar</button>                       
                        <?php endif;?>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="event.preventDefault()">Close</button>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg-udp" tabindex="-1" id="new_provider" role="dialog" aria-labelledby="search" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="newProve">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="nombre" class="form-control" id="nombre" name="nombre" placeholder="Ingresa Nombre del cliente" >
                        </div>
                       
                        <div class="form-group">
                            <label for="">domicilio</label>
                            <input type="domicilio" class="form-control" id="domicilio" name="domicilio" placeholder="Ingresa el domicilio del cliente" >
                        </div>
                        <div class="form-group">
                            <label for="">Ciudad</label>
                            <input type="ciudad" class="form-control" id="ciudad" name="ciudad" placeholder="Ingresa la ciudad del cliente" >
                        </div>
                        <div class="form-group">
                        <label for="">Estado</label>
                            <select name="estado" id="estado" class="form-control">
                                <option >-- Seleccione Estado --</option>
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
                            <input type="codigopostal" class="form-control" id="codigopostal" name="codigopostal" placeholder="Ingresa el Codigo Postal del cliente" >
                        </div>
                        <div class="form-group">
                            <label for="">Telefono</label>
                            <input type="TelÃ©fono" class="form-control" id="telefono" name="telefono" placeholder="Ingresa tu Numero Telefonico" >
                        </div>
                    </form>

                    <div class="text-right m-t-20">
                        <button type="button" class="btn btn-primary" onclick="nuevo()">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="newClient()">Close</button>
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
    <script src="<?php echo urlsite;?>vista/js/proveedores.js"></script>
    <script src="<?php echo urlsite;?>vista/js/funciones.js"></script>
</body>

</html>