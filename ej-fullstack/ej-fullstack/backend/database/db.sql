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

INSERT INTO usuario (ci, nombre, apellido, user_name, pass, rol) 
VALUES ('12345678', 'Ana', 'Rodríguez', 'arodriguez', '1234', 'user');

CREATE TABLE IF NOT EXISTS pokemon (
    id INT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    sprite_url VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS usuario_pokemon(
    usuario_ci VARCHAR (10),
    pokemon_id INT,
    PRIMARY KEY (usuario_ci, pokemon_id),
    FOREIGN KEY (usuario_ci) REFERENCES usuario(ci),
    FOREIGN KEY (pokemon_id) REFERENCES pokemon(id)
); 