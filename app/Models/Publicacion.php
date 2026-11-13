<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Publicacion extends Model
{
    use HasFactory;
    protected $fillable = ['titulo', 'descripcion', 'tipo', 'precio', 'categoria', 'estado_articulo'];
    protected function casts(): array { return ['precio' => 'decimal:2']; }
    public function venta(): HasOne { return $this->hasOne(Venta::class); }
}
