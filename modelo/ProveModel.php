<?php

class ProveModel {

    private $id;
    private $nombre;
    private $domicilio;
    private $ciudad;
    private $estado;
    private $cp;
    private $telefono;
    
    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Set the value of domicilio
     *
     * @return  self
     */ 
    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;

        return $this;
    }

    /**
     * Set the value of ciudad
     *
     * @return  self
     */ 
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */ 
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Set the value of cp
     *
     * @return  self
     */ 
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */ 
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function save(){
        $db = new Modelo();
        $new = $db->insertar('proveedor','"'.$this->nombre.'", "'.$this->domicilio.'", "'.$this->ciudad.'", "'.$this->estado.'", "'.$this->cp.'", "'.$this->telefono.'",0');
      
        if($new){
            return 1;
        } else {
            return $db->error();
        }
    }

    public function update(){
        $db = new modelo();
        $updated = $db->actualizar('proveedor','nombre = "'.$this->nombre.'", domicilio="'.$this->domicilio.'", ciudad="'.$this->ciudad.'", estado="'.$this->estado.'", codigopostal="'.$this->cp.'", telefono="'.$this->telefono.'"','id_proveedor='.$this->id);
        if($updated){
            return 1;
        } else {
            return $db->error();
        }
    }

}