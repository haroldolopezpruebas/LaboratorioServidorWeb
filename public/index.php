<?php

// Inicialización para mostrar errores en etapa DEBUG
ini_set('display_erros',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

// Se incluye el archivo de gestión de base de datos
include_once '../app/DataBase.php';
// Se incluye el manejador de rutas
include_once '../app/RouterCollector.php';
// Se incluye el archivo para la utilización de funciones
// especiales
include_once '../app/helpers.php';

// Se inicia la sesión
session_start();

// Se utiliza esta función para incluir todos los controladores
// que se desean agregar automáticamente
foreach (glob("../controllers/*.php") as $filename)
    include_once '../controllers/'.$filename;

// Se utiliza esta función para incluir todos los modelos
// que se desean agregar automáticamente
foreach (glob("../models/*.php") as $filename)
    include_once '../models/'.$filename;

// Declaración del manejador de rutas
$route = new RouterCollector();
// Separación de las rutas en otro archivo
include_once '../app/routes.php';
// Ejecutar todas las rutas
$route->run();