<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\ApiController;
use Controllers\LoginController;
use Controllers\CitaController;
use Controllers\AdminController;
use Controllers\ServicioController;
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

// Panel de Administrador
$router->get('/admin', [AdminController::class, 'index']);

// CRUD - Servicios
$router->get('/servicios', [ServicioController::class, 'index']);
$router->get('/servicios/crear', [ServicioController::class, 'crear']);
$router->post('/servicios/crear', [ServicioController::class, 'crear']);
$router->get('/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/servicios/eliminar', [ServicioController::class, 'eliminar']);

// API de citas

$router->get('/api/servicios', [ApiController::class, 'index']);
$router->post('/api/citas', [ApiController::class, 'guardar']);
$router->post('/api/eliminar', [ApiController::class, 'eliminar']);

// Comprueba y válida las rutas

$router->comprobarRutas();