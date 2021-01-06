<?php

class Modelo extends DbConnection{
    //private $Modelo;
    private $conectar;
    private $db;
    public function __construct(){
        //$this->Modelo = array();
        
        $this->conectar = new DbConnection();
        $this->db = $this->conectar->connect();
    }

 
    public function insertar($tabla, $data){
        $consulta="insert into ".$tabla." values(null,". $data .")";
        $resultado=$this->db->query($consulta);
        if ($resultado) {
            return true;
        }else {
            return false;
        }
     }
    public function mostrar($tabla,$condicion){
        $consul="select * from ".$tabla." where ".$condicion."";
            $resu=$this->db->query($consul);
            return $resu->FETCHALL(PDO::FETCH_ASSOC);
          /* 
            while($filas = $resu->FETCHALL(PDO::FETCH_ASSOC)) {
                $this->consulta[]=$filas;
            }
            return $this->consulta; */
        } 
    public function actualizar($tabla, $data, $condicion){       
        $consulta="update ".$tabla." set ". $data ." where ".$condicion;
        $resultado=$this->db->query($consulta);
        if ($resultado) {
            return true;
        }else {
            return false;
        }
     }
    public function eliminar($tabla, $condicion){
        $eli="delete from ".$tabla." where ".$condicion;
        $res=$this->db->query($eli);
        if ($res) {
            return true; 
        }else {
            return false;
        }
    }

    public function custom($query)
    {
        $consul = $query;
        $resu = $this->db->query($consul);
        return $resu->FETCHALL(PDO::FETCH_ASSOC);
       
    } 

    public function getLastId(){
        $lastId = $this->db->lastInsertId();;
        return $lastId;
    }

    public function error(){
        return $this->db->errorInfo();
    }
}
