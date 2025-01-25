<?php

namespace MVC;

class Router {
    public $routesGET = [];
    public $routesPOST = [];

    public function get($url, $fn) {
        $this->routesGET[$url] = $fn;
    }

    public function post($url, $fn) {
        $this->routesPOST[$url] = $fn;
    }

    public function comprobarRutas() {
        $urlActual = $_SERVER['REQUEST_URI'];
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET') {
            $funcion = $this->routesGET[$urlActual] ?? null;
        }else {
            $funcion = $this->routesPOST[$urlActual] ?? null;
        }

        if($funcion) {
            // La url existe y hay una función asociada a dicha url
            call_user_func($funcion, $this);
        }else {
            echo "ERROR 404. PAGE NOT FOUND";
        }
    }
}