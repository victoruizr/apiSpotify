<?php


use App\Http\Controllers\artists;
use App\Http\Controllers\AuthControllerUsers;
use App\Http\Controllers\Search;
use App\Http\Middleware\AuthJwtMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('loginUser',[AuthControllerUsers::class,'loginUser']);
Route::post('registerUser',[AuthControllerUsers::class,'registerUser']);
Route::post('getUserInfo',[AuthControllerUsers::class,'getUserInfo']);
Route::post('logOutUser',[AuthControllerUsers::class,'userLogout']);


Route::middleware([AuthJwtMiddleware::class])->group(function () {
    Route::get('artist/{id}',[artists::class,'showArtists']);
    Route::get('search',[Search::class,'searchInSpotify']);
});


