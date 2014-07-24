<?php
require('classes/CargadorClases.php');
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
    die("Acceso no autorizado");
}


$listaProductosCantidad = $_SESSION['usuario']->getCarrito()->getListaProductosCantidad();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />

        <title>Mi Tienda - Carrito</title>
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
                <h1>Carrito de Compras</h1>
                <?php
                    echo "<table>\n";
                    echo "    <tr><th></th><th>Producto</th><th>Cantidad</th><tr/>\n";
                    foreach ( $listaProductosCantidad as $productoCantidad) {
                        echo "    <tr>";
                        echo "        <td><a href='{$_SERVER['PHP_SELF']}?del=".
                            "{$productoCantidad->producto->getId()}'>[x]</a></td>\n";
                        echo "        <td>{$productoCantidad->producto->getNombre()}</td>\n";
                        echo "        <td>{$productoCantidad->cantidad}</td>\n";
                        echo "    </tr>\n";
                    }
                ?>
            </div>
        </div>
    </body>
</html>