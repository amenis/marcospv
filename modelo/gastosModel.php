<?php

class GastosModel {

    private $categoria;
    private $fecha;
    private $empleado;
    private $descripcion;
    private $cantidad;

    public function setCategoria($categoria){
        $this->categoria = $categoria;
    }
    
	public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function setEmpleado($empleado){
        $this->empleado = $empleado;
    }

    public function setDescription($descripcion){
        $this->descripcion = $descripcion;
    }

    public function setCantidad($cantidad){
        $this->cantidad = $cantidad;
    }
    
    public function save(){
        $db = new Modelo();
        $saved = $db->insertar('gastos', ''.$this->categoria.', "'.$this->fecha.'",'.$this->empleado.',"'.$this->descripcion.'",'.$this->cantidad);
        if($saved == 1) {
            return $saved;
        } else {
            return $db->error();
        }
    }

    public function update(){
        $db = new Modelo();
        $updated = $db->actualizar('gastos','id_categoria ='.$this->categoria.', fecha ="'.$this->fecha.'",descripcion ="'.$this->descripcion.'",cantidad='.$this->cantidad, 'id_gastos ='.$_POST['ref'] );
        return $updated;
    }

}