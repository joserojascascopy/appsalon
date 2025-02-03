<?php

function dbConnect() {
    $db = new mysqli('localhost', 'root', 'admin', 'appsalon_mvc');

    if(!$db) {
        echo "No se ha podido establecer la conexión con la base de datos";
    }

    return $db;
}

// $db = new mysqli('localhost', 'root', 'admin', 'appsalon');

// if($db) {
//     echo "Conectado correctamente...";
// }