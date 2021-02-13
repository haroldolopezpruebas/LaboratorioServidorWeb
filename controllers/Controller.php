<?php

class Controller {

    // Función que muestra la vista de inicio
    public function inicio() {
        view('inicio');
    }

    // Función que muestra la vista de inicio de sesión
    // si no está logeado mostrará la vista de inicio
    public function login() {
        if(!isset($_SESSION['usuario']))
            view('login');
        else
            view('inicio');
    }

    // Función para mostrar el formulario de registro
    public function register() {
        view('register');
    }

}
