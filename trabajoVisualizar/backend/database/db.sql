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

CREATE TABLE IF NOT EXISTS pokemon (
    id INT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    sprite_url VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS usuario_pokemon (
    usuario_ci VARCHAR(10),
    pokemon_id INT,
    PRIMARY KEY (usuario_ci, pokemon_id),
    FOREIGN KEY (usuario_ci) REFERENCES usuario(ci),
    FOREIGN KEY (pokemon_id) REFERENCES pokemon(id)
);

INSERT INTO usuario (ci, nombre, apellido, user_name, pass, rol) 
VALUES ('11111111', 'Prueba', 'Gómez', 'prueba', '1234', 'admin');

INSERT INTO usuario (ci, nombre, apellido, user_name, pass, rol) 
VALUES ('12345670', 'María', 'Pérez', 'mperez', '1234', 'user'),
 ('12345678', 'Pedro', 'Pérez', 'pperez', '1234', 'user');

INSERT INTO pokemon (id,nombre,sprite_url) VALUES
    (71,'victreebel','https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/71.png'),
	(99,'kingler','https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/99.png'),
	(106,'hitmonlee','https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/106.png'),
    (148,'dragonair','https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/148.png'),
	(151,'mew','https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/151.png');

INSERT INTO usuario_pokemon (usuario_ci,pokemon_id) VALUES
	('12345670',71),
	('12345670',99),
	('12345670',106),
	('12345670',148),
	('12345670',151);


CREATE TABLE documento (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ci_usuario VARCHAR(10) NOT NULL,
    nombre_archivo VARCHAR(255),
    ruta_archivo VARCHAR(1000),
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
