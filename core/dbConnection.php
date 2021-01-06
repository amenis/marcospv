<?php

class DbConnection {
    
    private $db;

    public function connect() 
    {
        $this->db=new PDO('mysql:host='.host.';dbname='.dbName ,userName,password);
        return $this->db;
    }

    public function getDb(){
        return $this->db;
    }

}

?>