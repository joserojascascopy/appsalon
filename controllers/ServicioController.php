<?php

namespace Controllers;

use Model\Servicios;
use Model\Usuario;
use MVC\Router;

class ServicioController {
    public static function index(Router $router) {
        isAdmin();

        $servicios = Servicios::all();

        $router->render('servicios/index', [
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios
        ]);
    }

    public static function crear(Router $router) {
        isAdmin();

        $servicio = new Servicios;
        $alertas = Usuario::getAlertas();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio = new Servicios($_POST);

            $alertas = $servicio->validarServicios();

            if(empty($alertas)) {
                $resultado = $servicio->guardar();

                if($resultado) {
                    header('Location: /servicios');
                }
            }
        }

        $router->render('servicios/crear', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function actualizar(Router $router) {
        isAdmin();
        $id = $_GET['id'];

        if(!is_numeric($id)) return;

        $servicio = Servicios::find($id);
        $alertas = Servicios::getAlertas();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST);
            
            $alertas = $servicio->validarServicios();

            if(empty($alertas)) {
                $servicio->guardar();

                header('Location: /servicios');
            }
        }

        $router->render('servicios/actualizar', [
            'nombre' => $_SESSION['nombre'],
            'alertas' => $alertas,
            'servicio' => $servicio
        ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            isAdmin();

            $id = $_POST['id'];
            if(!is_numeric($id)) return;

            $servicio = Servicios::find($id);

            $servicio->eliminar();

            header('Location: /servicios');
        }
    }
}