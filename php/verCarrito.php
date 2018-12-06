<?php

include 'carrito.php';
$cart = new Carrito;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Carrito de compras</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <style>
        .container{padding: 50px;}
        input[type="number"]{width: 20%;}
        h1{margin-bottom: 40px}

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
    
    <script>
		
    function actualizarItem(obj,id){
        $.get("accionCarrito.php", {action:"actualizarItem", id:id, cantidad:obj.value}, function(data){
            if(data == 'ok'){
                location.reload();
            }else{
                location.reload();
            }
        });
    }
    </script>
</head>

<body>
<div class="container">
    <h1>Mi carrito de compras</h1>
    <table class="table">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th id="cantidad">Cantidad</th>
            <th id="subtotal">Subtotal</th>
            <th> </th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($cart->total_items() > 0){
            // toma los items del carrito
            $cartItems = $cart->contiene();
            foreach($cartItems as $item){
        ?>
        <tr>
            <td><?php echo $item["nombre"]; ?></td>
            <td><?php echo 'AR$'.$item["precio"]; ?></td>
            <td id="cantidad"><input type="number" class="form-control text-center" value="<?php echo $item["cantidad"]; ?>" onchange="actualizarItem(this, '<?php echo $item['rowid']; ?>')"></td>
            <td id="subtotal"><?php echo 'AR$'.$item["subtotal"]; ?></td>
            <td>
                <a href="accionCarrito.php?action=remover&id=<?php echo $item["rowid"]; ?>" class="btn btn-danger" onclick="return confirm('Está seguro que desea quitar este producto del carrito?')"><i class="glyphicon glyphicon-trash"></i></a>
            </td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="5"><p>Tu carrito está vacio.....</p></td>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td><a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Volver a productos</a></td>
            <td colspan="2"></td>
            <?php if($cart->total_items() > 0){ ?>
            <td class="text-center"><strong>Total <?php echo '$'.$cart->total(); ?></strong></td>
            <td><a href="check-out.php" class="btn btn-success btn-block">Checkout <i class="glyphicon glyphicon-menu-right"></i></a></td>
            <?php } ?>
        </tr>
    </tfoot>
    </table>
    
</div> <!-- Cierra el div del container -->
</body>
</html>