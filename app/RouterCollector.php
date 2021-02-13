<?php

class RouterCollector {

    // Declaración de atributos donde se guardaran la deficion
    // de rutas
    private $uri = array();
    private $handler = array();

    // Metodos para el acceso desde el archivo de rutas
    public function get($uri, $handler = null) {
        $this->add('GET',$uri,$handler);
    }
    public function post($uri, $handler = null) {
        $this->add('POST',$uri,$handler);
    }

    // función para agregar la urta en el arreglo de uls y handlers
    private function add($method,$uri, $handler = null) {
        $this->uri[] = '/' . trim($uri, '/');
        if ($handler != null) $this->handler[] = $handler;
    }

    // Función para ejecutar las funciones guardadas
    private function runHandler($handler) {
        if($handler instanceof \Closure) {
            $handler();
        }  
        else {
            $params = explode('@', $handler);
            $obj = new $params[0];
            echo $obj->{$params[1]}();
        }
    }

    // Función ejecutada desde index para ejecutar la ruta que se está ejecutando
    public function run() {

        $uriGet = isset($_GET['uri']) && $_GET['uri'] != "index.php"  ? '/' . $_GET['uri'] : '/';

        foreach ($this->uri as $key => $value) {
            if (preg_match("#^$value$#", $uriGet)) {
                $handler = $this->handler[$key];
                $this->runHandler($handler);
            }
        }
    }

}

?>