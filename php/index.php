            <?php
            session_start();
            $usuario = !(empty($_SESSION["usuario"])) ? $_SESSION["usuario"] : "a Tienda X Mayor";
            ?>

            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../css/bootstrap.min.css">
                <link rel="stylesheet" href="../css/main.css">
                <link rel="stylesheet" href="../css/header.css">
                <script src="../js/angular/angular.min.js"></script>

                <title>Tienda X Mayor</title>
            </head>

            <body>
                <div data-ng-app="miApp" data-ng-controller="ctrl">
                    <!-- Abre el div del body -->

                <header class="header-principal">
                        <nav>
                            <div class="menuPrincipal">
                                <ul>
                                    <li><a id="home" href="index.php">HOME</a></li>
                                    <li><a id="admin" href="admin.php">ADMINISTRADOR</a></li>
                                    <li><a id="contacto" href="../html/contacto.html">CONTACTO</a></li>
                                    <li><a id="ingresar" href="ingresar.php">INGRESAR</a></li>
                                    <li>
                                        <a href="cerrarSesion.php"><img id="imagenCerrarSesion" src="../imagenes/logout" alt="logo para cerrar sesion"></a>
                                    </li>
                                    <li>
                                        <a href="verCarrito.php"><img id="imagenCarrito" src="../imagenes/carritoRESIZE.png" alt="carrito de compras"></a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Cierra el div del menu principal -->
                        </nav>
                        <!-- Cierra el nav -->
                </header>

                    <!--Cierra el header principal -->
                    <div class="container">
                        <h1 id="titulo"> <?php echo "Bienvenido ".$usuario;?></h1>
                            <div class="contenedor-imagen-principal">
                                <img src="../imagenes/globos.jpg" alt="logo principal" class="imagen-principal">
                            </div>
                            <!-- Cierra el div de la imagen principal -->

                            <!-------------------------------PRODUCTOS -------------------------------------------->

                            <div class="jumbotron">
                                    <h1>Productos</h1>
                                <div class="row">
                                    <div id="divImagenes" class="lead col-lg-4" data-ng-repeat="(id, producto) in productos">
                                        <div class="list-group">
                                            <div class="list-group-item">
                                                <img data-ng-src="{{producto.Imagen}}" id="imagenDiv" alt="imagen del producto">
                                                <h6 class="list-group-item-heading" id="tituloProducto">{{producto.Nombre}}</h6>
                                                <span id="precio" class="list-group-item-text"><span id="signoPesos2">$</span>{{producto.Precio}}</span>
                                                <a class="btn btn-success" id="botonAgregarCarrito" href="accionCarrito.php?action=agregarAlCarrito&id='{{producto.id}}'">Agregar al Carrito</a>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- Cierra el div del row -->
                            </div> <!-- Cierra el div jumbotron -->
                    </div> <!-- Cierra el div container -->
                    <footer>
                        <p>@Tienda X Mayor S.A. 2018 - Todos los derechos e izquierdos reservados</p>
                    </footer>
                    <!-- Cierra el footer principal -->

                </div> <!-- cierra el div del body -->
                <script src="../js/index.js"></script>
            </body>

            </html>
                    
