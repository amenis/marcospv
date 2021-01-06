<?php

class Inventarios extends ArticuleModel {

    private $db;
    private $session;

    public function __construct()
    {
        $this->db = new Modelo();
        $this->session = new session();
    }

    public function index() {
        if($this->session->isset_session('userId')){
            $data = [
                "inventario" => $this->getAll(0),
                "categorias" => $this->getAllCat(),
                "proveedores" => $this->getProviders()
            ];
    
            view('inventarios', $data );
           
        } else {
            redirect();
           // include('vista/index.php');
        }
        
    }

    public function invBaja() {       

        if($this->session->isset_session('userId')){
            $data = [
                "inventario" => $this->getAll(1)
                ];
            view('invBaja', $data );
        } else {
            redirect();
        }    
    }

    private function getAll($status) {
        $products = $this->db->mostrar('v_inventario', ' status = '.$status); 
        return $products;
    }

    private function getAllCat() {
        $categories = $this->db->mostrar('categoria', 'status = 0');
        return $categories;
    }

    private function getProviders() {
        $providers = $this->db->mostrar('proveedor', 'status = 0');
        return $providers;
    }

    public function getProductById(){
        $products = $this->db->mostrar('inventario', ' id_inventario ='.$_POST['ref']); 
        echo json_encode($products);
    }
    

    public function newArticule(){
        parent::setDescripcion($_POST['descripcion']);
        parent::setCodigo($_POST['codigo']);
        parent::setPrecio($_POST['precio']);
        parent::setCosto($_POST['costo']);
        parent::setStmin($_POST['stockMin']);
        parent::setStmax($_POST['stockMax']);
        parent::setExistencia($_POST['existencia']);
        parent::setProveedor($_POST['proveedor']);
        parent::setCategoria($_POST['categoria']);

        $saved = parent::save();
        echo $saved;
    }

    public function updateArticule(){
        parent::setDescripcion($_POST['descripcion']);
        parent::setCodigo($_POST['codigo']);
        parent::setPrecio($_POST['precio']);
        parent::setCosto($_POST['costo']);
        parent::setStmin($_POST['stockMin']);
        parent::setStmax($_POST['stockMax']);
        parent::setExistencia($_POST['existencia']);
        parent::setProveedor($_POST['proveedor']);
        parent::setCategoria($_POST['categoria']);

        $updated = parent::updated($_POST['ref']);
        if($updated){
            echo 1;
        }

    }

    public function unsubscribeArticule() {
        $delete = $this->db->actualizar('inventario','status = 1' , 'id_inventario='.$_POST['ref']);
        if($delete){
            echo 1;
        }
    }

    public function restoreArticule(){
        $delete = $this->db->actualizar('inventario','status = 0' , 'id_inventario='.$_POST['ref']);
        if($delete){
            echo 1;
        }
    }
    
}
