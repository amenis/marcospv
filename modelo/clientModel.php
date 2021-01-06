<?php

class ClientModel  {

    private $id;
    private $nombre;
    private $apellidos;
    private $domicilio;
    private $ciudad;
    private $estado;
    private $cp;
    private $telefono;
   
    public function setId($id){
        $this->id = $id;
    }
   
    public function setNombre($nombre)
    {
        $this->nombre = filter_var($nombre,513);
    }

    
  
    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;
    }

  
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;
    }

    
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
   
    public function setCp($cp)
    {
        $this->cp = $cp;
        return $this;
    }
   
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
        return $this;
    }

    public function save(){
        $db = new Modelo();
        $data = ' "'.$this->nombre.'", "'.$this->apellidos.'", "'.$this->domicilio.'", "'.$this->ciudad.'", "'.$this->estado.'", "'.$this->cp.'", "'.$this->telefono.'", 1, 0';
        $saved = $db->insertar('cliente', $data );
        return $saved;
    }

    public function update() {
        $db = new Modelo();
        $data = ' nombre="'.$this->nombre.'", apellidos="'.$this->apellidos.'", 
        domicilio="'.$this->domicilio.'", ciudad="'.$this->ciudad.'", estado="'.$this->estado.'", 
        codigopostal="'.$this->cp.'", telefono="'.$this->telefono.'"';
        $update = $db->actualizar('cliente',$data, 'id_cliente='.$this->id);
        return $update;
    }
}
