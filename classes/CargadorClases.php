<?php

class CargadorClases {

    static public function cargarClase($nombre) {
        require("classes/$nombre.php");
    }
    
}

spl_autoload_register(__NAMESPACE__ .'\CargadorClases::cargarClase');

?>
