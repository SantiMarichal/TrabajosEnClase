<?php

require_once __DIR__ . '/../config/Database.php';

class PreferenciasUsuario
{
    private PDO $conexion;

    public function __construct() { $this->conexion = Database::getInstancia()->getConexion(); }
    
    private function crear(string $ciUsuario, string $generacion, string $estilo): bool 
    {
        $sql = "INSERT INTO preferencias_usuario(ci_usuario, generacion_favorita, estilo_entrenador)
                VALUES (:ci, :generacion, :estilo)";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':ci', $ciUsuario);
        $stmt->bindParam(':generacion', $generacion);
        $stmt->bindParam(':estilo', $estilo);

        return $stmt->execute();
    }

    public function tiposPreferencias(string $ciUsuario, string $generacion, string $estilo, array $tiposPreferencias): bool
    {
        try {
            $this->crear($ciUsuario, $generacion, $estilo);

            foreach ($tiposPreferencias as $tipo) {
                $this->crearTipoPreferencias($ciUsuario, $tipo);
            }
        } catch (PDOException $e) {
            return false;
        }

        return true;
    }

    private function crearTipoPreferencias(string $ciUsuario, string $tipo): bool 
    {
        $sql = "INSERT INTO preferencias_tipo_pokemon(ci_usuario, tipo_pokemon)
                VALUES (:ci, :tipo)";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':ci', $ciUsuario);
        $stmt->bindParam(':tipo', $tipo);

        return $stmt->execute();
    }

    

}