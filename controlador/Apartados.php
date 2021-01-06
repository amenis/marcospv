<?php

class Apartados {
    private $db;
    private $session;
    public function __construct()
    {
        $this->db = new Modelo();
        $this->session = new Session();
    }
    
    public function index(){
        if($this->session->isset_session('userId')){
            $data = $this->loadDataBalances();
            view('cxc', $data);
        } else {
            redirect();           
        }
        
    }

    public function loadDataBalances(){
        $totalDocs = $this->db->custom('SELECT count(id_apartados) as num FROM apartados WHERE status = 0');
        $totalBalance = $this->db->custom('SELECT sum(total) as total FROM apartados WHERE status = 0');
        $total = $this->db->custom("SELECT SUM( CASE WHEN ab.cantidad IS null THEN 0 WHEN ab.cantidad > 0 THEN ab.cantidad END ) as 'cantidad' FROM apartados ap left JOIN abonos ab on ab.id_apartado = ap.id_apartados WHERE ap.status = 0");
        return [
            'totalDocs' => $totalDocs,
            'totalBalance' => $totalBalance,
            'total' => $total
        ];
    }

    public function name(){
        $ref = $_POST['ref'];
        $clients = $this->db->custom('SELECT id_cliente, concat(nombre," ", apellidos) as nombre_cliente, domicilio, ciudad, estado, telefono FROM cliente WHERE nombre like "%'.$ref.'%" AND status = 0 ');
        echo json_encode($clients);
    }

    public function dates(){
        $clients = $this->db->custom("SELECT DISTINCT folio, id_cliente, nombre_cliente, id_apartados, nombre_empleado, descuentoGral, porcentaje, importe_total FROM `v_apartados` WHERE fecha BETWEEN '".$_POST['dateIn']." 00:00:00 ' AND '".$_POST['dateEnd']." 23:59:59' ");
        echo json_encode($clients);
    }

    public function getOwe(){
        $owe = $this->db->mostrar('v_apartados','id_cliente = '.$_POST['clienteRef']);
        echo json_encode($owe);
    }

    public function getResumen(){
        $balance = $this->db->custom("SELECT total, (select SUM(CASE WHEN abonos.cantidad IS null THEN 0 WHEN abonos.cantidad > 0 THEN abonos.cantidad END) from abonos where abonos.id_apartado = apartados.id_apartados) as 'cantidad' from apartados where id_apartados =".$_POST['ref']);
        $historial = $this->db->custom("select ab.id_abonos ,ab.id_apartado,ab.fecha,ab.cantidad, concat(c.nombre,' ', c.apellidos) as nombre_cliente from abonos ab left join apartados ap on ap.id_apartados = ab.id_apartado RIGHT JOIN cliente c on c.id_cliente = ap.cliente where ab.id_apartado =".$_POST['ref']);
        echo json_encode( array(
            'balance' => array(
                'total_ventas'=>$balance[0]['total'],
                'total_abonos'=>$balance[0]['cantidad']
            ),
            'historial'=> $historial
        ));
    }

    public function abonos(){
        $register = $this->db->insertar('abonos',$_POST['folio'].', "'.date('Y-m-d H:i:s').'",'.$_POST['cantidad']);
        if($register ==1) {
            $check = $this->db->custom("SELECT total, (select SUM(CASE WHEN abonos.cantidad IS null THEN 0 WHEN abonos.cantidad > 0 THEN abonos.cantidad END) from abonos where abonos.id_apartado = apartados.id_apartados) as 'cantidad' from apartados where id_apartados =".$_POST['folio']);
            if($check[0]['total'] - $check[0]['cantidad'] == 0) {
                $updated = $this->db->custom('update apartados set apartados.status = 1 where apartados.id_apartados ='.$_POST['folio']);
                echo 3;
            } else {
                echo 1;
            }
        }         
    }

   

}