<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoAnimo extends Model
{
    protected $table = 'estados_animo';

    protected $fillable = [
        'user_id',
        'valor',
        'fecha',
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'date',
        ];
    }
}