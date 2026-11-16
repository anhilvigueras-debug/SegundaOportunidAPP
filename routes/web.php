<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\UsuarioController;

// Vista principal
Route::view('/', 'inicio')->name('inicio');

// Vistas públicas e informativas
Route::view('/nosotros', 'nosotros')->name('nosotros');
Route::view('/servicios', 'servicios')->name('servicios');
Route::view('/contacto', 'contacto')->name('contacto');

// Zayra (Usuarios y Perfil)
Route::get('/registro', [UsuarioController::class, 'mostrarRegistro'])->name('registro');
Route::post('/registro', [UsuarioController::class, 'registrar'])->name('registro.post');

Route::get('/login', [UsuarioController::class, 'mostrarLogin'])->name('login');
Route::post('/login', [UsuarioController::class, 'login'])->name('login.post');

Route::middleware('auth')->group(function () {
    Route::get('/perfil', [UsuarioController::class, 'mostrarPerfil'])->name('perfil');
    Route::put('/perfil', [UsuarioController::class, 'actualizarPerfil'])->name('perfil.actualizar');
    Route::post('/logout', [UsuarioController::class, 'logout'])->name('logout');
});

// Luis y Anhil (CRUD Publicaciones dinámico en BD)
Route::resource('publicaciones', PublicacionController::class);
Route::patch('/publicaciones/{publicacion}/finalizar', [PublicacionController::class, 'finalizar'])
    ->middleware('auth')
    ->name('publicaciones.finalizar');
    
// Angel Daniel (Mensajería)
Route::view('/mensajes', 'mensajes.index')->name('mensajes');

// (Transacciones y Donaciones)
Route::view('/donaciones', 'transacciones.donaciones')->name('donaciones');

// Diego (Reportes y Admin)
Route::view('/reporte', 'reportes.create')->name('reporte');
Route::view('/admin', 'reportes.admin')->name('admin');