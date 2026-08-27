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
        $sql = 'INSERT INTO usuario(ci, nombre, apellido, user_name, pass, rol) VALUES (:ci, :nombre, :apellido, :user_name, :password, :rol)';

        $sentencia = $this->conexion->prepare($sql);

        $sentencia -> bindParam(':ci', $ci);
        $sentencia -> bindParam(':nombre', $nombre);
        $sentencia -> bindParam(':apellido', $apellido);
        $sentencia -> bindParam(':user_name', $user);
        $sentencia -> bindParam(':password', $pass);
        $sentencia -> bindParam(':rol', $rol);
        return $sentencia -> execute();
    }

    // Obtener todos los usuarios
    public function obtenerTodos(): array {
    // Escribimos como texto literal la consulta SQL    
       $sql = 'SELECT * FROM usuario';
        //Preparamos la sentencia
       $sentencia = $this->conexion->prepare($sql);

       //Ejecutamos la consulta
       $sentencia->execute();

        //Retornamos un array asociativo (FETCH_ASSOC)
       return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener usuario por CI
    public function obtenerPorCi(string $ci): ?array {

        $sql = 'SELECT * FROM usuario WHERE ci= :ci'; //ci es un parametro de la query
        
        $sentencia = $this->conexion->prepare($sql);

        $sentencia->bindParam(":ci", $ci);

        $sentencia->execute();

        return ($sentencia->fetch(PDO::FETCH_ASSOC)) ?: null;
    }



    // Modificar usuario
    public function actualizar(string $ci, string $nombre, string $apellido, string $user, string $rol): bool {
        
    }

    // Eliminar usuario
    public function eliminar(string $ci): bool {
        
    }

    // LOGIN
    public function login(string $user, string $pass): ?array {
        $sql = 'SELECT * FROM usuario WHERE user_name=:user AND pass=:pass';
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->bindParam(":user", $user);
        $sentencia->bindParam(":pass", $pass);
        $sentencia->execute();
        $usuario = ($sentencia->fetch(PDO::FETCH_ASSOC)) ?: null;
        return $usuario ?: null;
    }
}