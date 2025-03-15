<?php


use App\Http\Controllers\artists;
use App\Http\Controllers\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::get('artist/{id}',[artists::class,'showArtists']);
Route::get('search',[Search::class,'searchInSpotify']);
