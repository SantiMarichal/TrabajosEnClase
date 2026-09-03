<?php

class UsuarioPokemon{
    private PDO $conexion;

    public function __construct()
    {
        $this->conexion = Database::getInstancia()->getConexion();
    }

    public function crear(string $ci, string $id): bool {
        $sql = "INSERT INTO usuario_pokemon (usuario_ci, pokemon_id)
                VALUES (:ci, :id)";
        $sentencia = $this->conexion->prepare($sql);

        $sentencia->bindParam(':ci', $ci);
        $sentencia->bindParam(':id', $id);

        return $sentencia->execute();
    }

}