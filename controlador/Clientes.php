<?php

class Clientes extends ClientModel {
   
    private $modelDB;
    private $session;

    public function __construct()
    {
        $db = new Modelo();
        $this->modelDB = $db;
        $this->session = new Session();        
    }

    public function index() {
        if($this->session->isset_session('userId')){
            $clientes = $this->getActiveClients();
            view('clientes', array(
                'clientes' => $clientes
            ));            
        } else {
            redirect();
           // include('vista/index.php');
        }
    }

    public function getClientById(){
        $client = $this->modelDB->mostrar('cliente','id_cliente='.$_POST['ref']);
        echo json_encode($client);
    }

    public function getActiveClients(){
        $result = $this->modelDB->mostrar('cliente','status = 0');
        return $result;
    }

    public function newClient(){
       parent::setNombre($_POST['nombre']);
       parent::setApellidos($_POST['apellidos']);
       parent::setDomicilio($_POST['domicilio']);
       parent::setCiudad($_POST['ciudad']);
       parent::setEstado($_POST['estado']);
       parent::setCp($_POST['codigopostal']);
       parent::setTelefono($_POST['telefono']);
       $saved = parent::save();
       echo $saved;
        
    }

    public function updateClient(){
        parent::setId($_POST['ref']);
        parent::setNombre($_POST['nombre']);
        parent::setApellidos($_POST['apellidos']);
        parent::setDomicilio($_POST['domicilio']);
        parent::setCiudad($_POST['ciudad']);
        parent::setEstado($_POST['estado']);
        parent::setCp($_POST['codigopostal']);
        parent::setTelefono($_POST['telefono']);
        $updated = parent::update();
        echo $updated;
    }

    public function unsubcribe(){
        $delete = $this->modelDB->actualizar('cliente','status= 1','id_cliente='.$_POST['ref']);
        echo $delete;
    }

}