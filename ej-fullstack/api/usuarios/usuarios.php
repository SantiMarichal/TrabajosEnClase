<?php

require_once __DIR__ . '/../../backend/models/Usuario.php';

$usuario = new Usuario();

try {

    switch ($metodo) {
        // GET /api/usuarios/
        // GET /api/usuarios/12345678
        case 'GET':
        // GET /api/usuarios/
        if($id === null){
            $usuarios= $usuario->obtenerTodos();
            echo json_encode($usuarios);
        }else{
            $usuarios = $usuario->obtenerPorCi($id);
            if($usuarios === null){
                http_response_code(404);
                echo json_encode([
                    'error'=> 'Usuario No encontrado'
            ]);
            exit;
            }
            echo json_encode($usuarios);
            } 
            
        exit;

        case 'POST':
            //POST /api/usuarios/
            $datos = json_decode(file_get_contents('php://input'), true);

            $ci = $datos['ci'];
            $nombre = $datos['nombre'];
            $apellido = $datos['apellido'];
            $user = $datos['user'];
            $password = $datos['pass'];
            $rol = $datos['rol'];

            $resultado = $usuario->crear(
                $ci,
                $nombre,
                $apellido,
                $user,
                $password,
                $rol
            );
            if ($resultado){
                http_response_code(201);
                echo json_encode(['mensaje' => 'Usuario creado correctamente']);
            }else{
                http_response_code(500);
                echo json_encode(['error' => 'No se pudo crear el usuario']);
            }


            exit;
        case 'PUT':
            
            exit;

        case 'DELETE':
            
            exit;
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e]);
}
