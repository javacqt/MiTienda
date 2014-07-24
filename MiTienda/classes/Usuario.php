<?php
class Usuario{
    private $nombre;
    private $carrito;
    
    function __construct($n, $c){
        $this->nombre = $n;
        $this->carrito = $c;
    }
    
    function getNombre(){
        return $this->nombre;
    }
    
    function getCarrito(){
        return $this->carrito;
    }
    
    function setCarrito($c){
        $this->carrito = $c;
    }
}
?>