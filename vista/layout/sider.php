
<div id="sidebar">
    <div class="img-logo">
        <img src="<?php echo urlsite;?>assets/imagenes/user.png">
           <span id="userName" ><?php echo $_SESSION['userName'];?></span>
    </div>
    <a href="<?php echo urlsite; ?>home">
        <i class="fa fa-home mr-3"></i>
        Home
    </a>
    <a href="#" class="sider-dropdown">
        <i class="fa fa-gift mr-3"></i> Ventas        
    </a>
    <div class="dropdown-container">
        <a href="<?php echo urlsite; ?>ventas"><i class="fa fa-shopping-cart mr-3"></i> Caja </a>
        <a href="<?php echo urlsite; ?>cancelaVentas"> <i class="fa fa-ban mr-3"></i> Cancelar Venta</a>      
        <a href="<?php echo urlsite; ?>corteCaja"> <i class="fa fa-file mr-3"></i> Corte de caja</a>  
    </div>
    <a href="#" class="sider-dropdown">
        <span class="fa fa-trophy mr-3"></span> Clientes
    </a>
    <div class="dropdown-container">
        <a href="<?php echo urlsite;?>clientes"><i class="fa fa-address-book mr-3"></i> Alta de Clientes</a>
    </div>

    <a href="#" class="sider-dropdown"><span class="fa fa-money-bill mr-3"></span> Operaciones</a>
    <div class="dropdown-container">
        <a href="<?php echo urlsite;?>apartados"><i class="fa fa-list-alt mr-3"></i> Apartados</a>
        <a href="<?php echo urlsite; ?>gastos"><i class="fa fa-reply-all mr-3"></i> Gastos</a>
        <a href="<?php echo urlsite; ?>pedidos"><i class="fa fa-truck mr-3"></i> Pedidos</a>       
    </div>
    <a href="#" class="sider-dropdown"><span class="fa fa-box mr-3"></span> Inventarios</a>
    <div class="dropdown-container">
        <a href="<?php echo urlsite;?>inventarios"><i class="fa fa-list-alt mr-3"></i> Alta Inventarios</a>
        <?php if($_SESSION['permition'] === 'Administrador'):?>
        <a href="<?php echo urlsite;?>inventarios/invBaja"><i class="fa fa-eraser mr-3"></i> Articulos en Baja</a>       
        <a href="<?php echo urlsite; ?>categorias"><i class="fa fa-bookmark mr-3"></i> Categorias</a>
        <a href="<?php echo urlsite; ?>grupos"> <i class="fa fa-object-group mr-3"></i> Grupos</a>
        <?php endif;?>
    </div>
    <!--
    <a href="#"  class="sider-dropdown"><span class="fa fa-chart-bar mr-3"></span> Reportes</a>
    <div class="dropdown-container">
     
    </div>
    -->
</div>