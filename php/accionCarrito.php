
<?php
include 'carrito.php';
include 'conexion.php';

$carrito = new Carrito;

if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
	
    if($_REQUEST['action'] == 'agregarAlCarrito' && !empty($_REQUEST['id'])){
        $productID = $_REQUEST['id'];
        // toma los detalles del producto

        // FIX ME: No debería comparar ID de Producto con ID de BD
        
        $query = $link->query("SELECT * FROM Productos WHERE id = ".$productID);
        $row = $query->fetch_assoc();
        $datosItem = array(
            'id' => $row['id'],
            'nombre' => $row['Nombre'],
            'precio' => $row['Precio'],
            'cantidad' => 1
        );
        
        $insertar_Item = $carrito->insert($datosItem);
        $redireccionar = $insertar_Item?'verCarrito.php':'index.php';
        header("Location: ".$redireccionar);
    }
	
	else if($_REQUEST['action'] == 'actualizarItem' && !empty($_REQUEST['id'])){
        $datosItem = array(
            'rowid' => $_REQUEST['id'],
            'cantidad' => $_REQUEST['cantidad']
        );
        $actualizar_Item = $carrito->actualizar($datosItem);
        echo $actualizar_Item?'ok':'err';die;
    }
	
	elseif($_REQUEST['action'] == 'remover' && !empty($_REQUEST['id'])){
        $borrar_Item = $carrito->remover($_REQUEST['id']);
        header("Location: verCarrito.php");
    }
	
    }else{
        header("Location: index.php");
    }