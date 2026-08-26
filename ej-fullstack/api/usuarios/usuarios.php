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
            $user_name = $datos['user_name'];
            $password = $datos['password'];
            $rol = $datos['rol'];

            $resultado = $usuario->crear(
                $ci,
                $nombre,
                $apellido,
                $user_name,
                $password,
                $rol
            );
            exit;
        case 'PUT':
            
            exit;

        case 'DELETE':
            
            exit;
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error en la base de datos']);
}
