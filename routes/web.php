<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\HomeController;

//Rutas web
Route::get('/', function () {
    return view('welcome');
});

//Rutas de administración
Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::resource('works', WorkController::class);
    Route::resource('posts', PostController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('messages', MessageController::class);
});
