<?php

if (! function_exists('view')) {
    // Función para llamar al archivo de vista especificado
    function view($view = null, $params = []){
        require_once("../views/".$view.".php");
    }
}

