<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="http://localhost/servidorWebLab/TiendaLinea/public/css/style.css">
    <link rel="stylesheet" href="fonts/Roboto.css">
    <link rel="stylesheet" href="css/bulma.css">
    
</head>
<body>

    <div class="login-background-trans"></div>

    <div class="login-background">
        
        <div class="login-container">
            <div class="login-cuadro">
                <h2>
                    Login
                </h2>

                <!-- Formulario para el ingreso de sesión -->
                <form action="/servidorWebLab/TiendaLinea/public/doLogin" method="POST" class="login-form">
                    <div class="field">
                        <p class="control has-icons-left has-icons-right">
                        <!-- Nombre de usuario -->
                            <input name="usuario" class="login-text input" type="text" placeholder="Usuario">
                            <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <span class="icon is-small is-right">
                                <i class="fas fa-check"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control has-icons-left">
                        <!-- Contraseña de usuario -->
                            <input name="password" class="login-text input" type="password" placeholder="Password">
                            <span class="icon is-small is-left">
                                <i class="fas fa-lock"></i>
                            </span>
                        </p>
                    </div>

                    <!-- Error -->
                    <!-- <p class="login-error">Error en las credeciales, revise los campos</p> -->

                    <p>No tienes usuario <a href="http://localhost/servidorWebLab/TiendaLinea/public/register">Registrarse</a></p>

                    <div class="field">
                        <p class="control has-icons-left">
                            <button type="submit" class="button is-success">Ingresar</button>
                        </p>
                    </div>

                    
                </form>
            </div>
        </div>

    </div>

    <script src="js/faicon.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>