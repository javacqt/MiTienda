<?php
class CategoriaMapper extends MapperBD {
    
     function __construct(){
        parent::__construct();
        
        //Preparar las sentencias SQL
        $this->selectStmt = $this->PDO->prepare(
            "SELECT * FROM ".
            "tblcategorias INNER JOIN tblproductos USING(idcategoria) WHERE idcategoria = :idcategoria");
        $this->selectAllStmt = $this->PDO->prepare(
            "SELECT * FROM tblcategorias INNER JOIN tblproductos USING(idcategoria)");
        // FALTAN EL RESTO DE LAS SENTENCIAS
     }
     
    public function buscarPorId($idcategoria){
        $this->selectStmt->execute(array('idcategoria' => $idcategoria));
        $r = $this->selectStmt->fetch();
        
        if($r){
            $categoria = new Categoria($idcategoria, $r['nombrecategoria'], null);
            
            $listaProductos[] = new Producto($r['idproducto'],
                                             $r['nombreproducto'],
                                             $r['precioproducto'], $categoria);
            while($r = $this->selectStmt->fetch()){
                $listaProductos[] = new Producto($r['idproducto'],
                                                 $r['nombreproducto'],
                                                 $r['precioproducto'], $categoria);
            }
            $categoria->setListaProductos($listaProductos);
            
            return $categoria;
        }else{
            return null;
        }
        
    }
    
    // Carga los productos de cada categoria a partir de la consulta (una sola consulta)
    // Una forma más fácil pero menos eficiente seria, hacer una consulta de los productos
    // para cada categoria leida
    public function buscarTodos(){
        $this->selectAllStmt->execute();
        $r = $this->selectAllStmt->fetch();
        
        if($r){
            // Se crea y se agrega la primera categoria y su primer producto
            $categoria = new Categoria($r['idcategoria'], $r['nombrecategoria'], null);
            
            $listaCategorias[] = $categoria;
            $listaProductos[] = new Producto($r['idproducto'],
                                             $r['nombreproducto'],
                                             $r['precioproducto'], $categoria);
    
            // Se lee el resto de las categorias y productos
            while($r = $this->selectAllStmt->fetch()){
                
                // Cuando el idcategoria cambia, es porque hay una nueva categoria que agregar
                if($categoria->getId() != $r['idcategoria']){
                    $categoria->setListaProductos($listaProductos);
                    $listaProductos = array();
                    $categoria = new Categoria($r['idcategoria'], $r['nombrecategoria'], null);
                    $listaProductos[] = new Producto($r['idproducto'],
                                                     $r['nombreproducto'],
                                                     $r['precioproducto'], $categoria);
                    $listaCategorias[] = $categoria;
                // Cuando el idcategoria es el mismo, solo hay que agregar el producto
                }else{
                    $listaProductos[] = new Producto($r['idproducto'],
                                                     $r['nombreproducto'],
                                                     $r['precioproducto'], $categoria);
                }
            }
            // Se agregan los productos de la ultima categoria
            $categoria->setListaProductos($listaProductos);
            
            return $listaCategorias;
        }else{
            return null;
        }
    }

    public function insertar($objeto){
        throw new Exception('Metodo no implementado');
    }
    
    public function actualizar($objeto){
        throw new Exception('Metodo no implementado');
    }
    public function borrar($obj){
       throw new Exception("Error metodo no implementado");
    }
}
?>