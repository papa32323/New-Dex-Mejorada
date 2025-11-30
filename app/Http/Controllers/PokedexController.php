<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PokedexController extends Controller
{
    public function index()
    {
        $response = Http::get("https://pokeapi.co/api/v2/pokemon?limit=50");

        if ($response->failed()) {
            return "Error al cargar los Pokémon.";
        }

        $results = $response->json()['results'];

        $pokemones = [];

        foreach ($results as $pokemon) {

            $info = Http::get($pokemon['url'])->json();

            $pokemones[] = [
                "id" => $info["id"],
                "name" => $info["name"],
                "height" => $info["height"],
                "weight" => $info["weight"],
                "types" => array_map(fn($t) => $t["type"]["name"], $info["types"]),
                "sprite" =>
                    $info["sprites"]["other"]["official-artwork"]["front_default"]
                    ?? $info["sprites"]["front_default"]
            ];
        }

        return view('welcome', compact('pokemones'));
    }
}
