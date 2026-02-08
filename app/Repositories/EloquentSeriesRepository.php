<?php

namespace App\Repositories;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Models\Season;
use App\Models\Episode;
use Illuminate\Support\Facades\DB;

// Uma classe de Repository é uma classe onde vai lidar com banco de dados, para não deixar a lógia dentro do controller
class EloquentSeriesRepository implements SeriesRepository{



    public function add(SeriesFormRequest $request): Series{
        // Transações 
        // 1° forma 
        // DB::beginTransaction();
        // DB::commit();
        // DB::rollBack(); 


        // 2° Forma de transação -> Já cuida do commit e rollback 
        return  DB::transaction(function () use ($request) {
            // mass assignment 2
            $serie = Series::create([
                'titulo' => $request->titulo,
                'cover' => $request->coverPath
            ]);
            // if ($serie) {
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

            return $serie;
        });
    }

}