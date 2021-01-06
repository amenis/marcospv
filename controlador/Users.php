<?php

class Users  extends UserModel {

    private $session;
    private $db;

    public function __construct()
    {
        $this->session = new Session();
        $this->db = new Modelo();
    }

    public function index(){
        if($this->session->isset_session('userId')){            
            view('user',['empleados' => $this->getAll()]);
        } else {
            redirect();
        }
    }

    public function perfil() {
        if($this->session->isset_session('userId')){
            $perfil = $this->db->mostrar('empleados', 'id_empleado='.$this->session->get_session('userId'));
            view('perfil',['empleados' => $perfil] );
        } else {
            redirect();
        }
    }

    public function getAll(){
        $users = $this->db->mostrar('empleados', 'status=0');
        return $users;
    }

    public function newUser(){
       parent::setNombre($_POST['nombre']);
       parent::setApellidos($_POST['apellidos']);
       parent::setDomicilio($_POST['domicilio']);
       parent::setCiudad($_POST['ciudad']);
       parent::setEstado($_POST['estado']);
       parent::setTelefono($_POST['telefono']);
       parent::setCp($_POST['codigopostal']);
       parent::setUserName($_POST['userName']);
       parent::setPassword($_POST['password']);
       parent::setTipo($_POST['tipoUser']);
       $saved = parent::save();
       if($saved == 1){
           echo 1;
       } else {
           echo $saved[2];
       }
    }


    public function getUser(){
       
        $user = $this->db->mostrar('empleados',' id_empleado='.$_POST['ref'].' and status=0');
        echo json_encode($user);
    }

    public function editUser(){
        parent::setNombre($_POST['nombre']);
        parent::setApellidos($_POST['apellidos']);
        parent::setDomicilio($_POST['domicilio']);
        parent::setCiudad($_POST['ciudad']);
        parent::setEstado($_POST['estado']);
        parent::setTelefono($_POST['telefono']);
        parent::setCp($_POST['codigopostal']);
        parent::setUserName($_POST['userName']);
        parent::setPassword($_POST['password']);
        parent::setTipo($_POST['tipoUser']);
        $update = parent::update();
        if($update == 1) {
            echo 1;
        } else {
            echo $update[2];
        }
    }

    public function deleteUser(){
        $delete = $this->db->eliminar('empleados', 'id_empleado='.$_POST['ref']);
        if($delete){
            echo 1;
        } else {
            $err = $this->db->error();
            echo $err[2];
        }
    }

    public function editPerfil(){
        $edit = $this->db->actualizar('empleados','usuario="'.$_POST['username'].'", password="'.$_POST['password'].'" ', 'id_empleado='.$_POST['ref']);
        if($edit) {
            echo 1;
        } else {
            $error = $this->db->error();
            echo $error[2];
        }
    }

}