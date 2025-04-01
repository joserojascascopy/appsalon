<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {
    public static function login(Router $router) {
        $alertas = Usuario::getAlertas();
        $auth = new Usuario;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);

            $alertas = $auth->validarLogin();

            if(empty($alertas)) {
                // Verificar si el usuario existe
                $usuario = $auth::where('email', $auth->email);
                // Si existe, verificar si la contraseña es correcta y si la cuenta esta confirmada
                if($usuario) {
                    if($usuario->comprobarPasswordAndVerificado($auth->password)) {
                        // Autenticar el usuario
                        session_start();
                        
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        // Redireccionar

                        if(!$usuario->admin) {
                            header('Location: /cita');
                        }else {
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                        }
                    }
                }else {
                    $alertas = Usuario::setAlerta('error', 'Usuario no encontrado');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/login', [
            'alertas' => $alertas,
            'auth' => $auth
        ]);
    }

    public static function logout() {
        session_start();

        $_SESSION = [];

        header('Location: /');
    }

    public static function forgot(Router $router) {
        $alertas = Usuario::getAlertas();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            
            $alertas = $auth->validarRecuperar();

            if(empty($alertas)) {
                // Verificar si existe el usuario
                $usuario = Usuario::where('email', $auth->email);
                
                if($usuario && $usuario->confirmado) {
                    // Actualizar el token
                    $usuario->generarToken();
                    // Enviar el correo con el enlace para poder recuperar su contraseña
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);

                    $email->enviarRecuperacion();

                    // Actualizar la base de datos con el nuevo token
                    $resultado = $usuario->guardar();

                    if($resultado) {
                        $alertas = Usuario::setAlerta('exito', 'Se ha enviado un correo para poder recuperar su contraseña');
                    }
                }else {
                    $alertas = Usuario::setAlerta('error', 'Usuario no existe o no esta confirmado');
                }
            }
        }

        $router->render('auth/forgot', [
            'alertas' => $alertas
        ]);
    }

    public static function reset(Router $router) {
        $alertas = Usuario::getAlertas();
        $error = false;

        $token = $_GET['token'];

        // Buscar usuario por medio del token

        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            $alertas = Usuario::setAlerta('error', 'Token No Válido');
            $error = true;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = new Usuario($_POST);

            $alertas = $password->validarPassword();

            if(empty($alertas)) {
                // Eliminamos la contraseña anterior
                $usuario->password = null;
                // Asignamos la nueva contraseña
                $usuario->password = $password->password;
                // Hasheamos la nueva contraseña
                $usuario->hashPassword();
                // Eliminamos el token
                $usuario->token = '';
                // Actualizamos la base de datos
                $resultado = $usuario->guardar();

                if($resultado) {
                    $alertas = Usuario::setAlerta('exito', 'Contraseña reestablecida');
                }
            }
        }

        $router->render('auth/reset-password', [
            'alertas' => $alertas,
            'error' => $error
        ]);
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

                    // Crear el usuario (Guardar en la DB)

                    $resultado = $usuario->guardar();

                    if($resultado) {
                        header('Location: /mensaje');
                    }
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

    public static function confirmar(Router $router) {
        $alertas = Usuario::getAlertas();

        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            // Mostrar mensaje de error
            $alertas = Usuario::setAlerta('error', 'Token no válido');

        }else {
            // Modificar a usuario confirmado
            $usuario->confirmado = '1';
            // Eliminar token
            $usuario->token = ''; // htmlspecialchars() está recibiendo un valor null en lugar de una cadena (string), lo cual es un comportamiento obsoleto en versiones recientes de PHP. Por eso le pasamos una cadena vacía.
            // Actualizar el usuario
            $usuario->guardar();
            // Mostrar alerta de exito
            $alertas = Usuario::setAlerta('exito', 'Usuario confirmado');
        }

        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router) {

        $router->render('auth/mensaje', []);
    }
}