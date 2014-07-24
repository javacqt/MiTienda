<?php
class ProductoCantidad {
    public $producto;
    public $cantidad;
    
    function __construct($p, $c){
        $this->producto = $p;
        $this->cantidad = $c;
    }
}
?>
