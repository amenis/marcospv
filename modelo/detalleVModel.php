<?php

class DetalleVModel {
    private $cantidad;
    private $producto;
    private $precioUnitario;
    private $total;

    public function setCantidad($cantidad){
        $this->cantidad = $cantidad;
    }

    public function setProducto($sku) {
        $dbModel = new Modelo();
        $dbModel->mostrar('inventario', 'codigo='.$sku);
        $this->producto =  $dbModel[0]['id_inventario'];       

    }

    public function setPrecioUnitario($precio){
        $this->precioUnitario = $precio;
    }

    public function setTotal($total){
        $this->total = $total;
    }
}