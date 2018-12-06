<?php

include 'conexion.php';
include 'carrito.php';

$cart = new Carrito;

// si el carrito está vacio, redirecciona al index
if($cart->total_items() <= 0){
    header("Location: index.php");
}

// setea el ID de sesion del cliente
$_SESSION['IDsesCliente'] = 1;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> <!-- Antes de que me digas algo, lo levanto así porque local no me anda -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    .container{width: 100%;padding: 50px;}
    .table{width: 65%;float: left;}
    .btnIndex{width: 95%;float: left;}
    .btnComprar {float: right;}
    @media (max-width: 560px) {
            .container table{
                width: 80%;
            }
            table th{display: inline-block;}
            table tr{display: inline-block;}
            table td{display: inline-block;}
            #cantidad{display: none}
            #subtotal{display: none}
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Vista previa de su orden</h1>
    <table class="table">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th id="cantidad">Cantidad</th>
            <th id="subtotal">Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($cart->total_items() > 0){
            //get cart items from session
            $cartItems = $cart->contiene();
            foreach($cartItems as $item){
        ?>
        <tr>
            <td><?php echo $item["nombre"]; ?></td>
            <td><?php echo '$'.$item["precio"]; ?></td>
            <td id="cantidad"><?php echo $item["cantidad"]; ?></td>
            <td id="subtotal"><?php echo '$'.$item["subtotal"]; ?></td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="4"><p>Su carrito está vacio......</p></td>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3"></td>
            <?php if($cart->total_items() > 0){ ?>
            <td class="text-center"><strong>Total <?php echo '$'.$cart->total(); ?></strong></td>
            <?php } ?>
        </tr>
    </tfoot>
    </table>

    <div class="btnIndex">
        <a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Volver a Productos</a>
        <a href="accionCarrito.php" class="btn btn-success btnComprar">Comprar <i class="glyphicon glyphicon-menu-right"></i></a>
    </div>
</div>
</body>
</html>