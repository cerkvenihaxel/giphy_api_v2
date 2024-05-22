<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('signup', [\App\Http\Controllers\AuthController::class, 'signup']);

Route::middleware('auth:api')->group(function (){
    Route::get('gifs/search', [\App\Http\Controllers\GiphyController::class, 'search']);
    Route::get('gifs/searchById', [\App\Http\Controllers\GiphyController::class, 'searchById']);
    Route::post('gifs/saveGif', [\App\Http\Controllers\GiphyController::class, 'saveGifs']);
});
