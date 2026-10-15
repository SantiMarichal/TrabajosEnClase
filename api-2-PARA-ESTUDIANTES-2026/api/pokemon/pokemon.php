<?php




/*
function obtenerPkmn(int $num): ?array {
    $request = curl_init();

    curl_setopt($request, CURLOPT_URL, "https://pokeapi.co/api/v2/pokemon/$num");
    curl_setopt($request, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($request);

    $pokemon = json_decode($response, true);

    return $pokemon;
}

function obtenerStats(array $stats): array {
    $estadisticas = [];

    foreach ($stats as $stat) {
        $nombreStat = $stat['stat']['name'];
        $valorStat = $stat['base_stat'];
    
        $estadisticas[$nombreStat] = $valorStat;
    }

    return $estadisticas;
}

function obtenerTipos(array $types): array {
    $tipos = [];

    foreach ($types as $type) {
        $tipo = $type['type']['name'];

        $tipos[] = $tipo;
    }

    return $tipos;
}

function filtradoDatosPkmn(int $num): array {
    $pokemon = [];

    $pkmn = obtenerPkmn($num);
    $stats = obtenerStats($pkmn['stats']);
    $types = obtenerTipos($pkmn['types']);

    $pokemon['id'] = $pkmn['id'];
    $pokemon['name'] = $pkmn['name'];
    $pokemon['types'] = $types;
    $pokemon['stats'] = $stats;

    return $pokemon;
}

$pokemones = [];

for ($i=1; $i <= 10; $i++) { 
    $pokemon = filtradoDatosPkmn($i);
    $pokemones[] = $pokemon;
}

echo json_encode($pokemones);
exit;*/