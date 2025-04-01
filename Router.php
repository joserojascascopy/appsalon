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
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        // // Proteger las rutas
        // session_start();
        // // Arreglo de rutas protegidas
        // $protectedRoutes = ['/cita'];

        // $auth = $_SESSION['login'] ?? false;

        // if(in_array($urlActual, $protectedRoutes) && !$auth) {
        //     header('Location: /');
        // }

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

    public function render($view, $datos = []) {
        foreach($datos as $key => $value) {
            $$key = $value;
        }

        ob_start(); // Almacena en memoria durante un momento...
        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); // Limpia el buffer

        include __DIR__ . "/views/layout.php";
    }
}