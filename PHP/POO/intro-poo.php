<?php

class Pokemon {
    private string $nombre;
    private string $tipo;
    private int $nivel;
    private int $hp;

    private ?string $apodo;

    public function __construct(string $nombre, string $tipo, int $nivel, ?string $apodo) {
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->nivel = $nivel;
        $this->hp = 100; // Le agregamos el valor por defecto en el constructor
        $this->apodo = $apodo;
    }

    public function atacar(): string {
        // Para hacer referencia a elementos dentro de la clase se utiliza $this->atributo
        return $this->nombre . " usa ataque!";
    }

    public function recibirDanio(int $cantidad): string {
        $this->hp -= $cantidad;
        if ($this->hp < 0) {
            $this->hp = 0;
        }
        return "{$this->nombre} le quedan {$this->hp} de vida.";
    }

    public function getInfo(): string {
        // Concatenando string con los valores de los atributos:
        /*return $this->nombre . 
            " Tipo: " . $this->tipo .
            " Nivel: " . $this->nivel .
            " HP: " . $this->hp;*/

        // Usando llaves para utilizar los valores de los atributos dentro de ese string
        $apodo = $this->apodo ?? "sin apodo";
            return "{$this->nombre} Tipo: {$this->tipo} Nivel: {$this->nivel} HP: {$this->hp} Apodo: {$this->apodo}";
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

$pkmn1 = new Pokemon("Pikachu", "Eléctrico", 25, null);
echo $pkmn1->getInfo() . "\n";