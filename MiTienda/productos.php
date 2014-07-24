<?php
require('classes/CargadorClases.php');
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
    die("Acceso no autorizado");
}

$registro = new Registro();

$listaCategorias = $_SESSION['listaCategorias'];

if(isset($_GET['idproducto'])){
    
    // Buscar el producto en la lista de categorias, dado que esta lista
    // contiene todos los productos, siempre debería de estar
    $producto = FALSE;
    foreach ($listaCategorias as $categoria) {
        $producto = $categoria->buscarProductoPorId($_GET['idproducto']);
        if(!is_null($producto)){
            break;
        }
    }    

    $carrito = $_SESSION['usuario']->getCarrito();
    
    $carrito->agregarProducto($producto, new CarritoMapper());
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
                    <ul>
                        <li><a href="index.php">Inicio</a></li>
<?php
if(isset($_SESSION['usuario'])){
    echo <<<EOT
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
                <h1>Productos Disponibles</h1>
                <?php
                    if(is_array($listaCategorias)){
                        echo "<ul>\n";
                        foreach ($listaCategorias as $categoria) {
                            echo "    <li>{$categoria->getNombre()}\n";
                            
                            if(is_array($categoria->getListaProductos())){
                                echo "      <ul>\n";
                                foreach ($categoria->getListaProductos() as $producto) {
                                    echo "          <li>{$producto->getNombre()} - ".
                                        "<a href='{$_SERVER['PHP_SELF']}?idproducto={$producto->getId()}'>Agregar al Carrito</a></li>\n";
                                    
                                }
                                echo "      </ul>\n";
                            }
                            
                            echo "</li>\n";                
                        }
                        echo "</ul>\n";
                    }
                ?>
            </div>
        </div>
    </body>
</html>