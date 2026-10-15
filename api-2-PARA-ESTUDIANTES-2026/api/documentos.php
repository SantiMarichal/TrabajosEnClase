<?php

header("X-Content-Type-Options: nosniff");

require_once __DIR__ . "/../backend/models/Documento.php";
require_once __DIR__ . '/../backend/models/Usuario.php';

$documento = new Documento();
$usuario = new Usuario();
$raizProyecto = dirname(__DIR__);
$tamañoMaximo = 10 * 1024 * 1024; // 10 MB de tamaño máximo

// Se estandariza response con función
function responderJson(array $datos, int $codigo = 200): void
{
    http_response_code($codigo);

    header("Content-Type: application/json; charset=utf-8");

    echo json_encode($datos);

    exit;
}


function resolverRutaArchivo(string $rutaRelativa, string $raizProyecto): ?string {
    $raizUploads = realpath($raizProyecto . "/uploads/pdf");

    if ($raizUploads === false) {
        return null;
    }

    $rutaRelativa = str_replace(["\\", "/"],
        DIRECTORY_SEPARATOR,
        $rutaRelativa
    );

    $rutaFisica = realpath($raizProyecto . DIRECTORY_SEPARATOR . $rutaRelativa);

    if ($rutaFisica === false) {
        return null;
    }

    $prefijo = $raizUploads . DIRECTORY_SEPARATOR;

    if (strpos($rutaFisica, $prefijo) !== 0) {
        return null;
    }

    return $rutaFisica;
}


switch ($metodo) {
    case 'GET':
        $idDocumento = $subresource;
        $ci = $id;

        if ($idDocumento !== null) {
            $documento = $documento->buscarPorId($idDocumento);
        
            if ($documento === null) {
                responderJson([
                    "error" => "Documento no encontrado $id"
                ], 404);
            }

            $rutaFisica = resolverRutaArchivo(
                $documento["ruta_archivo"],
                $raizProyecto
            );

            if ($rutaFisica === null || !is_file($rutaFisica) || !is_readable($rutaFisica)) {
                responderJson([
                    "error" => "El archivo no existe o no se puede leer"
                ], 404);
            }

            // Se limpia el nombre del pdf
            $nombreArchivo = str_replace(["\r", "\n", '"', "\\"], "_", basename($documento["nombre_archivo"]));

            header("Content-Type: application/pdf");

            header('Content-Disposition: inline; filename="' . $nombreArchivo . '"'); // Nombre que se muestra

            header("Content-Length: " . filesize($rutaFisica)); // Tamaño PDF

            readfile($rutaFisica); // La API envía el archivo, o sea el (archivo es el) body de la request
        }


        $ci = isset($ci) ? trim((string) $ci) : null;

        if ($ci !== null && $ci !== "") {
            if (!$usuario->obtenerPorCi($ci)) {
                responderJson([
                    "error" => "Usuario no encontrado"
                ], 404);
            }
        } else {
            $ciUsuario = null;
        }

        $documentos = $documento->listar($ci);

        responderJson($documentos);

        exit;
    
    case 'POST':
        $ci = isset($_POST["usuarioCI"]) ? trim((string) $_POST["usuarioCI"]) : "";

        if ($ci === "") {
            responderJson([
                "error" => "Debe indicar el usuario al que pertenece el documento $ci"
            ], 400);
        }

        if (!$usuario->obtenerPorCi($ci)) {
            responderJson([
                "error" => "El usuario indicado no existe"
            ], 404);
        }

        // Se comprueba si en body.archivo se recibe archivo
        if (!isset($_FILES["archivo"])) {
            responderJson([
                "error" => "No se recibió ningún archivo"
            ], 400);
        }

        $archivo = $_FILES["archivo"];
            /*
                [
                    "name" => "contrato.pdf",
                    "type" => "application/pdf",
                    "tmp_name" => "/tmp/phpABC123",
                    "error" => 0,
                    "size" => 245760
                ]
                tmp_name: el archivo aún no está uploads/pdf/2026/. PHP lo almacena temporalmente mientras procesa la petición
            */


        if ($archivo["error"] !== UPLOAD_ERR_OK) {
            responderJson([
                "error" => "Se produjo un error al subir el archivo"
            ], 400);
        }

        // Se comprueba que el archivo temporal (recordar tmp_name) sea válido
        if (!is_uploaded_file($archivo["tmp_name"]) || $archivo["size"] <= 0) {
            responderJson([
                "error" => "El archivo recibido no es válido"
            ], 400);
        }

        // Se comprueba tamaño del archivo
        if ($archivo["size"] > $tamañoMaximo) {
            responderJson([
                "error" => "El archivo supera el límite de 10 MB"
            ], 400);
        }

        // Se comprueba que el archivo sea PDF
        $finfo = finfo_open(FILEINFO_MIME_TYPE); // MIME: application/pdf, image/png, image/jpeg o text/plain

        $tipoMime = finfo_file($finfo, $archivo["tmp_name"]);

        $handle = fopen($archivo["tmp_name"], "rb");
        $cabecera = fread($handle, 5); // Se leen los primeros caracteres de un PDF %PDF- (abrir un PDF con editor de texto)
        fclose($handle);

        // Recién acá se realiza la comprobación
        if ($tipoMime !== "application/pdf" || $cabecera !== "%PDF-") {
            responderJson([
                "error" => "El archivo debe ser un PDF válido"
            ], 400);
        }

        
        // Nombre del archivo ---INICIO------------------------------------------------------
        // Se obtiene el nombre original y se crea el nombre aleatorio para guardar en el srv
        $nombreOriginal = basename(str_replace("\\", "/", $archivo["name"]));

        $nombreOriginal = preg_replace('/[\x00-\x1F\x7F]/', "", $nombreOriginal);
            // Eliminamos caracteres especiales mediante expresión regular, como los de control \x00-\x1F y \x7F

        if ($nombreOriginal === "") {
            $nombreOriginal = "documento.pdf";
        }

        if (function_exists("mb_substr")) {
            // Con codificación, en este caso UTF-8 (letras acentuadas u otros caracteres)
            $nombreOriginal = mb_substr($nombreOriginal, 0, 255, "UTF-8");
        } else {
            // Sin codificación. No Unicode
            $nombreOriginal = substr($nombreOriginal, 0, 255);
        }

        $nombreServidor = bin2hex(random_bytes(16)) . ".pdf";
        // Nombre del archivo ---FIN------------------------------------------------------

        // Se crea la carpeta con el año, si es que ya no existe ---INICIO----------------
        $anio = date("Y");

        $carpetaRelativa = "uploads/pdf/" . $anio;

        $carpetaFisica = $raizProyecto . DIRECTORY_SEPARATOR . str_replace("/", DIRECTORY_SEPARATOR, $carpetaRelativa);

        if (!is_dir($carpetaFisica) && !mkdir($carpetaFisica, 0777, true) && !is_dir($carpetaFisica)) {
            responderJson([
                "error" => "No se pudo crear la carpeta de destino"
            ], 500);
        }
        // Se crea la carpeta con el año, si es que ya no existe ---FIN-------------------

        
        // El archivo queda en el srv en uploads/pdf/año/
        $rutaRelativa = $carpetaRelativa . "/" . $nombreServidor;

        /*
            Ejemplo: /var/www/html/uploads/pdf/2026/0a491f4966990bb6e171971c983d8d17.pdf
                $carpetaFisica = /var/www/html/uploads/pdf/2026
                $nombreServidor = 0a491f4966990bb6e171971c983d8d17.pdf

            docker exec -it ejemploApi ls -lh /var/www/html/uploads/pdf/2026
                -rw-r--r--. 1 www-data www-data 8.6K Oct 15 04:50 0a491f4966990bb6e171971c983d8d17.pdf
                -rw-r--r--. 1 www-data www-data  99K Oct 15 04:50 c926832bec34ae470391f664b338790e.pdf
        */
        $rutaFisica = $carpetaFisica . DIRECTORY_SEPARATOR . $nombreServidor;

        if (!move_uploaded_file($archivo["tmp_name"], $rutaFisica)) {
            responderJson([
                "error" => "No se pudo guardar el archivo en el servidor"
            ], 500);
        }

        // Se guarda el PDF en la BD
        try {
            $idDocumento = $documento->crear($ci, $nombreOriginal, $rutaRelativa);
        } catch (Throwable $e) {
            if (is_file($rutaFisica)) {
                // Si se genera una excepción se borra el PDF
                unlink($rutaFisica);
            }

            error_log($e->getMessage());

            responderJson([
                "error" => "No se pudo registrar el documento"
            ], 500);
        }


        responderJson([
            "mensaje" => "PDF subido correctamente",
            "id" => $idDocumento,
            "ci_usuario" => $ci,
            "nombre_archivo" => $nombreOriginal,
            "ruta_archivo" => $rutaRelativa
        ], 201);

        break;

    case 'DELETE':
        $ci = $id;
        $idDocumento = $subresource;

        if (!isset($idDocumento)) {
            responderJson([
                "error" => "Debe indicar el ID del documento"
            ], 400);
        }

        $documento = $documento->buscarPorId($idDocumento);

        if ($documento === null) {
            responderJson([
                "error" => "Documento no encontrado"
            ], 404);
        }

        $rutaFisica = resolverRutaArchivo(
            $documento["ruta_archivo"],
            $raizProyecto
        );

        if ($rutaFisica !== null && is_file($rutaFisica) && !unlink($rutaFisica)) {
            responderJson([
                "error" => "No se pudo eliminar el archivo físico"
            ], 500);
        }

        $eliminado = (new Documento())->eliminar($idDocumento);

        if (!$eliminado) {
            responderJson([
                "error" => "No se pudo eliminar el registro"
            ], 500);
        }

        responderJson([
            "mensaje" => "Documento eliminado correctamente"
        ]);

        break;

    default:
        responderJson([
            "error" => "Método HTTP no permitido"
        ], 405);
}
