<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'tipo',
        'precio',
        'categoria',
        'estado_articulo',
        'foto',
        'user_id',
        'disponible',
    ];

        protected function casts(): array
        {
            return [
                'precio' => 'decimal:2',
                'disponible' => 'boolean',
            ];
        }

        public function user(): BelongsTo
        {
            return $this->belongsTo(User::class);
        }
}
