<?php

$pokemon="Pikachu";
$nivel=25;
$altura=0.4;
$legendario=false;

echo "variable pokemon: $pokemon\n";

echo 'El valor de la variable $pokemon es ' . "$pokemon\n";

echo 'El tipo de dato de la variable $pokemon es: ' . gettype($pokemon);

$array = [1, 2, 3];
echo 'El tipo de dato de la variable $array es ' . gettype($array) . "\n";

var_dump($pokemon);
var_dump($nivel);
var_dump($altura);
var_dump($legendario);
var_dump($array);

$pokemones = ["Pikachu", "Charizard", "Bulbasaur"];

foreach ($pokemones as $p) {
    echo $pokemon . "<br>";
}

foreach ($pokemones as $indice => $p) {
    echo "$indice: $p";
}
?>