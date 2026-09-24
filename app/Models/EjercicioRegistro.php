<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EjercicioRegistro extends Model
{
    protected $table = 'ejercicio_registros';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'ejercicio_id',
        'completado_en',
    ];

    public function ejercicio()
    {
        return $this->belongsTo(Ejercicio::class);
    }
}