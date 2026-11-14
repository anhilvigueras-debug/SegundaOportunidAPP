<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicacionController;

// Vista principal 
Route::view('/', 'inicio')->name('inicio');

// Vistas públicas e informativas
Route::view('/nosotros', 'nosotros')->name('nosotros');
Route::view('/servicios', 'servicios')->name('servicios');
Route::view('/contacto', 'contacto')->name('contacto');

//  (Usuarios)
Route::view('/login', 'usuarios.login')->name('login');
Route::post('/login', function () {
    // Zayra conectará aquí su AuthController@login
})->name('login.post');
Route::view('/perfil', 'usuarios.perfil')->name('perfil');

//  Luis y Anhil (CRUD Publicaciones dinámico en BD)
Route::resource('publicaciones', PublicacionController::class);

//  Angel Daniel (Mensajería)
Route::view('/mensajes', 'mensajes.index')->name('mensajes');

// (Transacciones y Donaciones)
Route::view('/donaciones', 'transacciones.donaciones')->name('donaciones');

// Diego (Reportes y Admin)
Route::view('/reporte', 'reportes.create')->name('reporte');
Route::view('/admin', 'reportes.admin')->name('admin');