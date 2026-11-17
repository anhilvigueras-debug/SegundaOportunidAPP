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
Route::middleware('auth')->group(function () {
    Route::get('/mensajes', [App\Http\Controllers\MensajeController::class, 'index'])->name('mensajes.index');
    Route::get('/mensajes/iniciar/{publicacion_id}', [App\Http\Controllers\MensajeController::class, 'iniciar'])->name('mensajes.iniciar');
    Route::get('/mensajes/{conversacion_id}', [App\Http\Controllers\MensajeController::class, 'show'])->name('mensajes.show');
    Route::post('/mensajes/{conversacion_id}/enviar', [App\Http\Controllers\MensajeController::class, 'enviar'])->name('mensajes.enviar');
Route::delete('/mensajes/mensaje/{id}', [App\Http\Controllers\MensajeController::class, 'eliminarMensaje'])->name('mensajes.eliminar');
    Route::patch('/mensajes/{conversacion_id}/ocultar', [App\Http\Controllers\MensajeController::class, 'ocultar'])->name('mensajes.ocultar');
});

// (Transacciones y Donaciones)
Route::view('/donaciones', 'transacciones.donaciones')->name('donaciones');

// Diego (Reportes y Admin)
Route::view('/reporte', 'reportes.create')->name('reporte');
Route::view('/admin', 'reportes.admin')->name('admin');


// Ventas y aportaciones económicas
Route::resource('ventas', \App\Http\Controllers\VentaController::class);

Route::get(
    'aportaciones/{aportacion}/comprobante',
    [\App\Http\Controllers\AportacionController::class, 'comprobante']
)->name('aportaciones.comprobante');

Route::resource('aportaciones', \App\Http\Controllers\AportacionController::class)
    ->parameters(['aportaciones' => 'aportacion']);
