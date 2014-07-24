<?php
class Categoria {
    private $id;
    private $nombre;
    private $listaProductos;
    
    function __construct($i, $n, $lp){
        $this->id = $i;
        $this->nombre = $n;
        $this->listaProductos = $lp;
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
    
    function getListaProductos(){
        return $this->listaProductos;
    }
    
    function setListaProductos($lp){
        $this->listaProductos = $lp;
    }
    
    function buscarProductoPorId($id){
        
        foreach ($this->listaProductos as $producto) {
            if($producto->getId() == $id){
                return $producto;
            }
        }
        
        return null;
    }
    
}
?>