<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Venta extends Model
{
    protected $fillable = ['publicacion_id', 'comprador', 'monto', 'comision_puntos_base', 'comision', 'monto_vendedor'];
    protected function casts(): array
    {
        return ['monto' => 'decimal:2', 'comision' => 'decimal:2', 'monto_vendedor' => 'decimal:2', 'comision_puntos_base' => 'integer'];
    }
    public function publicacion(): BelongsTo
    {
        return $this->belongsTo(Publicacion::class);
    }
}
