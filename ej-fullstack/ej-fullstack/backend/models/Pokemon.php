<?php
class Pokemon{
    private PDO $conexion;

    public function __construct()
    {
        $this->conexion = Database::getInstancia()->getConexion();
    }

    public function crear(string $id, string $nombre, string $sprite_url): bool {
        $sql = "INSERT INTO pokemon (id, nombre, sprite_url)
                VALUES (:id, :nombre, :sprite_url)";
        $sentencia = $this->conexion->prepare($sql);

        $sentencia->bindParam(':id', $id);
        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->bindParam(':sprite_url', $sprite_url);

        return $sentencia->execute();
    }

}