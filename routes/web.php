<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

// la fonction name m'aide a nommer mes differentes routes
Route::get('/', [PostController::class, 'index'])->name('index');
//avec ->whereNumber('id') je verifie que ce qui est renvoye kom id est belle et bien un entier
Route::get('/post/{id}', [PostController::class, 'show'])->whereNumber('id');
Route::get('/contact', [PostController::class, 'contact'])->name('contact');

