<?php

class CategoriasModel {

    private $id;
    private $descripcion;
    private $grupo;
    
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

    /**
     * Set the value of grupo
     *
     * @return  self
     */ 
    public function setGrupo($grupo)
    {
        $this->grupo = $grupo;
        return $this;
    }

    public function save() {
        $db = new Modelo();
        $saved  = $db->insertar('categoria','"'.$this->descripcion.'",'.$this->grupo);
        return $saved;
    }

    public function update() {
        $db = new Modelo();
        $updated = $db->actualizar('categoria','descripcion = "'.$this->descripcion.'", id_grupo ='.$this->grupo,'id_categoria = '.$this->id);
        if($updated){
            return $updated;
        } else {
            return $db->error();
        }
    }
}