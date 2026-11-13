<?php
use App\Http\Controllers\AportacionController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/publicaciones');
Route::resource('publicaciones', PublicacionController::class);
Route::resource('ventas', VentaController::class);
Route::get('aportaciones/{aportacion}/comprobante', [AportacionController::class, 'comprobante'])->name('aportaciones.comprobante');
Route::resource('aportaciones', AportacionController::class)->parameters(['aportaciones'=>'aportacion']);
