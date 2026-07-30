<?php

//Mostrar la cantidad de numeros mayores a 10
$numeros = [10, 5, 25, 30];
$cont1 = 0;
foreach ($numeros as $n) {
    if ($n > 10) {
        $cont1++;
    }
}
echo "La cantidad de numeros mayores a 10 es: $cont1" . "\n";

$cont2 = 0;
foreach ($numeros as $n) {
    if ($n % 2 == 0) {
        $cont2++;
    }
}
echo "La cantidad de numeros pares es: $cont2" . "\n";


function sumaArray(array $nums): int
{
    $suma = 0;
    foreach ($nums as $n) {
        $suma += $n;
    }
    return $suma;
}
echo "La suma es: " . sumaArray($numeros) . "\n";

function contarPrimos(array $nums): int
{
    $cont3 = 0;
    foreach ($nums as $n) {
        if (($n % $n == 0) and ($n % 1 == 0)) {
            $cont3++;
        }
    }
    return $cont3;
}
echo "La cantidad de numeros primos es: " . contarPrimos($numeros) . "\n";

function sumar10(array $nums): array
{
    $nuevo = [];
    $sum = 10;
    foreach ($nums as $n) {
        $nuevo[] = $n + $sum;
    }
    return $nuevo;
}
var_dump(sumar10($numeros));

$personas = [
    [
        "nombre" => "Pepe",
        "edad" => 25
    ],
    [
        "nombre" => "Ana",
        "edad" => 9
    ],
    [
        "nombre" => "María",
        "edad" => 30
    ],
    [
        "nombre" => "Juan",
        "edad" => 50
    ],
    [
        "nombre" => "Mario",
        "edad" => 60
    ],
];

function contarMayores(array $personas): int
{
    $cont4 = 0;
    foreach ($personas as $p) {
        if ($p["edad"] >= 18) {
            $cont4++;
        }
    }
    return $cont4;
}

echo "La cantidad de personas mayores de 18 son: " . contarMayores($personas) . "\n";

//Mostrar la cantidad de personas en cada franja etaria
function franjasEtarias(array $personas): array
{
    $resultado = [
        "Niños" => 0,
        "Adolescentes" => 0,
        "Juventud" => 0,
        "Adultez" => 0,
        "Vejez" => 0
    ];
    foreach($personas as $p){
    if ($p["edad"] <= 11 ){
        $resultado["Niños"]++;
    }elseif($p["edad"]>=12 and $p["edad"]<=18){
        $resultado["Adolescentes"]++;
    }elseif($p["edad"]>=19 and $p["edad"]<=29){
        $resultado["Juventud"]++;
    }elseif($p["edad"]>=30 and $p["edad"]<=60){
        $resultado["Adultez"]++;
    }elseif($p["edad"]>=61){
        $resultado["Vejez"]++;
    }
}

    return $resultado; 
}

var_dump(franjasEtarias($personas));


?>