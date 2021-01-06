<?php

class ParamsModel {

    private $nombreEmpresa;
    private $domicilio;
    private $telefono;
    private $estado;
    private $ciudad;

    public function setNombreEmpresa($nombre){
        $this->nombreEmpresa = $nombre;
        return $this;
    }

    public function setDomicilio($domicilio){
        $this->domicilio = $domicilio;
        return $this;
    }

    public function setTelefono($telefono){
        $this->telefono = $telefono;
        return $this;
    }

    public function setEstado($estado){
        $this->estado = $estado;
        return $this;
    }

    public function setCiudad($ciudad){
        $this->ciudad = $ciudad;
        return $this;
    }

    public function save(){
        $db = new Modelo();
        $saved = $db->actualizar('parametro','nombre_empresa ="'.$this->nombreEmpresa.'", domicilio="'.$this->domicilio.'", telefono="'.$this->telefono.'", estado="'.$this->estado.'", ciudad="'.$this->ciudad.'"','id_parametro=1');
        if($saved == true){
            echo 1;
        } else {
            $db->error();
        }
    }

}

