<?php
require('classes/CargadorClases.php');
session_start();

$registro = new Registro();
$intentoAcceso = false
;

if(isset($_GET['logout'])){
        
    // Destruir todas las variables de sesión.
    $_SESSION = array();
    
    // Si se desea destruir la sesión completamente, borre también la cookie de sesión.
    // Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    // Finalmente, destruir la sesión.
    session_destroy();
}

if(isset($_POST['frmNombreUsuario'])){
    
    $usuarioMapper = new UsuarioMapper();
    $usuario = $usuarioMapper->buscarPorId($_POST['frmNombreUsuario']); 
    
    $intentoAcceso = true;
    if(!is_null($usuario)){
        $_SESSION['usuario'] = $usuario;

        // Cargar las categorias (incluye los productos)    
        $categoriaMapper = new CategoriaMapper();
        $_SESSION['listaCategorias'] = $categoriaMapper->buscarTodos();
        
        // Cargar el carrito
        $carritoMapper = new CarritoMapper();
        $carrito = $carritoMapper->buscarPorId($usuario->getNombre(), 
                                               $_SESSION['listaCategorias']);
        $carrito->setUsuario($usuario);
        $usuario->setCarrito($carrito);
        
    }
                                                         
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />

        <title>Mi Tienda - Inicio</title>
        <meta name="description" content="" />
        <meta name="author" content="Raul" />

        <link rel="shortcut icon" href="favicon.ico" />
        <link rel="stylesheet" type="text/css" href="style/estilo.css" />
    </head>
    <body> 
        <div id="main-wrapper">
            <header>
                <h1>Mi Tienda</h1>
                <nav id="nav-main">
                <?php
                if(isset($_SESSION['usuario'])){
                echo <<<EOT
                     <ul>
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="productos.php">Productos</a></li>
                        <li><a href="carrito.php">Carrito</a></li>                    
                        <li><a href="index.php?logout=true">Cerrar Sesion</a></li>
                     </ul>
                     
EOT;
                }
?>

                </nav>
            </header>
            <div id="main-content">
            <?php
            if(isset($_SESSION['usuario'])){
                echo <<<EOT
                <span class="aviso" >Bienvenido {$_SESSION['usuario']->getNombre()}</span>
                
EOT;
            }else{
                echo <<<EOT
                <form method="post" action="{$_SERVER['PHP_SELF']}" >
                    <label for="frmNombreUsuario">Usuario:</label>
                    <input type="text" name="frmNombreUsuario" id="frmNombreUsuario" />
                    <input type="submit" value="Ingresar" />
                </form>
EOT;
                if($intentoAcceso){
                    echo <<<EOT
                <span class="aviso" >Acceso no autorizado</span>
EOT;
                }
            }
            ?>

            </div>
        </div>
    </body>
</html>