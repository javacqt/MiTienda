<?php
/**
 * 
 */
class CarritoMapper extends MapperBD {
    
    function __construct(){
        parent::__construct();
        
        //Preparar las sentencias SQL
        $this->selectStmt = $this->PDO->prepare(
            "SELECT * FROM tblcarritos WHERE nombreusuario = :nombreusuario");
        $this->updateStmt = $this->PDO->prepare(
            "UPDATE tblcarritos SET cantidadproducto = :cantidadproducto WHERE ".
            "nombreusuario = :nombreusuario AND idproducto = :idproducto");
        $this->insertStmt = $this->PDO->prepare(
            "INSERT INTO tblcarritos (nombreusuario, idproducto, cantidadproducto) VALUES ".
            "(:nombreusuario, :idproducto, :cantidadproducto)");
        $this->deleteStmt = $this->PDO->prepare(
            "DELETE FROM tblcarritos WHERE ".
            "nombreusuario = :nombreusuario AND idproducto = :idproducto");
     }
     
    // Se retorna un Carrito con el usuario == null, intenta cargar los productos desde la base
    // de datos si este existe
    public function buscarPorId($nombreusuario){
        try{
            $listaCategorias = func_get_arg(1);
            
            $this->selectStmt->execute(array('nombreusuario' => $nombreusuario));
            
            $listaProductosCantidad = array();
            
            // Cargar productos al carrito
            while($r = $this->selectStmt->fetch()){
                
                // Buscar el producto en la lista de categorias, dado que esta lista
                // contiene todos los productos, siempre debería de estar
                $productoEncontrado = FALSE;
                foreach ($listaCategorias as $categoria) {
                    $productoEncontrado = $categoria->buscarProductoPorId($r['idproducto']);
                    if(!is_null($productoEncontrado)){
                        
                        break;
                    }
                }
                
                // Sino se encuentra el producto se lanza una excepcion
                if(is_null($productoEncontrado)){
                    throw new Exception();
                }
                
                $listaProductosCantidad[] = new ProductoCantidad($productoEncontrado, 
                                                                 $r['cantidadproducto']);          
            }
            
            return new Carrito(null, $listaProductosCantidad);
            
        }catch(Exception $e){
            throw new Exception("Error al cargar el carrito". $e->getMessage().$e->getLine());
        }
    }

    public function buscarTodos(){
        throw new Exception("Error metodo no implementado");
    }

    public function insertar($carrito){
        try{
            $producto = func_get_arg(1);
            
            $this->insertStmt->execute(array(
                'nombreusuario' => $carrito->getUsuario()->getNombre(),
                'idproducto' => $producto->getId(),
                'cantidadproducto' => 1));
                
            echo "INSERTANDO CARRITO:";
            print_r($carrito);
            
        }catch(Exception $e){
            throw new Exception("No se pudo insertar el producto");    
        }
    }
    
    public function actualizar($carrito){
        try{
            $producto = func_get_arg(1);
            $cantidad = func_get_arg(2);
            
            $this->updateStmt->execute(array(
                'nombreusuario' => $carrito->getUsuario()->getNombre(),
                'idproducto' => $producto->getId(),
                'cantidadproducto' => $cantidad));
                
            echo "ACTUALIZANDO CARRITO:";
            print_r($carrito);
                
        }catch(Exception $e){
             throw new Exception("No se pudo actualizar el carrito");  
        }
    }
    
    
    public function borrar($obj){
       throw new Exception("Error metodo no implementado");
    }
}
?>