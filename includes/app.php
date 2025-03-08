<?php

require 'config/database.php';
require 'funciones.php';
require __DIR__ . '/../vendor/autoload.php';
use Model\Usuario;

$db = dbConnect();

Usuario::setDB($db);