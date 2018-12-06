<?php



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Admin Upload</title>
    <style>
        .centrar{
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
        }
        .boton{padding: 20px 20px 20px 20px; margin: 20px 20px 20px 20px;}
    </style>
</head>
<body>

<div class="centrar">
    <button class="boton btn btn-success" onclick="location.href='../html/admin.html'">Subir Imagenes</button>
    <button class="boton btn btn-danger" onclick="location.href='../html/borrarImagenes.html'">Borrar Imagenes</button>
</div>

</body>
</html>