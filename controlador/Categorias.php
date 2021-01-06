<?php

Class Categorias extends CategoriasModel {
   
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
                'categorias' => $this->getAllCategories()
            ];
            view('categorias', $data );         

        } else {
            redirect();
           // include('vista/index.php');
        }
    }

    public function getAllCategories() {
       $categories = $this->db->custom('SELECT c.descripcion, c.id_categoria, g.descripcion as grupo FROM categoria c left join grupos g on c.id_grupo = g.id_grupo');
       return $categories;
    }

    private function getAllGroups(){
        $groups = $this->db->mostrar('grupos', ' 1');
        return $groups;
    }

    public function getCatById(){
        $cat = $this->db->mostrar('categoria', 'id_categoria ='.$_POST['ref']);
        echo json_encode($cat);
    }

    public function newCat() {
        parent::setDescripcion($_POST['descripcion']);
        parent::setGrupo($_POST['grupo']);
        $saved = parent::save();
        echo $saved;
    }

    public function updateCat(){
        parent::setDescripcion($_POST['descripcion']);
        parent::setGrupo($_POST['grupo']);
        parent::setId($_POST['ref']);
        $updated = parent::update();
        if($updated){
            echo 1; 
        } else {
            echo $updated;
        }
        
    }

    public function deleteCat(){
        $uns = $this->db->eliminar('categoria', 'id_categoria ='.$_POST['ref']);
        echo $uns;
    }
   
}