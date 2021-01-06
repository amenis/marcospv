<?php

class VentasModel {
    //use to general sale
    private $id_ventas;
    private $folio;
    private $fecha;
    private $cliente;
    private $empleado;
    private $descuento;
    private $porcentaje;
    private $tipo;
    private $totalGral;
    private $pagoCon;
    private $status;
    //use to sale details
    private $cantidad;
    private $producto;
    private $precioUnitario;
    private $totalDtv;

    public function setIdVentas($idVentas){
        $this->id_ventas = $idVentas;
        return $this;
    }

    public function getIdVentas(){
        
        return  $this->id_ventas;
    }

    public function setFolio($folio){
        $this->folio = $folio;
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function setCliente($cliente){
        $this->cliente = $cliente;
    }

    public function setEmpleado($empleado){
        $this->empleado = $empleado;
    }

    public function setDescuento($descuento){
        $this->descuento = $descuento;
    }

    public function setPorcentaje($porcentaje){
        $this->porcentaje = $porcentaje;
    }

    public function setTipo($tipo){
        $this->tipo = $tipo;
    }

    public function setTotalGral($total){
        $this->totalGral = $total;
    }

    public function setPagoCon($pagoCon){
        $this->pagoCon = $pagoCon;
    }

    public function setStatus(){
        $this->status = $this->tipo == 'contado' ? 0 : 2 ;
    }

    public function setCantidad($cantidad){
        $this->cantidad = $cantidad;
    }

    public function setProducto($sku) {
        $dbModel = new Modelo();
        //$this->producto = $sku;
        $result = $dbModel->mostrar('inventario', 'codigo='.$sku);
        $id = $result[0]['id_inventario'];
        $this->producto =  $id;       
        
    }

    public function setPrecioUnitario($precio){
        $this->precioUnitario = $precio;
    }

    public function setTotal($total){
        $this->totalDtv = $total;
    }


    public function save(){
        $db = new Modelo();
        $data = ' "'.$this->folio.'", "'.$this->fecha.'", "'.$this->cliente.'", "'.$this->empleado.'", "'.$this->descuento.'", "'.$this->porcentaje.'", "'.$this->tipo.'", "'.$this->totalGral.'",'.$this->pagoCon.' ,"'.$this->status.'"';
        $saved = $db->insertar('ventas', $data);
        if($saved == 1){
            $lid = $db->getLastId();
            return $lid;
        } else {
            return $db->error();
        }
    }

    public function saveDetalle() {
        $db = new Modelo();
        $detail = $db->insertar('detalleventas',''.$this->id_ventas.','.$this->cantidad.', '.$this->producto.','.$this->precioUnitario.','.$this->totalDtv);
       // return 'id_ventas='.$this->id_ventas.', cantidad='.$this->cantidad.', producto='.$this->producto.', preciounitario='.$this->precioUnitario.', total='.$this->totalDtv;
        if($detail){
            return $detail;
        } else {
            return $db->error();
        }
    }

}
