<?php

namespace Controllers;

use Classes\Email;
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
        $alertas = Usuario::getAlertas();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);

            $alertas = $usuario->validarNuevaAcc();

            // Revisar que alerta este vacio
            if(empty($alertas)) {
                // Verificar que el usuario no este registrado
                $resultado = $usuario->findEmail();

                if($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                }else {
                    // Hash el password
                    $usuario->hashPassword();

                    // Generar un token unico
                    $usuario->generarToken();

                    // Enviar el email

                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);

                    $email->enviarConfirmacion();
                }
            }

            // Mi forma de hacer antes de ver el video (Codigo del curso arriba)

            // if(empty($alertas)) {
            //     // Verificar que el usuario no este registrado
            //     $usuarioVerificado = $usuario::findEmail($usuario->email);
            //     if($usuarioVerificado->num_rows == 0) {
            //         echo "No se registro aun";
            //     }else {
            //         $alertas['error'][] = 'Ya posee una cuenta con este email';
            //     }
            // }
        }

        $router->render('auth/create', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
}