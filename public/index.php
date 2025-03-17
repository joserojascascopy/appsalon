<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use Controllers\CitaController;
use MVC\Router;

$router = new Router;

// Iniciar Sesión

$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

// Recuperar contraseña

$router->get('/forgotpassword', [LoginController::class, 'forgot']);
$router->post('/forgotpassword', [LoginController::class, 'forgot']);
$router->get('/resetpassword', [LoginController::class, 'reset']);
$router->post('/resetpassword', [LoginController::class, 'reset']);

// Crear cuenta

$router->get('/createaccount', [LoginController::class, 'create']);
$router->post('/createaccount', [LoginController::class, 'create']);

// Confirmar cuenta

$router->get('/mensaje', [LoginController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);

// Área privada

$router->get('/cita', [CitaController::class, 'index']);

// Comprueba y válida las rutas

$router->comprobarRutas();