<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Serie;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {

        // Dados fictícios
        // $series = [
        //     ['id' => 1, 'title' => 'Breaking Bad', 'seasons' => 5],
        //     ['id' => 2, 'title' => 'Game of Thrones', 'seasons' => 8],
        //     ['id' => 3, 'title' => 'Stranger Things', 'seasons' => 4],
        // ];


        // Forma de fazer com SQL puro sem model
        // $series = DB::select('SELECT id, titulo, temporadas FROM series');


        // Com model
        $series = Serie::all();


        // return view('series.index', compact('series'));
        return view('series.index')->with('series', $series);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        $tituloSerie = $request->input('titulo');
        $temporadaSerie = (int) $request->input('temporada');

        // Forma de fazer com SQL puro sem model
        // $retorno = DB::insert('insert into series (titulo, temporadas) values (?, ?)', [$tituloSerie, $temporadaSerie]);

        // Com model
        $serie = new Serie();
        $serie->titulo = $tituloSerie;
        $serie->temporadas = $temporadaSerie;
        


        if ($serie->save()) {
            //   return  response([
            //         'status' => 'success'
            //     ], 200);

            return redirect()->route('series.index');

        } else {
            //   return   response([
            //         'status' => 'error'
            //     ],400 );


            return redirect()
                ->route('series.create')
                ->withErrors(['erro' => 'Erro ao criar a série'])
                ->withInput();


        }

    }
}
