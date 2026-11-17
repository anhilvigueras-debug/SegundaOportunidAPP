<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aportacion extends Model
{
    protected $table = 'aportaciones';
    protected $fillable = ['nombre', 'correo', 'monto', 'referencia', 'comprobante_nombre', 'comprobante_tipo', 'comprobante_contenido'];
    protected $hidden = ['comprobante_contenido'];
    protected function casts(): array
    {
        return ['monto' => 'decimal:2'];
    }
}
