
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ventas</title>

	<link rel="stylesheet" href="<?php echo urlsite;?>assets/alertifyjs/css/alertify.css">
	<link rel="stylesheet" href="<?php echo urlsite;?>assets/alertifyjs/css/themes/default.css">
	<link rel="stylesheet" href="<?php echo urlsite;?>assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo urlsite;?>assets/bootstrap/css/all.css" media="screen">
	<link rel="stylesheet" href="<?php echo urlsite;?>assets/bootstrap/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="<?php echo urlsite; ?>vista/css/ventas.css">
	<link rel="stylesheet" href="<?php echo urlsite; ?>vista/css/main.css">

</head>

<body>
	<?php
	include('layout/menu2.php');
	include('layout/sider.php');	
	?>

	<div class="wrapper">
		<div class="box row-box1">
			<div id="sch-art">
				<div class="input-group pl-3 pt-3">
					<button class="btn btn-success mr-1" data-toggle="modal" data-target="#modalSearchProduct"><i class="fa fa-search"></i></button>
					<input type="text" class="form-control" id="articulo" placeholder="Codigo Articulo" onkeypress="searchByCode(this)">
				</div>
				<div class="input-group pl-3 pt-3">
					<span class="input-group-prepend bg-warning mr-1 p-1">Descripcion: </span><input type="text" style="color:blue; font-size: 12pt; font-weight: bold;" id="description" class="form-control" disabled>
				</div>
				<div class="input-group pl-3 pt-3">
					<span class="input-group-prepend bg-danger mr-1 p-1">Precio: </span><input type="number" style="color:blue; font-size: 12pt; font-weight: bold;" id="price" class="form-control" min="0" disabled>
				</div>
				<div class="input-group pl-3 pt-3">
					<span class="input-group-prepend bg-info mr-1 p-1 ">Cantidad:</span><input type="number" style="color:blue; font-size: 12pt; font-weight: bold;" id="quantity" class="form-control" min="0" value="0">
				</div>
				<div class="input-group pt-3 pl-3">
					<button class="btn btn-primary" onclick="addToList()"><i class="fa fa fa-edit pr-2"></i>Agregar</button>
					<button class="btn btn-danger ml-4 pl-3" onclick="cancel_art()"><i class="fa fa-times pr-2"></i>Cancelar</button>
				</div>
			</div>
			<div id="d-caja">
				<span class="ml-lg-5"><img src="<?php echo urlsite; ?>assets/imagenes/user.png" alt="User" width="200" height="180"></span>
				<span style="font-size: 25pt;font-weight: bold; margin-left: 100px;">Maria</span>
			</div>
			<div id="d-vtas" class="ml-3">
				<div id="total" style="height: 60px; font-size: 30pt; font-weight: bold; text-align:center; color:blue;">0.00</div>

				<div>Ticket: # <input type="text" style="border:none; background:transparent; font-weight: bold; font-size: 12pt;" id="num_ticket" value="<?php echo $folio + 1; ?>" disabled></div>
				<div>Total Articulos: <span id="total_articulos">0</span></div>
				<div style="width:300px">
					<label for="cliente">Cliente:</label>
					<select name="" id="cliente" class="form-control selectpicker" data-live-search="true">
						<?php
						
						foreach ($allClients as $key => $value) {
							echo '<option value="' . $value['id_cliente'] . '">' . $value['nombre'].' '.$value['apellidos'] . '</option>';
						}
						?>
					</select>
				</div>
				<div class="btn-group mt-3">
					<button class="btn btn-success mr-2" onclick="endingSale()"><i class="fa fa-money-bill pr-2"></i>Pagar</button>
					<button class="btn btn-warning text-white" onclick="cancela_venta()"><i class="fa fa fa-times-circle pr-2"></i>Cancelar</button>
				</div>

			</div>
		</div>

		<div class="box row-box2">
			<form method="POST" onsubmit="event.preventDefault()">

				<table class="table table-hover" id="tbl-ventas" style="font-size:12pt">
					<thead>
						<tr>
							<th>ID</th>
							<th>Codigo</th>
							<th>Descripcion</th>
							<th>Precio Unitario</th>
							<th>Cantidad</th>
							<th>Total</th>
							<th>Opciones</th>
						</tr>
					</thead>
					<tbody id="tbody-ventas">
					</tbody>
				</table>
			</form>
		</div>
	</div>

	<div class="modal fade" id="modalSearchProduct" tabindex="-1" role="dialog" aria-labelledby="search" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Busqueda de Articulos</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="text" id="txt-search" class="form-control" placeholder="Buscar articulo" onkeyup="busca_producto(this)">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Codigo</th>
								<th>Descripcion</th>
								<th>Precio Unitario</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody id="search-results">

						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cleanModal()">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modalFinalizarVenta" tabindex="-1" role="dialog" aria-labelledby="search" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">VENTA DE MOSTRADOR</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div class='input-group input-group-lg'>
						<span class='input-group-addon bg-blue'><b>Total a Pagar:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
						<input type='text' id='total_de_venta' class='form-control' style='font-size:30px; text-align:center; color:red; font-weight:bold;' disabled>
					</div>
					<br>
					<div class='input-group input-group-lg'>
						<span class='input-group-addon bg-blue'><b>Descuento:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
						<input type='text' id='descuento' class='form-control ' value='0' style="font-size:30px; text-align:center; color:red; font-weight: bold;"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
					</div>
					<br>
					<div class='input-group input-group-lg'>
						<span class='input-group-addon bg-blue'><b>Subtotal:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
						<input disabled type='text' id='subtotal' class='form-control ' style="font-size:30px; text-align:center; color:red; font-weight: bold;" >
					</div>
					<br>
					<div class='input-group input-group-lg'>
						<span class='input-group-addon bg-blue'><b>Su Pago:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
						<input type='text' id='paga_con' class='form-control ' value="0" style="font-size:30px; text-align:center; color:red; font-weight: bold;" onkeyup="calcula_cambio();" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
					</div>
					<br>
					<div class='input-group input-group-lg'>
						<span class='input-group-addon bg-blue'><b>Cambio:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
						<input type='text' id='el_cambio' class='form-control' style="font-size:30px; text-align:center; color:red; font-weight: bold;" disabled>
					</div>

				</div>
				<div class="modal-footer">
					<button class='btn btn-success ' id='btn-ticket' onclick='' disabled><i class='fa fa-print'></i> Ticket</button>
					<button class='btn btn-success' id='btn-termina' onclick='process_sale("mostrador");'><i class='fa fa-shopping-cart'></i> Procesar</button>
					<button type="button" class="btn btn-primary" onclick="process_sale('credito');" id="btn-credit"><i class="fa fa-plus"></i> Credito</button>
					
				</div>
			</div>
		</div>
		
	</div>
	<script src="<?php echo urlsite;?>assets/alertifyjs/alertify.js"></script>
	<script src="<?php echo urlsite;?>assets/bootstrap/js/jquery-3.3.1.js"></script>
	<script src="<?php echo urlsite;?>assets/bootstrap/js/popper.min.js"></script>
	<script src="<?php echo urlsite;?>assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo urlsite;?>assets\alertifyjs\alertify.js"></script>
	<script src="<?php echo urlsite;?>assets/bootstrap/js/bootstrap-select.min.js"></script>
	<script src="<?php echo urlsite;?>assets/bootstrap/js/printPage.js"></script>
	<script src="<?php echo urlsite;?>vista/js/point_sales.js"></script>
	<script src="<?php echo urlsite;?>vista/js/funciones.js"></script>

</body>

</html>