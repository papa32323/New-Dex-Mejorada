<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/', function () {

    $respuesta = Http::get('https://pokeapi.co/api/v2/pokemon?limit=20');

    if ($respuesta->failed()) {
        return "Error al obtener datos de la PokeAPI";
    }

    $data = $respuesta->json();
    $listaBasica = $data['results'] ?? [];

    $pokemones = [];

    foreach ($listaBasica as $item) {
        $info = Http::get($item['url'])->json();

        $pokemones[] = [
            'id'     => $info['id'],
            'name'   => $info['name'],
            'height' => $info['height'],
            'weight' => $info['weight'],
            'sprite' => $info['sprites']['front_default'],
            'types'  => array_map(fn($t) => $t['type']['name'], $info['types'])
        ];
    }

    return view('welcome', compact('pokemones'));
});
