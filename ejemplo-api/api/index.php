<?php

/*echo json_encode([ 
    'mensaje' => "Hola desde la API"
]);
*/

header('Content-Type: application/json');

/*
$pj = [
'nombre' => 'Jason Voorhees',
'origen' => 'Viernes 13',
'debut' => 1980,
'arma_principal' => 'Machete',
'caracteristicas' => [
'Usa una máscara de hockey',
'Fuerza sobrehumana',
'No habla'
],
'estado' => 'Inmortal'
];
echo json_encode($pj);
*/

$uri = $_SERVER['REQUEST_URI'];
$uri2 = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
echo json_encode([
    'mensaje' => "$uri $uri2"
]);
$metodo = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// Dividir URL en segmentos
$segmentos = explode('/', trim($uri, '/'));
echo json_encode([
    'mensaje' => implode($segmentos)
]);
echo json_encode([
    'mensaje' => implode(", ", $segmentos)
]);
// Removemos todo hasta quedarnos con el recurso o recursos
if ($segmentos[0] == 'ejemplo-api') {
    array_shift($segmentos);
    if ($segmentos[0] == 'api') {
        array_shift($segmentos);
    }
}
$recurso = $segmentos[4] ?? '';
$id = $segmentos[5] ?? null;
echo json_encode([
    'mensaje' => "$recurso | $id"
]);

if ($recurso === "usuarios") {
    switch ($metodo) {
        case 'GET':
            if ($id === null) {
                echo json_encode([
                    'mensaje' => "Lista de usuarios"
                ]);
                //Llama a una funcion que tenga SELECT * FROM usuarios
            } else {
                echo json_encode([
                    'mensaje' => "Usuario",
                    'id' => $id
                ]);
                //Llama a una funcion que tenga SELECT * FROM usuarios WHERE id=5
            }
            exit;
        case 'POST':
            $datos = json_decode(file_get_contents('php://input'), true);
            echo json_encode([
                'mensaje' => 'Usuario creado',
                'datos' => $datos
            ]);
            exit;
        case 'PUT':
            if ($id === null) {
                http_response_code(404);
                echo json_encode([
                    'mensaje' => 'El ID es necesario'
                ]);
            } else {
                $datos = json_decode(file_get_contents('php://input'), true);
                echo json_encode([
                    'mensaje' => 'Usuario modificado',
                    'datos' => $datos
                ]);
            }
            exit;
        case 'DELETE':
            if ($id === null) {
                http_response_code(404);
                echo json_encode([
                    'mensaje' => 'El ID es necesario'
                ]);
            } else {
                $datos = json_decode(file_get_contents('php://input'), true);
                echo json_encode([
                    'mensaje' => 'Usuario borrado',
                    'datos' => $datos
                ]);
            }
            exit;
    }
}

