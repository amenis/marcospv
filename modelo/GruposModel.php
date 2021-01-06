<?php


class GruposModel {

    private $id;
    private $descripcion;
        
      /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }



    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
        return $this;
    }

  
    public function save() {
        $db = new Modelo();
        $saved  = $db->insertar('grupos','"'.$this->descripcion.'"');
        if($saved == 1){
            return 1;
        } else {
            return $db->error();
        }
    }

    public function update() {
        $db = new Modelo();
        $updated = $db->actualizar('grupos','descripcion = "'.$this->descripcion.'"',' id_grupo ='.$this->id);
        if($updated){
            return $updated;
        } else {
            return $db->error();
        }
    }
}