<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use MVC\Router;

$router = new Router;

// Iniciar Sesión

$router->get('/', [LoginController::class, 'login']);

// Comprueba y válida las rutas

$router->comprobarRutas();