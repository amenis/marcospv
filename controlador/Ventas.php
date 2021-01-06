<?php

class Ventas extends VentasModel {
    private $session;
    private $db;
    
    public function __construct()
    {
        $this->session = new Session();
        $this->db = new Modelo();    
    }

    public function index() {
        
        require_once 'Clientes.php';
        if($this->session->isset_session('userId')){
            $clients = new Clientes();     
            $data = [
                'allClients' => $clients->getActiveClients(),
                'folio' => $this->getFolio()
            ];           
            
           view('ventas',$data);
        } else {
            redirect();
        }
    }
  

    public function getFolio(){
      
        $folioNum = $this->db->custom('SELECT MAX(id_ventas) as folio FROM ventas');
        return $folioNum[0]['folio'];
    }

    public function searchProduct(){
       
        $products = $this->db->mostrar('inventario','descripcion like "%'.$_POST["item"].'%" OR codigo like "%'.$_POST['item'].'%" ');
        echo json_encode($products);
    }

    public function sale(){
        
        $postArr= json_decode( $_POST['datos'],true ); ;
        $statusVenta = '';

        parent::setFolio($this->getFolio()+1);
        parent::setFecha(date('Y-m-d H:i:s'));
        parent::setCliente($postArr['ventas']['cliente']);
        parent::setEmpleado($this->session->get_session('userId'));
        parent::setDescuento($postArr['ventas']['descuento']);
        parent::setPorcentaje($postArr['ventas']['porcentaje']);
        parent::setTotalGral($postArr['ventas']['total']);
        parent::setPagoCon($postArr['ventas']['pago']);
        parent::setTipo($postArr['ventas']['tipoVenta']);        

        $saved = parent::save();
        if($saved != 0){
        
            foreach($postArr['detalle'] as $dt){
                
                //print_r( $dt );
                parent::setCantidad((int)$dt[2]['cantidad']);
                parent::setProducto( $dt[0]['codigo']);
                parent::setPrecioUnitario($dt[3]['precio_u']);
                parent::setTotal($dt[4]['total']);
                parent::setIdVentas($saved);
                $sale = parent::saveDetalle();
               if($sale){
                   $statusVenta = true;
               } else {
                   $statusVenta = $sale[2];
               }             
            }
          
            echo $statusVenta;         
        }
        //var_dump($postArr['ventas']['total']);
    }

 

    public function fill_ticket() {
        $folio =  $this->getFolio();
        $tk = $this->db->mostrar('vta_sales','folio ='.$folio);
        $parameters = $this->db->mostrar('parametro','1');

        $file = fopen('ticket.txt', 'w+');
        fputs($file,"         "."\n");
        fputs($file,"             "."\n");
        fputs($file,strtoupper($parameters[0]['nombre_empresa'])."\n\n");
        fputs($file,'Domicilio : '.$parameters[0]['domicilio']."\n");
        fputs($file,'Telefono : '.$parameters[0]['telefono']."\n");
        fputs($file,'Fecha : '.date('Y-m-d H:i:s')."\n" );
        fputs($file,'Empleado: '.$this->session->get_session('userName')."\n");
        fputs($file,'Ticket : '.$this->getFolio()."\n");
        fputs($file,"----------------------------------\n\n");
        fputs($file,"Cantidad     Descripcion     Precio"."\n\n");
        foreach($tk as $tk){           
            fputs($file,"   ".$tk['cantidad']."          ",18);
            fputs($file,substr($tk['nombre_producto'],0,13)."            ",16);
            fputs($file,$tk['preciounitario']."\n",13);
        }
        fputs($file,"\n----------------------------------\n");
        fputs($file,"\n\n".'Total :      '.$tk['total']."\n");
        fputs($file,'Pago con :   '.$tk['pago']."\n");
        fputs($file,'Cambio :     '.( $tk['pago']- $tk['total'] ) );
        
    }
}