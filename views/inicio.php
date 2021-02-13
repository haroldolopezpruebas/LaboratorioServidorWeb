<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio 1</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="fonts/Roboto.css">
    
</head>
<body>

    <!-- alerts -->
    <div class="alert alert-success"></div>

    <!-- modal -->

    <div id="modal">
        <div class="modal-wrapper"></div>
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-title">
                    Carrito de compras
                </div>
                <span id="modal-close" class="modal-header-icon">
                    <i class="fas fa-times"></i>
                </span>
            </div>
            <div class="modal-body">

                <div class="modal-body-options">
                    <button class="btn-erase"><i class="fas fa-eraser"></i> &nbsp; Borrar todo</button>
                    <button class="btn-check"><i class="fas fa-money-check"></i> &nbsp; Pagar productos</button>
                </div>

                <table id="tabla-productos">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Artículo</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

                <div class="pago">
                    <form action="http://localhost/servidorWebLab/TiendaLinea/public/doPago"></form>
                    <table>
                        <tr>
                            <td>No. tarjeta</td>
                            <td><input class="pagar-input" type="text" name="tarjeta" id=""></td>
                        </tr>
                        <tr>
                            <td>Fecha</td>
                            <td><input class="pagar-input" type="date" name="fecha" id=""></td>
                        </tr>
                        <tr>
                            <td>CVV</td>
                            <td><input class="pagar-input" type="number" name="CVV" id=""></td>
                        </tr>
                        <tr>
                            <td><button id="finalizar" class="btn-pagar"><i class="fas fa-money-check"></i> &nbsp; Finalizar</button></td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- ------------- -->




    <header>
        <div class="navbar-wrapper">
            <nav class="navbar-menu">
                <div class="navbar-menu-right">
                    <p class="logo">Mi tienda</p>
                </div>
                <div class="navbar-menu-left">
                    <li class="nav-list">
                        


                        <?php
                            // Validación de la sesión existe
                            // Si no está activa la sesión se ejecuta
                            if(!isset($_SESSION["usuario"])){
                        ?>
                        
                        <!-- Se borra el almacenamiento local de productos -->
                        <script>window.localStorage.clear()</script>

                        <!-- Menú para Login de usuario -->
                        <ul class="nav-item">
                            <a class="nav-link" href="/servidorWebLab/TiendaLinea/public/login"><i class="fas fa-shopping-cart"></i>&nbsp; Login</a>
                        </ul>
                        

                        <?php
                            // Si está activa la sesión se ejecuta este bloque
                            }else {
                        ?>

                        <!-- Menú de tienda en linea, carrito de compra, nombre de usuario y logout -->

                        <ul class="nav-item">
                            <a class="nav-link" href="#productos-header"><i class="fas fa-store"></i>&nbsp; Tienda en linea</a>
                        </ul>

                        <ul class="nav-item">
                            <a class="nav-link" id="openModal" href="#"><i class="fas fa-shopping-cart"></i>&nbsp; Carrito de compras</a>
                        </ul>

                        <ul class="nav-item">
                            <a class="nav-link" id="openModal" href="/servidorWebLab/TiendaLinea/public/login">
                                <?php
                                    // Se muestra el nombre de usuario obtenido en la sesión si está activa
                                    echo $_SESSION['usuario'][0];
                                ?>
                            </a>
                        </ul>

                        <ul class="nav-item">
                            <a class="nav-link" id="openModal" href="/servidorWebLab/TiendaLinea/public/logout">Cerrar sesión</a>
                        </ul>

                        <?php
                            }
                        ?>


                    </li>
                </div>
            </nav>
        </div>
    </header>

    <div class="container-header">
        <div class="header-descrip">
            <h1>Bienvenido a su tienda en linea...</h1>
            <p>
                En esta tienda puede realizar todas las compras que necesita tu hogar, aproveche nuestras ofertas que duran todo el año y más..
                <br>
                Aquí encontrará una variedad de productos a precios muy accesibles. 
            </p>
        </div>
        <div class="header-div-img">
            <img class="header-img" class="banner" src="images/onlineshop.jpg" alt="">
        </div>
    </div>


    <!-- Sección de productos solo se muestra si el usuario está logeado -->

    <?php
        if(isset($_SESSION["usuario"])){
    ?>

    <h1 id="productos-header" class="productos-header">Nuestros productos</h1>

    <div class="content-tienda">

        <!-- Los productos se rederizan en JavaScript haciendo una llamada POST al servidor -->
        <div class="productos-wrapper">
            <div id="mostrar-productos" class="productos-grid">
            </div>
        </div>

    </div>

    <?php
        }
    ?>

    <footer>
        <div>
            Número de contacto (+502) 3366 9944 <br>
            Esta tienda tiene todos los derechos reservados <br>
            Dirección administrativa 10 av 36-89 zona 30 Ciudad de Guatemala <br>
            
                <i class="fab fa-facebook-square"></i>
                <i class="fab fa-instagram-square"></i>
                <i class="fab fa-twitter-square"></i>
        </div>
    </footer>

    <script src="js/faicon.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>