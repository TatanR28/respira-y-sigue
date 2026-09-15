<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{
    protected $fillable = [
        'categoria',
        'titulo',
        'descripcion',
        'instrucciones',
        'duracion_minutos',
    ];
}