<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Symfony\Component\HttpFoundation\Request;

class SeriesController extends Controller
{

    public function __construct(private SeriesRepository $seriesRepository)
    {

    }

    public function index(Request $request)
{
    $query = Series::query();

    if ($request->query('titulo')) {
        $query->where('titulo', '=', $request->titulo);
    }

    return $query->paginate(2);
}


    public function store(SeriesFormRequest $request)
    {

        $serie = $this->seriesRepository->add($request);

        return response()->json($serie, 201);
    }

    public function show(int $serie)
    {
        $serie = Series::with('seasons.episodes')->find($serie);

        if (!$serie) {
            return response()->json(['message' => 'Serie not found'], 404);
        }

        // Pegando os dados do relacionamento
        // $serie = Series::whereId($serie)->with('seasons.episodes')->get();
        // return response()->json($serie, 200);

        return $serie;

    }

    public function update(Series $serie, SeriesFormRequest $request)
    {

        $serie->update($request->all());
        return $serie;
    }

    public function destroy(Series $serie)
    {
        $serie->delete();
        return response()->noContent();
    }

}
