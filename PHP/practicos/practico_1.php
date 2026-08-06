<?php
//EJERCICIO 1
$miEquipo = [
    ["nombre" => "Pikachu", "nivel" => 25, "apodo" => "Chispas"],
    ["nombre" => "Charizard", "nivel" => 55],
    ["nombre" => "Caterpie", "nivel" => 8, "apodo" => "Pepe"]
];
function evaluarEquipo(array $miEquipo): void {
    foreach ($miEquipo as $pokemon) {
        //Ejercicio 3 
        echo $pokemon["nombre"];
        $nombre = $pokemon["apodo"] ?? "Sin apodo";
        //Ejercicio 4
        if (($pokemon["nivel"]) >= 50){
            $categoria = "Su categoría es Elite";
        }elseif (($pokemon["nivel"]) <=49 && ($pokemon["nivel"]) >=20){
            $categoria = "Su categoría es Intermedio";
        }else{
            $categoria = "Su categoría es Principiante";
        }
        //Ejercicio 5
        $evolucion = $pokemon["nivel"]>=16 ? "Esta listo para evolucionar" : "No esta listo para evolucionar";
        //Ejercicio 6
        echo $pokemon["nombre"] . "\n";
        echo $nombre . "\n";
        echo $pokemon["nivel"] . "\n";
        echo $categoria. "\n";
        echo $evolucion . "\n";
    }
}
//evaluarEquipo($miEquipo);


//EJERCICIO 2
function entrenarPokemon(string $nombre, int $nivelInicial, int $nivelObjetivo, string $tipoEntrenamiento): void{
    echo "Ejercicio 2: Entrenamiento de Pokemon" . "Nombre del pokemon: $nombre" . "\n";
    $nivelActual=$nivelInicial;
    while($nivelActual<=$nivelObjetivo){
    if ($tipoEntrenamiento=="suave"){
        $nivelActual++;
        echo "El nivel actual es: $nivelActual" . "\n";
        if ($nivelActual % 10 == 0){
            echo "El nivel actual es multiplo de 10" . "\n";
        }
    }elseif($tipoEntrenamiento=="medio"){
        $nivelActual=$nivelActual+2;
        echo "El nivel actual es: $nivelActual";
        if ($nivelActual % 10 == 0){
            echo "El nivel actual es multiplo de 10" . "\n";
        }
    }elseif($tipoEntrenamiento=="intenso"){
        $nivelActual=$nivelActual+5;
        echo "El nivel actual es: $nivelActual" . "\n";
        if ($nivelActual % 10 == 0){
            echo "El nivel actual es multiplo de 10" . "\n";
        }
    }else{
        echo "Entrenamiento no válido.";
        break;
    }
}
}
//entrenarPokemon("Charizard", 5, 70, "intenso")

$poke1 = [
    "nombre" => "Gengar",
    "hp" => 50
];
$poke2 = [
    "nombre" => "Alakazam",
    "hp" => 50
];

//EJERCICIO 3

function simularBatalla(array $pkmn1, array $pkmn2): void{
    $hp1=$pkmn1["hp"];
    $hp2=$pkmn2["hp"];
    $nom1=$pkmn1["nombre"];
    $nom2=$pkmn2["nombre"];
    $turno=1;
    do{
        $damage=rand(5, 20);
        echo "Turno: $turno" . "\n";
        if($turno % 2 == 0){
            $hp2-=$damage;
            echo "$nom1 ataca a $nom2 causando $damage. HP de $nom2: $hp2" . "\n";
            $turno++;
        }else{
            $hp1-=$damage;
            echo "$nom2 ataca a $nom1 causando $damage. HP de $nom1: $hp1" . "\n" ;
            $turno++;
        }
    }while($hp1>=0 && $hp2>=0);
    $ganador1 = (($hp1<=0 && $hp2>=0)) ? "El ganador es $nom2" : "El ganador es $nom1" . "\n";
    echo $ganador1;
}

simularBatalla($poke1, $poke2);

//EJERCICIO 5:




?>