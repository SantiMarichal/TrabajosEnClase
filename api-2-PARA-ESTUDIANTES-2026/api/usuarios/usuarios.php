<?php

require_once __DIR__ . '/../../backend/models/Usuario.php';
require_once __DIR__ . '/../../backend/models/Pokemon.php';
require_once __DIR__ . '/../../backend/models/UsuarioPokemon.php';

$usuario = new Usuario();

try {

    switch ($metodo) {
        // GET /api/usuarios/
        // GET /api/usuarios/12345678
        case 'GET':

            if ($id === null) {
                // GET /api/usuarios/ -> Listar usuarios
                $usuarios = $usuario->obtenerTodos();
                echo json_encode($usuarios);
            } else {
                // GET /api/usuarios/12345678 -> Obtener usuario por id
                // $usuarioEncontrado = $usuario->obtenerPorCi($_GET['ci']);
                $usuarioEncontrado = $usuario->obtenerPorCi($id);

                if ($usuarioEncontrado === null) {
                    http_response_code(404);
                    echo json_encode(['error' => 'Usuario no encontrado']);
                    exit;
                }

                echo json_encode($usuarioEncontrado);
            }

            exit;

        case 'POST':
            if ($subresource === "equipo") {
                require_once __DIR__ . '/../../api/usuarios/usuario-pokemon.php';
            }

            $datos = json_decode(file_get_contents('php://input'), true);

            if (!$datos) {
                http_response_code(400);
                echo json_encode(['error' => 'Datos inválidos']);
                exit;
            }

            $resultado = $usuario->crear(
                $datos['ci'],
                $datos['nombre'],
                $datos['apellido'],
                $datos['user'],
                $datos['pass'],
                $datos['rol']
            );

            if ($resultado) {
                http_response_code(201);
                echo json_encode(['mensaje' => 'Usuario creado correctamente']);

            } else {
                http_response_code(500);
                echo json_encode(['error' => 'No se pudo crear el usuario']);
            }

            exit;

        case 'PUT':
            if (!isset($id)) {
                http_response_code(400);
                echo json_encode(['error' => 'Debe indicar el CI']);
                exit;
            }

            $datos = json_decode(file_get_contents('php://input'), true);

            $resultado = $usuario->actualizar(
                $id,
                $datos['nombre'],
                $datos['apellido'],
                $datos['user'],
                $datos['rol']
            );

            if ($resultado) {
                echo json_encode(['mensaje' => 'Usuario actualizado']);
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'No se pudo actualizar']);
            }
            exit;

        case 'DELETE':
            if (!isset($id)) {
                http_response_code(400);
                echo json_encode(['error' => 'Debe indicar el CI']);
                exit;
            }

            $resultado = $usuario->eliminar($id);

            if ($resultado) {
                echo json_encode(['mensaje' => 'Usuario eliminado']);
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'No se pudo eliminar']);
            }

            exit;
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error en la base de datos' . $e]);
}
    