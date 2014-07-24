<?php
abstract class MapperBD {

    protected $PDO;
    
    protected $selectStmt;
    protected $insertStmt;
    protected $updateStmt;
    protected $deleteStmt;
    
    function __construct(){
        if(!isset($PDO)){
            $this->PDO = Registro::$PDO;
        }
    }
    
    abstract function buscarPorId($id);
    abstract function buscarTodos();
    abstract function insertar($obj);
    abstract function actualizar($obj);
    abstract function borrar($obj);
    
}
?>