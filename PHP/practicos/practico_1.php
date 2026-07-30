<?php

function evaluarEquipo(array $miEquipo): void {
    foreach ($miEquipo as $pokemon => $value) {
        echo $pokemon["nombre"]  . "\n";
        $apodo = null;
        $nombre = $apodo ?? "Sin apodo";
    }



}

$miEquipo = [
    ["nombre" => "Pikachu", "nivel" => 25, "apodo" => "Chispas"],
    ["nombre" => "Charizard", "nivel" => 55],
    ["nombre" => "Caterpie", "nivel" => 8, "apodo" => "Pepe"]
];

evaluarEquipo($miEquipo);
?>