<?php

require_once __DIR__ . '/../backend/models/Usuario.php';
require_once __DIR__ . '/../backend/models/PreferenciasUsuario.php';

$usuario = new Usuario();
$preferenciasUsuario = new PreferenciasUsuario();

/*
POST /api/preferencias.php
GET	/api/preferencias.php?usuario_ci=12345678
PUT	/api/preferencias.php?usuario_ci=12345678
DELETE	/api/preferencias.php?usuario_ci=12345678
*/

try {
    switch ($metodo) {
        // POST /api/preferencias
        case 'POST':
            $datos = json_decode(file_get_contents('php://input'), true);

            if (!$datos) {
                http_response_code(400);
                echo json_encode(['error' => 'Datos inválidos']);
                exit;
            }

            $resultado = $preferenciasUsuario->tiposPreferencias(
                $datos['ci'],
                $datos['generacion'],
                $datos['estilo'],
                $datos['tipos']
            );

            if ($resultado) {
                http_response_code(201);
                echo json_encode(['mensaje' => 'Preferencias creadas correctamente']);

            } else {
                http_response_code(500);
                echo json_encode(['error' => 'No se pudieron guardar las preferencias del usuario']);
            }

            exit;
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error en la base de datos' . $e]);
}