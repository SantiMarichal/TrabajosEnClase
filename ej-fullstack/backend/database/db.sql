CREATE DATABASE IF NOT EXISTS bdejemplo;
USE bdejemplo;

CREATE TABLE IF NOT EXISTS usuario (
    ci VARCHAR(10) NOT NULL PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL,
    apellido VARCHAR(30) NOT NULL,
    user_name VARCHAR(30) NOT NULL,
    pass VARCHAR(30) NOT NULL,
    rol ENUM('admin', 'user')
);

INSERT INTO usuario (ci, nombre, apellido, user_name, pass, rol) 
VALUES ('11111111', 'Prueba', 'Gómez', 'prueba', '1234', 'admin');

