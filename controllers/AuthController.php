<?php

// Controlador para el manejo de la sesión del usuario
// Se hace uso del modelo User
class AuthController {

    // Función para el inicio de sesión
    public function doLogin(){
        (new User($_POST["usuario"],$_POST["password"]))->revCredenciales();
        view('inicio');
    }
    
    // Función para el registro de usuarios
    public function doRegister(){
        (new User($_POST["usuario"],$_POST["password"]))->add();
        view('login');
    }

    // Función para el cerrado de sesión
    public function logout() {
        $_SESSION = array();
        session_destroy();
        view('inicio');
    }
}
