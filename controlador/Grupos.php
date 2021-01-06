<?php


Class Grupos extends GruposModel {
   
    private $db;
    private $session;

    public function __construct()
    {
        $this->db = new Modelo();
        $this->session = new Session();
    }

    public function index() {
        if($this->session->isset_session('userId')){
            $data = [
                'grupos' => $this->getAllGroups(),           
            ];
            view('grupos', $data );
           
        } else {
            redirect();
           // include('vista/index.php');
        }
    }

   
    private function getAllGroups(){
        $groups = $this->db->mostrar('grupos', ' 1');
        return $groups;
    }

    public function getGroupById(){
        $cat = $this->db->mostrar('grupos', 'id_grupo ='.$_POST['ref']);
        echo json_encode($cat);
    }

    public function newG() {
        parent::setDescripcion($_POST['descripcion']);
        $saved = parent::save();
        if($saved  == 1){
            echo 1;
        } else {
            echo $saved[2];
        }
    }

    public function updateG(){
        parent::setDescripcion($_POST['descripcion']);        
        parent::setId($_POST['ref']);
        $updated = parent::update();
        if($updated){
            echo 1; 
        } else {
            echo $updated;
        }
        
    }

    public function deleteG(){
        $uns = $this->db->eliminar('grupos', 'id_grupo ='.$_POST['ref']);
        if($uns){
            echo 1;
        } else {
            echo $uns;
        } 
    }   
}