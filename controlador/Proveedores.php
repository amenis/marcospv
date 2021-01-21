<?php

class Proveedores extends ProveModel {

    private $session;
    private $db;

    public function __construct(){
        $this->session = new Session();
        $this->db = new Modelo();
    }

    public function index(){
        if($this->session->isset_session('userId')){
            view('proveedores',['providers' => $this->getAllProviders() ]);
        } else {
            redirect();
        }
    }

    private function getAllProviders(){
        return  $this->db->mostrar('proveedor','status = 0');       
    }

    public function getProviderById(){
        $provider = $this->db->mostrar('proveedor', 'id_proveedor='.$_POST['id']);
        echo json_encode($provider);
    }

    public function newProvider(){
        parent::setNombre($_POST['nombre']);
        parent::setDomicilio($_POST['domicilio']);
        parent::setCiudad($_POST['ciudad']);
        parent::setEstado($_POST['estado']);
        parent::setCp($_POST['codigopostal']);
        parent::setTelefono($_POST['telefono']);      
        $n = parent::save();        
        if($n == 1){
            echo 1;
        } else {
            $err = $n;
            echo $err[2];
        }
    }

    public function updateProvider(){
        parent::setId($_POST['ref']);
        parent::setNombre($_POST['nombre']);
        parent::setDomicilio($_POST['domicilio']);
        parent::setCiudad($_POST['ciudad']);
        parent::setEstado($_POST['estado']);
        parent::setCp($_POST['codigopostal']);
        parent::setTelefono($_POST['telefono']);        
        $up = parent::update();
        if($up == 1){
            echo 1;
        } else {
            $err = $up;
            echo $err[2];
        }
    }

    public function deleteProvider(){
        $delete = $this->db->eliminar('proveedor','id_proveedor = '.$_POST['ref']);
        if($delete){
            echo 1;
        } else {
            $err = $this->db->error();
            echo $err[2];
        }
    }

}