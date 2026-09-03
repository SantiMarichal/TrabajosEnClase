<?php

require_once __DIR__ . '/../../backend/models/Usuario.php';
require_once __DIR__ . '/../../backend/models/Pokemon.php';
require_once __DIR__ . '/../../backend/models/UsuarioPokemon.php';
$usuario = new Usuario();
$pokemonDAO = new Pokemon();
$usuarioPokemon = new UsuarioPokemon();

try {

    switch ($metodo) {
        case 'GET':
            // GET /api/usuarios/
            if ($id === null) {
                $usuarios = $usuario->obtenerTodos();
                echo json_encode($usuarios);
            } else {
                // GET /api/usuarios/12345678
                $usuarios = $usuario->obtenerPorCi($id);

                if ($usuarios === null) {
                    http_response_code(404);
                    echo json_encode([
                        'error' => 'Usuario no encontrado'
                    ]);
                    // Cuando la función obtenerPorCi retorna null enviamos el mensaje correspondiente
                    exit;
                }

                echo json_encode($usuarios);
            }

            exit;

        case 'POST':
            if ($subresource === "equipo"){
                //Obtenemos el array asociativo que esta en el elemento con clave 'pokemon'
                $listaPokemon=$input['pokemon'];
                $nombre = $listaPokemon[0]['nombre'];
                $idPkmn = $listaPokemon[0]['id'];
                $nombrePkmn = $listaPokemon[0]['nombre'];
                $spritePkmn = $listaPokemon[0]['sprite_url'];

                $pokemonDAO->crear($idPkmn, $nombrePkmn, $spritePkmn);
                $usuarioPokemon->crear($id, $idPkmn);

                http_response_code(201);
                echo json_encode([
                    'mensaje' => 'Equipo asginado',
                    'dato' => '{$nombre}'
                ]);
                exit;
            }
            // POST /api/usuarios/
            $datos = json_decode(file_get_contents('php://input'), true);

            $ci = $datos['ci'];
            $nombre = $datos['nombre'];
            $apellido = $datos['apellido'];
            $user = $datos['user'];
            $pass = $datos['pass'];
            $rol = $datos['rol'];

            $resultado = $usuario->crear(
                $ci,
                $nombre,
                $apellido,
                $user,
                $pass,
                $rol
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
            
            exit;

        case 'DELETE':
            
            exit;
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error en la base de datos']);
}
