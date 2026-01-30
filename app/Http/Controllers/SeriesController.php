<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Serie;
use App\Models\Series;
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
        $series = Series::all();


        // return view('series.index', compact('series'));
        return view('series.index')->with('series', $series);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
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

        // 1° Validação de dados
        // $request->validate([
        //     'titulo' => ['required', 'min:3', 'max:50'],
        //     'temporadas' => ['required', 'integer']
        // ]);

        // 2° Validação de dados -> Criei a minha própria Request


        // mass assignment 2
        $serie = Series::create($request->all());
        if ($serie) {
            //   return  response([
            //         'status' => 'success'
            //     ], 200);


            $seasons = [];
            for ($i = 1; $i <= $request->seasonsQty; $i++) {
                $seasons[] = [
                    'series_id' => $serie->id,
                    'number' => $i
                ];
            }

            Season::insert($seasons);

            $episodes = [];

            foreach ($serie->seasons as $season) {
                for ($j = 1; $j <= $request->episodesPerSeason; $j++) {
                    $episodes[] = [
                        'season_id' => $season->id,
                        'number' => $j
                    ];
                }
            }

            Episode::insert($episodes);



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

        $nome_serie = Series::find($serie);

        $serie = Series::destroy($serie);
        if ($serie) {
            return redirect()
                ->route('series.index')
                ->with('success', "Série {$nome_serie->titulo} excluída com sucesso");
        }
    }

    public function edit($serie)
    {

        $serie = Series::find($serie);

        if (!$serie) {
            return redirect()
                ->route('series.index')
                ->with('error', 'Série não encontrada');

        }

        return view('series.edit')->with('serie', $serie);
    }

    public function update(SeriesFormRequest $request, $serie)
    {

        $serie = Series::find($serie);

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
