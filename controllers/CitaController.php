<?php

namespace Controllers;

use DateTime;
use MVC\Router;

class CitaController {
    public static function index(Router $router) {
        $date = date('Y-m-d', strtotime('+1 day'));

        session_start();

        $router->render('cita/index', [
            'nombre' => $_SESSION['nombre'],
            'date' => $date
        ]);
    }
}