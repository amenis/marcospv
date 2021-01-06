<?php

class UserModel extends Modelo {
    
    private $nombre;
    private $apellidos;
    private $domicilio;
    private $estado;
    private $ciudad;
    private $cp;
    private $telefono;
    private $userName;
    private $password;
    private $tipo;
   
  
    public function save() {
        $db = new Modelo();
        $saved = $db->insertar('empleados','"'.$this->nombre.'", "'.$this->apellidos.'", "'.$this->domicilio.'",
        "'.$this->ciudad.'", "'.$this->estado.'", "'.$this->telefono.'",  "'.$this->cp.'",
        "'.$this->tipo.'", 0 ,  "'.$this->password.'", "'.$this->userName.'" ');
        if($saved == true){
            return 1;
        } else {
           return  $db->error();
        }
    }

    public function update(){
        $db = new Modelo();
        $update = $db->actualizar('empleados', 'nombre="'.$this->nombre.'", apellidos="'.$this->apellidos.'", domicilio="'.$this->domicilio.'",
        ciudad="'.$this->ciudad.'", estado="'.$this->estado.'", telefono="'.$this->telefono.'",  codigopostal="'.$this->cp.'",
        tipo_usuario="'.$this->tipo.'", password="'.$this->password.'", usuario="'.$this->userName.'" ', 'id_empleado='.$_POST['ref']);
        if($update){
            return 1;
        } else {
            return $db->error();
        }
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
     * Set the value of apellidos
     *
     * @return  self
     */ 
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

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

    /**
     * Set the value of userName
     *
     * @return  self
     */ 
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = md5($password);

        return $this;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */ 
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }
}


?>