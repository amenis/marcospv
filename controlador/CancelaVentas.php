<?php

class CancelaVentas {

    private $db;
    private $session;

    public function __construct()
    {
        $this->db = new Modelo();
        $this->session = new Session();     
    }

    public function index(){
        if($this->session->isset_session('userId')){
            view('cancelaVenta');
        } else{
            redirect();
        }
    }

    public function searchByDate() {
        $tks =  $this->db->mostrar('ventas','fecha between "'.$_POST['dateIn'].' 00:00:00" AND "'.$_POST['dateEnd'].' 23:59:59" order by fecha desc');
         echo json_encode($tks);
     }
     public function ticketNumber() {
         $tk =  $this->db->mostrar('ventas','id_ventas ='.$_POST['folio']);
         echo json_encode($tk);
      }
 
    public function cancela(){
        $cancel = $this->db->actualizar('ventas','status = 1','id_ventas ='.$_POST['folio']);
        if( $cancel){
            echo 1;
        } else {
            $error = $this->db->error();
            echo $error[2];
        }
    }
}