<?php

class Parametros extends ParamsModel{

    private $session;
    private $db;

    public function __construct()
    {
        $this->session = new Session();
        $this->db= new Modelo();        
    }

    public function index(){
        if($this->session->isset_session('userId')){
            $params = $this->getParams();
            view('parametros', ['params' => $params]);
        } else {
            redirect();
        }
    }

    public function getParams() {
        $param = $this->db->mostrar('parametro','1');
        return($param);
    }

    public function saveParams() {
        parent::setNombreEmpresa($_POST['nombre']);
        parent::setDomicilio($_POST['estado']);
        parent::setTelefono($_POST['telefono']);
        parent::setEstado($_POST['estado']);
        parent::setCiudad($_POST['ciudad']);
        $saveParams = parent::save();
        if($saveParams == 1){
            echo 1; 
        } else {
            echo $saveParams[2];
        }
    }

}