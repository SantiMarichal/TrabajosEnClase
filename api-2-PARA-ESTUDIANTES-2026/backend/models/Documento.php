<?php

require_once __DIR__ . '/../config/Database.php';

class Documento
{
    private PDO $conexion;

    public function __construct()
    {
        $this->conexion = Database::getInstancia()->getConexion();
    }


    public function listar(?string $ciUsuario = null): array
    {
        if ($ciUsuario !== null && $ciUsuario !== '') {
            $sql = "SELECT id, ci_usuario, nombre_archivo, ruta_archivo, fecha
                    FROM documento
                    WHERE ci_usuario = :ci
                    ORDER BY fecha DESC";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':ci', $ciUsuario);
            $stmt->execute();
        } else {
            $sql = "SELECT id, ci_usuario, nombre_archivo,
                           ruta_archivo, fecha
                    FROM documento
                    ORDER BY fecha DESC";

            $stmt = $this->conexion->query($sql);
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id): ?array
    {
        $sql = "SELECT id, ci_usuario, nombre_archivo, ruta_archivo, fecha
                FROM documento
                WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $documento = $stmt->fetch(PDO::FETCH_ASSOC);

        return $documento ?: null;
    }

    public function crear(string $ciUsuario, string $nombreArchivo, string $rutaArchivo): int {
        $sql = "INSERT INTO documento(ci_usuario, nombre_archivo, ruta_archivo)
                VALUES (:ci, :nombre_archivo, :ruta_archivo)";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':ci', $ciUsuario);
        $stmt->bindParam(':nombre_archivo', $nombreArchivo);
        $stmt->bindParam(':ruta_archivo', $rutaArchivo);
        $stmt->execute();

        return (int) $this->conexion->lastInsertId();
    }

    public function eliminar(int $id): bool
    {
        $sql = "DELETE FROM documento WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

}