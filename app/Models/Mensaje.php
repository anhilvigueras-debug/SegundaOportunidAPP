<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $table = 'mensajes';

    protected $fillable = [
        'conversacion_id',
        'emisor_id',
        'receptor_id',
        'contenido',
        'leido',
    ];

    public function conversacion()
    {
        return $this->belongsTo(Conversacion::class, 'conversacion_id');
    }

    public function emisor()
    {
        return $this->belongsTo(User::class, 'emisor_id');
    }
}
