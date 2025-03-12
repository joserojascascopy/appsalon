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