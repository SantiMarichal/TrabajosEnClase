<?php
require_once __DIR__ . '/../config/Database.php';

class Pokemon {
    /*
        CREATE TABLE IF NOT EXISTS pokemon (
        id INT PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL,
        sprite_url VARCHAR(255)
        ); 
    */
    private PDO $conexion;

    public function __construct()
    {
        $this->conexion = Database::getInstancia()->getConexion();
    }

    public function crear(string $id, string $nombre, string $sprite_url): bool {
        $sql = "INSERT INTO pokemon (id, nombre, sprite_url)
                VALUES (:id, :nombre, :sprite_url)";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':sprite_url', $sprite_url);

        return $stmt->execute();
    }

    public function obtenerPorID(string $id): ?array {
        $sql = "SELECT id, nombre, sprite_url
                FROM pokemon
                WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        return $usuario ?: null;
    }
}