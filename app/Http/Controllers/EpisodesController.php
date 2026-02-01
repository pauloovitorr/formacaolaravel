<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Season;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    public function index(Season $seasons )
    {
        return view('episodes.index')->with('episodes', $seasons->episodes);
    }


    public function store(Request $request ){
    dd($request->all());
    }

}
