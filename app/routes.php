<?php

// Rutas para manejo de vistas
$route->get('/','Controller@inicio');
$route->get('/home','Controller@home');
$route->get('/login','Controller@login');
$route->get('/register','Controller@register');

// Rutas para realizar acciones de sesión
$route->post('/doLogin','AuthController@doLogin');
$route->post('/doRegister','AuthController@doRegister');
$route->post('/logout','AuthController@logout');

// Rutas para administración de productos
$route->get('/getAllProducts','ProductosController@getAllProducts');
$route->post('/doPago','ProductosController@doPago');


