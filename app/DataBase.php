<?php

class DataBase {

    // Atributos estáticos para la conexión de base de datos
    private static $dbHost = 'localhost';
    private static $dbName = 'tiendaLinea';
    private static $dbUser = 'root';
    private static $dbPass = 'sppawm502';

    // Iniciar conexion a la base de datos
    public static function init(){
        $conexion=new mysqli(DataBase::$dbHost, DataBase::$dbUser, DataBase::$dbPass, DataBase::$dbName);
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
    }

}

