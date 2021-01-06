<?php

class Pedidos extends PedidosModel {

    private $session;
    private $db;

    public function __construct()
    {
        $this->session = new Session();
        $this->db = new Modelo();
    }

    public function index() {
        if($this->session->isset_session('userId')){
            $data = [
                'orders' => $this->getOrders(),
                'inventario' =>$this->getStore()
            ];
            view('pedidos',$data);
        } else {
            redirect();
        }

    }


    private function getOrders(){
        $order = $this->db->custom('SELECT inv.descripcion, inv.id_inventario, p.id_pedidos, p.cantidad, p.observaciones, p.fecha FROM pedidos p left join inventario inv ON inv.id_inventario = p.id_inventario where inv.status = 0 AND p.status = 0 ');
        return $order;
    }

    private function getStore(){
        $store = $this->db->mostrar('inventario','status = 0');
        return $store;
    }

    public function newOrder() {
        parent::setFecha($_POST['fecha']);
        parent::setInventario($_POST['articulo']);
        parent::setCantidad($_POST['cantidad']);
        parent::setObservaciones($_POST['observaciones']);
        $savedOrder = parent::save();
        if($savedOrder == true) {
            $savedOrder;
        } else {
           echo $savedOrder[2];
        }        
    }

    
    public function editOrder(){
        parent::setId($_POST['ref']);
        parent::setFecha($_POST['fecha']);
        parent::setInventario($_POST['articulo']);
        parent::setCantidad($_POST['cantidad']);
        parent::setObservaciones($_POST['observaciones']);
        $update = parent::update();
        if($update === true){
            echo $update;
        } else {
            echo $update[2];
        }
    }

    public function getOrderById(){
        $order = $this->db->mostrar('pedidos', 'id_pedidos = '.$_POST['ref']);
        echo json_encode($order);
    }

    public function closeOrder(){
        $closed = $this->db->actualizar('pedidos','status=1',' id_pedidos ='.$_POST['ref']);
        if($closed == true) {
            echo $closed;
        } else {
            $this->db->error();
        }
    }





}