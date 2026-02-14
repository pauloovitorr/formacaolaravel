<?php

use App\Http\Controllers\Api\SeriesController;
use App\Models\Episode;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::controller(SeriesController::class)
  ->middleware('auth:sanctum')
  ->group(function () {

    Route::get('/series', 'index');
    Route::get('/series/{serie}', 'show');
    Route::post('/series', 'store');
    Route::put('/series/{serie}', 'update');
    Route::delete('/series/{serie}', 'destroy');

  });



Route::middleware('auth:sanctum')
  ->group(function () {
    Route::get('/series/{serie}/seasons', function (Series $serie) {
      return $serie->seasons;
    });

    Route::get('/series/{serie}/episodes', function (Series $serie) {
      return $serie->episodes;
    });

    Route::patch('/episodes/{episode}', function (Episode $episode, Request $request) {
      $episode->watched = $request->watched;
      $episode->save();

      return $episode;

    });
  });

Route::post('/login', function (Request $request) {
  $credentials = $request->only(['email', 'password']);

  if (Auth::attempt($credentials) === false) {
    return response()->json(['message' => 'Unauthorized'], 401);
  }

  $user = Auth::user();
  $token = $user->createToken('token');

  return response()->json([
    'token' => $token->plainTextToken
  ]);
});
