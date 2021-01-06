<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parametros</title>
    <link rel="stylesheet" href="<?php echo urlsite; ?>assets/alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="<?php echo urlsite; ?>assets/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" href="<?php echo urlsite; ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo urlsite; ?>assets/bootstrap/css/all.css" media="screen">
    <link rel="stylesheet" href="<?php echo urlsite; ?>vista/css/main.css">
    <link rel="stylesheet" href="<?php echo urlsite; ?>vista/css/parametros.css">
</head>

<body>
    <?php
    include('layout/menu2.php');
    include('layout/sider.php');
    ?>

    <div class="wrapper">
        <div>
            <h3>Parametros de Aplicacion</h3>
        </div>
        <div id="box-forms">
            <form id="params" onsubmit="event.preventDefault()">
               
                    <div class="input-group">
                        <label for="nombre">Nombre Empresa</label>
                        <input type="text" id="nombre" name="nombre" class="form-control ml-3 mb-3" value="<?php echo $params[0]['nombre_empresa']; ?>">
                    </div>
                    <div class="input-group">
                        <label for="direccion">Direccion</label>
                        <input type="text" id="direccion" name="direccion" class="form-control ml-3 mb-3" value="<?php echo $params[0]['domicilio']; ?>">
                    </div>
                    <div class="input-group">
                        <label for="telefono">Telefono</label>
                        <input type="text" id="telefono" name="telefono" class="form-control ml-3 mb-3" value="<?php echo $params[0]['telefono']; ?>">
                    </div>
                    <div class="input-group">
                        <label for="estado">Estado</label>                        
                        <select name="estado" id="estado" class="form-control ml-3 mb-3">
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
                        <script>
                            const estado = document.querySelectorAll('#estado > option');
                            estado.forEach((e, i, o) => {
                                o[i].removeAttribute('selected');
                                if(o[i].getAttribute('value') === "<?php echo $params[0]['estado']; ?>" ){ o[i].setAttribute('selected','true' ) }
                           });
                        </script>
                    </div>
                    <div class="input-group">
                        <label for="ciudad">Ciudad</label>
                        <input type="text" id="ciudad" name="ciudad" class="form-control ml-3 mb-5" value="<?php echo $params[0]['ciudad']; ?>">
                    </div>
                    <div class="btn-group" style="margin-left:92%">
                        <button type="submit" class="btn btn-success" onclick="updateParams()">Editar</button>
                    </div>
            </form>
        </div>

    </div>

    <script src="<?php echo urlsite; ?>assets/alertifyjs/alertify.js"></script>
    <script src="<?php echo urlsite; ?>assets/bootstrap/js/jquery-3.3.1.js"></script>
    <script src="<?php echo urlsite; ?>assets/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo urlsite; ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo urlsite; ?>vista/js/funciones.js"></script>
    <script>
        const updateParams = () => {
            nombre = document.getElementById('nombre').value;
            direccion = document.getElementById('direccion').value;
            telefono = document.getElementById('telefono').value;
            estado = document.getElementById('estado').value;
            ciudad = document.getElementById('ciudad').value;

            $.post('Parametros/saveParams', {
                nombre: nombre,
                direccion: direccion,
                telefono: telefono,
                estado: estado,
                ciudad: ciudad
            }, (req) => {
                if(req == 1){
                    alertify.notify('Datos Actualizados', 'success', 5);
                    setTimeout( ()=>{
                        window.location.reload();
                    }, 2000 );
                } else {
                    alertify.error(req);
                }
            });
        }
    </script>
</body>

</html>