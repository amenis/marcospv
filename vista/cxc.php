
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuenta de Apartados</title>
    <link rel="stylesheet" href="<?php echo urlsite;?>assets/alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="<?php echo urlsite;?>assets/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" href="<?php echo urlsite;?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo urlsite;?>assets/bootstrap/css/all.css" media="screen">
    <link rel="stylesheet" href="<?php echo urlsite;?>vista/css/main.css">
    <link rel="stylesheet" href="<?php echo urlsite;?>vista/css/cxc.css">
    <style>
        
    </style>

</head>

<body>
    <?php
    include('layout/menu2.php');
    include('layout/sider.php');
    ?>

    <div class="wrapper">
        <div>
            <h1>Control de Apartados</h1>
        </div>
        <div class="box box1">
            <div class="font-weight-bold">Numero de Documentos</div>
            <div class="font-weight-bold">Total Adeudos</div>
            <div class="font-weight-bold">Total Por Saldar</div>
            <div>
                <span>
                    <?php
                        echo $totalDocs[0]['num'];
                    ?>
                </span>
            </div>
            <div>
                <span>
                    <?php
                        echo '$ '.$totalBalance[0]['total'];
                    ?>
                </span>
            </div>
            <div>
                <span>
                    <?php
                        echo '$ '.( $totalBalance[0]['total'] - $total[0]['cantidad'] );
                    ?>
                </span>
            </div>

        </div>
        <div class="box box2">
            <div class="item1">
                <button class="btn " onclick="byDate()">Busqueda por Fecha</button>
                <button class="btn " onclick="byName()">Busqueda por Nombre</button>
            </div>
            <div class="item2">
                <label for="date-in">Fecha de Inicio</label>
                <input type="date" name="" id="date-in" class="form-control ml-3">
            </div>
            <div class="item3">
                <label for="date-out">Fecha Final</label>
                <input type="date" name="" id="date-end" class="form-control ml-3">
            </div>
            <div class="item4">
                <button class="btn btn-success ml-3" id="btn-sbd" onclick="searchByDate() " style="position: relative; top: 45%; left:-300"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
            <div class="item5">
                <label for="search-name">Nombre</label>
                <input type="search" name="" id="search-name" class="form-control ml-3" disabled>
            </div>
        </div>
        <div class="box box3">
            <table class="table" id="tbl-info">
                <thead>
                    <th>Fecha</th>
                    <th>Folio</th>
                    <th>Empleado</th>
                    <th>Cliente</th>
                    <th>Importe Total</th>
                    <th>Acciones</th>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <!--  modal busqueda por nombre -->
    <div class="modal fade" id="BuscaCliente" tabindex="-1" role="dialog" aria-labelledby="search" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Busqueda Clientes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" id="txt-search" class="form-control" placeholder="Nombre Cliente"
                        onkeyup="searchClient()" autofocus>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre Cliente</th>
                                <th>Domicilio</th>
                                <th>Ciudad</th>
                                <th>Estado</th>
                                <th>Telefono</th>
                            </tr>
                        </thead>
                        <tbody id="search-results">                            
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onclick="">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--  modal busqueda pagos -->
    <div class="modal fade" id="verPagos"  role="dialog" aria-labelledby="search" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" >Resumen<span id="nom_cli"></span></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">                   
                   <div class="row">
                     
                      <div class="col col-lg-12" >
                        <table class="table table-striped" style="text-align:center">
                            <thead>
                                <tr>
                                    <th>Num</th>
                                    <th>Fecha Pago</th>
                                    <th>Concepto</th>
                                    <th>Cantidad</th>                                                                       
                                </tr>
                            </thead>
                            <tbody id="tbody-vp">
                            </tbody>
                        </table>
                      </div>
                   </div>
                   <hr>
                   <div class="row" style="padding-left:320px">
                       <div class="col col-sm-4">
                           Total Abonado <input type="number" name="" id="tab" class="form-control" disabled>
                       </div>
                       <div class="col col-sm-4">
                           Monto a pagar <input type="number" name="" id="tdb" class="form-control" disabled>
                       </div>
                       <div class="col col-sm-4">
                           Adeudo Total <input type="number" name="" id="tad" class="form-control" disabled>
                       </div>
                   </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" id="btn-pay" >Abonar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onclick="">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center" >
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <script src="<?php echo urlsite;?>assets/alertifyjs/alertify.js"></script>
    <script src="<?php echo urlsite;?>assets/bootstrap/js/jquery-3.3.1.js"></script>
    <script src="<?php echo urlsite;?>assets/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo urlsite;?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo urlsite;?>vista/js/cxc.js"></script>
    <script src="<?php echo urlsite;?>vista/js/funciones.js"></script>
</body>

</html>