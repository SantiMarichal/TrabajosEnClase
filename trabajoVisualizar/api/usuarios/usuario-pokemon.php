<?php

require_once __DIR__ . '/../../backend/models/Usuario.php';
require_once __DIR__ . '/../../backend/models/Pokemon.php';
require_once __DIR__ . '/../../backend/models/UsuarioPokemon.php';

$usuarioModel = new Usuario();
$pokemon = new Pokemon();
$usuarioPokemon = new UsuarioPokemon();

function guardarEquipo(string $ci, array $listaPokemon): bool {
    $pokemon = new Pokemon();
    $usuarioPokemon = new UsuarioPokemon();

    try {
        foreach ($listaPokemon as $pkmn) {
            if (!$pokemon->obtenerPorID($pkmn['id'])) {
                $pokemon->crear($pkmn['id'], $pkmn['nombre'], $pkmn['sprite_url']);
            }
            $usuarioPokemon->crear($ci, $pkmn['id']);
        }
    } catch (PDOException $e) {
        return false;
    }
    
    return true;
}

// Validar que se reciba el CI del usuario
if (!$id) {
    http_response_code(400);
    echo json_encode(['error' => 'Debe proporcionar la CI del usuario en la URL']);
    exit;
}

try {
    switch ($metodo) {

        // GET /api/usuarios/{ci}/equipo -> Obtener el equipo del usuario
        case 'GET':
            $equipo = $usuarioPokemon->obtenerEquipo($id);
            // echo json_encode([
            //     'usuario_ci' => $id,
            //     'total'      => count($equipo),
            //     'equipo'     => $equipo
            // ]);
            if ($equipo) {
                echo json_encode([
                    'equipo' => $equipo
                ]);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'No se pudo obtener el equipo']);
            }
            
            exit;

        // POST /api/usuarios/{ci}/equipo -> Guardar/reemplazar el equipo
        case 'POST':
            $listaPokemon = $input['pokemon'] ?? [];

            if (!is_array($listaPokemon) || count($listaPokemon) !== 5) {
                http_response_code(400);
                echo json_encode(['error' => 'Debes enviar un array "pokemon" con exactamente 5 elementos']);
                exit;
            }

            // $resultado = $usuarioModel->guardarEquipo($id, $listaPokemon);
            $resultado = guardarEquipo($id, $listaPokemon);

            if ($resultado) {
                http_response_code(201);
                echo json_encode(['mensaje' => 'Equipo asignado correctamente al usuario']);
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'No se pudo guardar el equipo']);
            }
            exit;

        // DELETE /api/usuarios/{ci}/equipo -> Eliminar/vaciar el equipo del usuario
        case 'DELETE': 
            $resultado = $usuarioPokemon->eliminarEquipo($id);

            if ($resultado) {
                echo json_encode(['mensaje' => 'Equipo eliminado correctamente']);
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'No se pudo eliminar el equipo']);
            }
            exit;

        default:
            http_response_code(405);
            echo json_encode(['error' => 'Método no permitido para este recurso']);
            exit;
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
}