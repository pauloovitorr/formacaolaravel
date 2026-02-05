<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Season;
use Illuminate\Http\Request;


class EpisodesController extends Controller
{
    public function index(Season $seasons)
    {

        return view('episodes.index')
            ->with('episodes', $seasons->episodes)
            ->with('seasons', $seasons->id);
    }


    public function update(Request $request, Season $seasons)
    {

        $watchedEpisodes = $request->episodes;

        // dd($watchedEpisodes);

        if ($watchedEpisodes) {
            $seasons->episodes()
                ->whereIn('id', $watchedEpisodes)
                ->update(['watched' => true]);
        }
        else{
            $seasons->episodes()->update(['watched' => false]);
        }

        return redirect()
            ->route('episodes.index', $seasons->id)
            ->with('success', 'Episódios atualizados com sucesso!');

    }

}
