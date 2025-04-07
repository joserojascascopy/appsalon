<?php

namespace Controllers;

use Model\Servicios;
use Model\Usuario;
use MVC\Router;
use PHPMailer\Test\PHPMailer\SetErrorTest;

class ServicioController {
    public static function index(Router $router) {
        session_start();
        isAdmin();

        $router->render('servicios/index', [
            'nombre' => $_SESSION['nombre']
        ]);
    }

    public static function crear(Router $router) {
        session_start();
        isAdmin();

        $servicios = new Servicios;
        $alertas = Usuario::getAlertas();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicios = new Servicios($_POST);

            $alertas = $servicios->validarServicios();
        
        }

        $router->render('servicios/crear', [
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios,
            'alertas' => $alertas
        ]);
    }

    public static function actualizar(Router $router) {
        session_start();
        isAdmin();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }

        $router->render('servicios/actualizar', [
            'nombre' => $_SESSION['nombre']
        ]);
    }

    public static function eliminar(Router $router) {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }
    }
}