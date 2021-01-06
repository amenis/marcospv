<?php

class ArticuleModel {
    
    private $codigo;
    private $descripcion;
    private $precio;
    private $costo;
    private $proveedor;
    private $categoria;
    private $stmin;
    private $stmax;
    private $existencia;


    /**
     * Set the value of codigo
     *
     * @return  self
     */ 
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

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
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Set the value of costo
     *
     * @return  self
     */ 
    public function setCosto($costo)
    {
        $this->costo = $costo;

        return $this;
    }

    /**
     * Set the value of proveedor
     *
     * @return  self
     */ 
    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    /**
     * Set the value of categoria
     *
     * @return  self
     */ 
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Set the value of stmin
     *
     * @return  self
     */ 
    public function setStmin($stmin)
    {
        $this->stmin = $stmin;

        return $this;
    }

    /**
     * Set the value of stmax
     *
     * @return  self
     */ 
    public function setStmax($stmax)
    {
        $this->stmax = $stmax;

        return $this;
    }

    /**
     * Set the value of existencia
     *
     * @return  self
     */ 
    public function setExistencia($existencia)
    {
        $this->existencia = $existencia;

        return $this;
    }


    public function save() {
        $db = new Modelo();
        $saved = $db->insertar('inventario', ' '.$this->codigo.', "'.$this->descripcion.'", '.$this->costo.','.$this->precio.','.$this->proveedor.','.$this->categoria.','.$this->stmin.','.$this->stmax.','.$this->existencia.', 0');
        return $saved;
    }

    public function updated($ref) {
        
        $db = new Modelo();
        $updated = $db->actualizar('inventario',  ' codigo ='.$this->codigo.', descripcion="'.$this->descripcion.'", costo='.$this->costo.',precio='.$this->precio.',id_proveedor='.$this->proveedor.',id_categoria='.$this->categoria.',stock_min='.$this->stmin.',stock_max='.$this->stmax.',existencia='.$this->existencia, 'id_inventario='.$ref);
        return $updated;

    }
}