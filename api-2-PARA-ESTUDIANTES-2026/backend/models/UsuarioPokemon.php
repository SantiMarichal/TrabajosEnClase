<?php

/*
CREATE TABLE IF NOT EXISTS usuario_pokemon (
    usuario_ci VARCHAR(10),
    pokemon_id INT,
    PRIMARY KEY (usuario_ci, pokemon_id),
    FOREIGN KEY (usuario_ci) REFERENCES usuario(ci),
    FOREIGN KEY (pokemon_id) REFERENCES pokemon(id)
);
*/
class UsuarioPokemon {
    private PDO $conexion;

    public function __construct()
    {
        $this->conexion = Database::getInstancia()->getConexion();
    }

    public function crear(string $usuario_ci, string $pokemon_id): bool {
        $sql = "INSERT INTO usuario_pokemon (usuario_ci, pokemon_id)
                VALUES (:usuario_ci, :pokemon_id)";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':usuario_ci', $usuario_ci);
        $stmt->bindParam(':pokemon_id', $pokemon_id);

        return $stmt->execute();
    }

    public function obtenerEquipo(string $usuario_ci): ?array {
        $sql = "SELECT usuario_ci, pokemon_id, nombre, sprite_url
                FROM usuario_pokemon
                INNER JOIN pokemon ON pokemon_id = id
                WHERE usuario_ci = :usuario_ci";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':usuario_ci', $usuario_ci);

        $stmt->execute();

        $usuario = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $usuario ?: null;
    }

    public function eliminarEquipo($id):bool {

    }
}