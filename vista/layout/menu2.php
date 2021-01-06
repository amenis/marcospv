<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"></a>

    <div class="row ml-auto">
      
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto" >
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle " style="padding-left:120px;" href="#" id="navbarDropdownConf" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Configuracion
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownConf">
                        <?php if($_SESSION['permition'] === 'Administrador'):?>
                        <a class="dropdown-item" href="<?php echo urlsite;?>parametros">Parametros de la Aplicacion</a>                        
                        <a class="dropdown-item" href="<?php echo urlsite;?>users">Usuarios</a>
                        <?php endif;?>
                        <a class="dropdown-item" href="<?php echo urlsite;?>users/perfil">Perfil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo urlsite; ?>login/logout ">Cerrar Session</a>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</nav>