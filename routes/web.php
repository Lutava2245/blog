<?php

use App\Http\Controllers\PostagemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('postagens', PostagemController::class);
Route::post('postagens/{id}/curtir', [PostagemController::class, 'curtir']);
