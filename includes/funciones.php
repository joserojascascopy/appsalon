<?php 

function debugger($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function s($html) {
    $s = htmlspecialchars($html);
    return $s;
}

// Función que revisa si el usuario esta autenticado

function isAuth() : void {
    if(!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

function isAdmin() : void {
    if(!isset($_SESSION['admin'])) {
        header('Location: /');
    }
}

function esUltimo(string $actual, string $proximo) : bool {
    if($actual !== $proximo) {
        return true;
    }else {
        return false;
    }
}