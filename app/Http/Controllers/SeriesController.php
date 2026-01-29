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
        // $tituloSerie = $request->input('titulo');
        // $temporadaSerie = (int) $request->input('temporadas');

        // Forma de fazer com SQL puro sem model
        // $retorno = DB::insert('insert into series (titulo, temporadas) values (?, ?)', [$tituloSerie, $temporadaSerie]);

        // Com model
        // $serie = new Serie();
        // $serie->titulo = $tituloSerie;
        // $serie->temporadas = $temporadaSerie;
        // $serie->save();

        // mass assignment
        // $serie = Serie::create([
        //     'titulo' => $request->titulo,
        //     'temporadas' => $request->temporadas
        // ]);


        // mass assignment 2
        $serie = Serie::create($request->all());


        if ($serie) {
            //   return  response([
            //         'status' => 'success'
            //     ], 200);

            return redirect()
                ->route('series.index')
                ->with('success', "Série {$serie->titulo} cadastrada com sucesso");
            ;

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

    // Duas formas de excluir um registro
    // 1° Pegar o valor pelo $request->route
    // public function destroy(Request $request){
    //     dd($request->route('serie'));
    // }

    // 2° Pegar diretamente o ID da url
    public function destroy($serie)
    {

        $nome_serie = Serie::find($serie);

        $serie = Serie::destroy($serie);
        if ($serie) {
            return redirect()
                ->route('series.index')
                ->with('success', "Série {$nome_serie->titulo} excluída com sucesso");
        }
    }

    public function edit($serie)
    {

        $serie = Serie::find($serie);

        if (!$serie) {
            return redirect()
                ->route('series.index')
                ->with('error', 'Série não encontrada');

        }

        return view('series.edit')->with('serie', $serie);
    }

    public function update(Request $request, $serie)
    {

        $serie = Serie::find($serie);

        if (!$serie) {
            return redirect()
                ->route('series.index')
                ->with('error', 'Série não encontrada');
        }

        if ($serie->update($request->all())) {
            return redirect()
                ->route('series.index')
                ->with('success', 'Série atualizada');
        }




    }


}
