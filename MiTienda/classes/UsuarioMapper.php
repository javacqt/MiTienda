<?php
class UsuarioMapper extends MapperBD{
    
    function __construct(){
        parent::__construct();
        
        $this->selectStmt = $this->PDO->prepare(
            "SELECT * FROM tblusuarios WHERE nombreusuario = :nombreusuario");
        $this->selectAllStmt = $this->PDO->prepare(
            "SELECT * FROM tblusuarios");
        $this->insertStmt = $this->PDO->prepare(
            "INSERT INTO tblusuarios (nombreusuario) VALUES (:nombreusuario)");
        $this->updateStmt = $this->PDO->prepare(
            "UPDATE tblusuarios SET nombreusuario=:nombreusuarioNuevo WHERE 
            nombreusuario=:nombreusuarioActual");
    }
    
   // Se retorna un Usuario con un carrito == null     
   function buscarPorId($id){
       try{
           $this->selectStmt->execute(array('nombreusuario' => $id));
           $r = $this->selectStmt->fetch();
           
           if($r){
               return new Usuario($r['nombreusuario'], null);
           }else{
               return null;
           }
       }catch(Exception $e){
           throw new Exception("Error al ubicar el usuario");
       }
   }
   function buscarTodos(){
       throw new Exception("Error metodo no implementado");
   }
   function insertar($obj){
       throw new Exception("Error metodo no implementado");
   }
   function actualizar($obj){
       throw new Exception("Error metodo no implementado");
   }
   function borrar($obj){
       throw new Exception("Error metodo no implementado");
   }
}
?>