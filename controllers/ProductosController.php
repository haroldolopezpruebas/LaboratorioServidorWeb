<?php

// Controlador para la administración de productos
class ProductosController {

    // Función para obtener todos los productos
    public function getAllProducts() {
        return (new Producto())->getAll();
    }
    
    // Función para realizar pago
    public function doPago() {
        return (new Producto())->doPago();
    }

}


