<?php

namespace Controllers;

use Model\Usuario;
use MVC\Router;

class LoginController {
    public static function login(Router $router) {


        $router->render('auth/login', [

        ]);
    }

    public static function logout() {
        echo "Cerrando sesión...";
    }

    public static function forgot(Router $router) {
        $router->render('auth/forgot', [

        ]);
    }

    public static function reset() {
        echo "Contraseña recuperada";
    }

    public static function create(Router $router) {
        $usuario = new Usuario;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);

            debugger($usuario);
        }

        $router->render('auth/create', [
            'usuario' => $usuario
        ]);
    }
}