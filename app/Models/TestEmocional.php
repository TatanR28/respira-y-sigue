<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestEmocional extends Model
{
    protected $table = 'tests_emocionales';

    protected $fillable = [
    'user_id',
    'puntaje_estres',
    'puntaje_ansiedad',
    'nivel_estres',
    'nivel_ansiedad',
    'categoria_recomendada',
    'categoria_slug',
    'respuestas',
];

    protected function casts(): array
    {
        return [
            'respuestas' => 'array',
        ];
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}