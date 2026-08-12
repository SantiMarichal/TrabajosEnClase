<?php

class Pokemon {
    private $nombre;
    private $tipo;
    private $nivel;
    private $hp;

    public function __construct($nombre, $tipo, $nivel) {
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->nivel = $nivel;
        $this->hp = 100; // Le agregamos el valor por defecto en el constructor
    }

    public function atacar() {
        // Para hacer referencia a elementos dentro de la clase se utiliza $this->atributo
        return $this->nombre . " usa ataque!";
    }

    public function getInfo() {
        // Concatenando string con los valores de los atributos:
        /*return $this->nombre . 
            " Tipo: " . $this->tipo .
            " Nivel: " . $this->nivel .
            " HP: " . $this->hp;*/

        // Usando llaves para utilizar los valores de los atributos dentro de ese string
            return "{$this->nombre} Tipo: {$this->tipo} Nivel: {$this->nivel} HP: {$this->hp}";
    }
}

/*
$pkmn1 = new Pokemon();
echo $pkmn1->getInfo() . "\n";

// Modificamos los atributos desde fuera de la clase porque son públicos:
$pkmn1->nombre = "Pikachu";
$pkmn1->tipo = "Eléctrico";
$pkmn1->nivel = 25;
$pkmn1->hp = 100;
echo $pkmn1->getInfo() . "\n";
*/

$pkmn1 = new Pokemon("Pikachu", "Eléctrico", 25);
echo $pkmn1->getInfo() . "\n";