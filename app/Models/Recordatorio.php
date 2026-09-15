<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recordatorio extends Model
{
    protected $fillable = [
        'user_id',
        'icono',
        'titulo',
        'hora',
        'activo',
    ];

    protected function casts(): array
    {
        return [
            'hora' => 'datetime:H:i',
            'activo' => 'boolean',
        ];
    }
}