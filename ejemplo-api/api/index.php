<?php

$usuarios = [
    "persona1" => "Maria",
    "persona2" => "Jose",
    "persona3" => "Ana",
];

$request = $_SERVER['REQUEST_URI'];

$metodo = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json; charset=utf-8');

if ($metodo === 'GET'){
    echo json_encode([
        'mensaje' => "Hola desde GET",
        'datos' => "{$usuarios['persona1']}, {$usuarios['persona2']}, {$usuarios['persona3']}"
    ]); 
}