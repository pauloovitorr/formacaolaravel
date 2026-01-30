<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Series;
// use Illuminate\Http\Request;

class SeasonsController extends Controller
{
    public function index(Series $series)
    {

        // Quando quero acessar os dados diretos
        $seasons = $series->seasons()->with('episodes')->get();

        // Quero adicionar regras para filtrar etc...
        // $seasons = $series->seasons();

        return view('seasons.index')->with('seasons', $seasons)->with('series', $series);

    }
}
