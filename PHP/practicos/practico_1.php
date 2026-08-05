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

evaluarEquipo($miEquipo);


//EJERCICIO 2
function entrenarPokemon(string $nombre, int $nivelInicial, int $nivelObjetivo, string $tipoEntrenamiento): void{
    echo "Ejercicio 2: Entrenamiento de Pokemon" . "Nombre del pokemon: $nombre" . "\n";
    while($nivelInicial<=$nivelObjetivo){
    if ($tipoEntrenamiento=="suave"){
        $nivelInicial++;
        echo "El nivel actual es: $nivelInicial" . "\n";
        if ($nivelInicial % 10 == 0){
            echo "El nivel actual es multiplo de 10" . "\n";
        }
    }elseif($tipoEntrenamiento=="medio"){
        $nivelInicial=$nivelInicial+2;
        echo "El nivel actual es: $nivelInicial";
        if ($nivelInicial % 10 == 0){
            echo "El nivel actual es multiplo de 10" . "\n";
        }
    }elseif($tipoEntrenamiento=="intenso"){
        $nivelInicial=$nivelInicial+5;
        echo "El nivel actual es: $nivelInicial" . "\n";
        if ($nivelInicial % 10 == 0){
            echo "El nivel actual es multiplo de 10" . "\n";
        }
    }
}
}

entrenarPokemon("Charizard", 5, 70, "suave")


?>