<?php

class Login extends UserModel{

    private $session;
    private $modelDB;
 
    public function __construct()
    {
        $this->session = new Session();
        $db = new Modelo();
        $this->modelDB = $db;
    }

    public function index() {
       
        if($this->session->isset_session('userId')){
            view('home');
        } else {                        
            include('vista/index.php');
        }
    }

    public function singin() {
        $user = $_POST['usuario'];
        $pass = $_POST['password'];
       

        $singin = $this->modelDB->mostrar("empleados"," usuario LIKE '".$user."' AND password LIKE '".md5($pass)."' ");
       
        foreach($singin as $data){
            if($data != null) {
                $this->session->set_session('userId', $data['id_empleado']);
                $this->session->set_session('userName', $data['nombre']);
                $this->session->set_session('permition',$data['tipo_usuario']);
                echo 'correcto';
            } else {
              echo 'incorrecto';
            }
          }
    }

    public function update(){}

    public function unsubcribe(){}

    public function logout() {
        $this->session->unset_session();
        header("Location: http://localhost/mvc/");
    }
}

?>