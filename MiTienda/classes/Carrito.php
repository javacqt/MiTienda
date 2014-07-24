<?php
class Carrito{
    private $usuario;
    private $listaProductosCantidad;
    
    function __construct($u, $lpc){
        $this->usuario = $u;
        $this->listaProductosCantidad = $lpc;
    }
    
    function setUsuario($u){
        $this->usuario = $u;
    }
    function getUsuario(){
        return $this->usuario;
    }
    
    function getListaProductosCantidad(){
        return $this->listaProductosCantidad;
    }
    
    function agregarProducto($producto, $mapper){
        
        //Buscar si el producto ya está en el carrito
        $productoCantidadEncontrado = FALSE;
        foreach ($this->listaProductosCantidad as $productoCantidad) {
            if($productoCantidad->producto->getId() == $producto->getId()){
                //Guardar el indice del producto cantidad encontrado
                $productoCantidadEncontrado = $productoCantidad;
                break;
            }
        }

        //El producto no se encontró, hay que insertarlo
        if($productoCantidadEncontrado === FALSE){
            $this->listaProductosCantidad[] = new ProductoCantidad($producto, 1);
            $mapper->insertar($this, $producto);   
            
        //El producto sí se encontró, hay que aumentar su cantidad
        }else{
            $productoCantidadEncontrado->cantidad++;
            $mapper->actualizar($this, $producto, $productoCantidadEncontrado->cantidad); 
        }
    }
}
?>
