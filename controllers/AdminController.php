<?php

namespace Controllers;
use MVC\Router;

class AdminController {
    public static function index(Router $router) {
        session_start();
        isAuth();
        $nombre = $_SESSION['nombre'];



        $router->render('admin/index', [
            'nombre' => $nombre
        ]);
    }
}