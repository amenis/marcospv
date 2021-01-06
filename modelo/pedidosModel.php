<?php

class PedidosModel {

    private $id;
    private $inventario;
    private $cantidad;
    private $fecha;
    private $observaciones;

    public function setId($id){
        $this->id = $id;
    }

    public function setInventario($inventario){
        $this->inventario = $inventario;
    }

    public function setCantidad($cantidad){
        $this->cantidad = $cantidad;
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;
    }
    
    public function setObservaciones($observaciones){
        $this->observaciones = $observaciones;
    }

    public function save(){
        $db = new Modelo();
        $saved = $db->insertar('pedidos',''.$this->inventario.','.$this->cantidad.',"'.$this->fecha.'","'.$this->observaciones.'", 0');
        if($saved){
            echo $saved;
        } else {
            return $db->error();
        }
    }

    public function update(){
        $db = new Modelo();
        $update = $db->actualizar('pedidos','id_inventario ='.$this->inventario.', cantidad ='.$this->cantidad.',fecha = "'.$this->fecha.'",observaciones = "'.$this->observaciones.'" ','id_pedidos = '.$this->id);
        if($update === true){
            return $update;
        } else {
            return $db->error();
        }
    }

}