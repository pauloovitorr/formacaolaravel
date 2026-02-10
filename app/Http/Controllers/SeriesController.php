<?php

namespace App\Http\Controllers;

use App\Events\SeriesCreated;
use App\Http\Controllers\Controller;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SeriesController extends Controller
{

    public function __construct(private SeriesRepository $repository)
    {

    }

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
        $cover_path = $request->hasFile('cover') ? $request->file('cover')->store('series_cover', 'public') : null;
        $request->coverPath = $cover_path;


        // Cria a série
        $serieCriada = $this->repository->add($request);



        // Cria o evento
        $eventSeries = new SeriesCreated(
            $serieCriada->titulo,
            $serieCriada->id,
            $request->seasonsQty,
            $request->episodesPerSeason
        );

        // Dispara o evento
        event($eventSeries);

        return redirect()
            ->route('series.index')
            ->with('success', "Série {$serieCriada->titulo} cadastrada com sucesso");
    }


    // Duas formas de excluir um registro
    // 1° Pegar o valor pelo $request->route
    // public function destroy(Request $request){
    //     dd($request->route('serie'));
    // }



public function destroy($id)
{
    $serie = Series::findOrFail($id);



    // Apagar imagem física
    if ($serie->cover && Storage::disk('public')->exists($serie->cover)) {
        Storage::disk('public')->delete($serie->cover);
    }

    // Apagar registro
    $serie->delete();

    return redirect()
        ->route('series.index')
        ->with('success', "Série {$serie->titulo} excluída com sucesso");
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
