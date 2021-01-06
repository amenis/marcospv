<?php

class Gastos extends GastosModel{

    private $session;
    private $db;

    public function __construct()
    {
        $this->session = new Session();
        $this->db = new Modelo();
    }
    
    public function index(){
        if($this->session->isset_session('userId')){
            $data = [
                'userId' => $this->session->get_session('userId'),
                'userName' => $this->session->get_session('userName'),
                'categoria' => $this->getAllCategories(),
                'expenses' => $this->getAllExpenses()
            ];
    
            view('gastos', $data);          
        } else {
            redirect();
           // include('vista/index.php');
        }
        
    }


    private function getAllCategories() {
        return $cat = $this->db->mostrar('categoria', ' id_grupo = 2');
    }

    public function getAllExpenses(){
        $allExpenses = $this->db->custom('SELECT g.id_gastos, g.fecha, g.descripcion, g.cantidad, concat(e.nombre," ", e.apellidos) as empleado, c.descripcion as categoria FROM gastos g inner join empleados e on g.id_empleado = e.id_empleado inner join categoria c on c.id_categoria = g.id_categoria ORDER BY g.fecha DESC');
        return $allExpenses;
    }

    public function getExpense(){
        $expense = $this->db->mostrar('gastos','id_gastos='.$_POST['ref']);
        echo json_encode($expense);
    }

    public function newExpense() {
        parent::setCategoria($_POST['categoria']);
        parent::setFecha($_POST['fecha']);
        parent::setEmpleado($_POST['id_empleado']);
        parent::setDescription($_POST['descripcion']);
        parent::setCantidad($_POST['cantidad']);
        
        $saved = parent::save();
        if($saved == 1) {
            echo $saved;
        } else {
            echo $saved[2];
        }
    }

    public function deleteExpense() {
        $deleted = $this->db->eliminar('gastos','id_gastos='.$_POST['ref']);
        if($deleted == true) {
            echo $deleted;
        } else {
            echo $deleted[2];
        }
    }

    public function searchBy(){
        $sql1 = 'SELECT g.id_gastos, g.fecha, g.descripcion, g.cantidad, concat(e.nombre," ", e.apellidos) as empleado, c.descripcion as categoria FROM gastos g inner join empleados e on g.id_empleado = e.id_empleado inner join categoria c on c.id_categoria = g.id_categoria WHERE g.fecha BETWEEN "'.$_POST['dateIn'].' 00:00:00" AND "'.$_POST['dateEnd'].' 23:59:59" ';   
        $sql2 = 'SELECT g.id_gastos, g.fecha, g.descripcion, g.cantidad, concat(e.nombre," ", e.apellidos) as empleado, c.descripcion as categoria FROM gastos g inner join empleados e on g.id_empleado = e.id_empleado inner join categoria c on c.id_categoria = g.id_categoria WHERE g.fecha BETWEEN "'.$_POST['dateIn'].' 00:00:00" AND "'.$_POST['dateEnd'].' 23:59:59" AND g.id_categoria ='.$_POST['category'].' ';
        $sql3 = 'SELECT g.id_gastos, g.fecha, g.descripcion, g.cantidad, concat(e.nombre," ", e.apellidos) as empleado, c.descripcion as categoria FROM gastos g inner join empleados e on g.id_empleado = e.id_empleado inner join categoria c on c.id_categoria = g.id_categoria WHERE  g.id_categoria ='.$_POST['category'].'';
        
        if($_POST['dateIn'] == '' && $_POST['dateEnd'] == '' ){
            $searching = $this->db->custom($sql3);
        }
        else if($_POST['category'] == 0) {
            $searching = $this->db->custom($sql1);
        } else {
            $searching = $this->db->custom($sql2);
        }

        echo json_encode($searching);
    
    }

    public function updateExpense(){
        parent::setCategoria($_POST['categoria']);
        parent::setFecha($_POST['fecha']);
        parent::setDescription($_POST['descripcion']);
        parent::setCantidad($_POST['cantidad']);

        $updated = parent::update();
        var_dump($updated);
    }

}