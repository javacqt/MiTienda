<?php
class Producto{
    private $id;
    private $nombre;
    private $precio;
    private $categoria;
    
    function __construct($i, $n, $p, $c){
        $this->id = $i;
        $this->nombre = $n;
        $this->precio = $p;
        $this->categoria = $c;
    }
    
    function getId(){
        return $this->id;
    }
    
    function setId($id){
        $this->id = $id;
    }
    
    function getNombre(){
        return $this->nombre;
    }
    
    function getPrecio(){
        return $this->precio;
    }
    
    function getCategoria(){
        return $this->categoria;
    }
}
?>