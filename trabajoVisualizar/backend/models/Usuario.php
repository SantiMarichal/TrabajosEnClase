<?php
require_once __DIR__ . '/../config/Database.php';

class Usuario
{
    private PDO $conexion;

    public function __construct()
    {
        $this->conexion = Database::getInstancia()->getConexion();
    }

    public function crear(string $ci, string $nombre, string $apellido, string $user, string $pass, string $rol): bool {
        $sql = "INSERT INTO usuario (ci, nombre, apellido, user_name, pass, rol)
                VALUES (:ci, :nombre, :apellido, :user, :pass, :rol)";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':ci', $ci);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':user', $user);
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':rol', $rol);

        return $stmt->execute();
    }

    // Obtener todos los usuarios
    public function obtenerTodos(): array
    {
        $sql = "SELECT ci, nombre, apellido, user_name, rol FROM usuario";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener usuario por CI
    public function obtenerPorCi(string $ci): ?array
    {
        $sql = "SELECT ci, nombre, apellido, user_name, rol
                FROM usuario
                WHERE ci = :ci";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':ci', $ci);

        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        return $usuario ?: null;
    }

    // Modificar usuario

    public function actualizar(string $ci, string $nombre, string $apellido, string $user, string $rol): bool {
        $sql = "UPDATE usuario
                SET nombre = :nombre, apellido = :apellido, user_name = :user, rol = :rol
                WHERE ci = :ci";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':ci', $ci);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':user', $user);
        $stmt->bindParam(':rol', $rol);

        return $stmt->execute();
    }

    // Eliminar usuario
    public function eliminar(string $ci): bool
    {
        $sql = "DELETE FROM usuario
                WHERE ci = :ci";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':ci', $ci);

        return $stmt->execute();
    }

    // LOGIN
    public function login(string $user, string $pass): ?array {
        $sql = "SELECT ci, nombre, apellido, user_name, rol
                FROM usuario
                WHERE user_name = :user
                AND pass = :pass";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':user', $user);
        $stmt->bindParam(':pass', $pass);

        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        return $usuario ?: null;
    }
}