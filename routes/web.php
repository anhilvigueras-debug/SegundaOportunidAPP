<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicacionController;

Route::redirect('/', '/publicaciones');

Route::resource('publicaciones', PublicacionController::class);