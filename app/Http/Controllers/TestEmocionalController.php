<?php

namespace App\Http\Controllers;

use App\Models\TestEmocional;
use Illuminate\Http\Request;

class TestEmocionalController extends Controller
{
    public function guardar(Request $request)
    {
        $reglas = [];
        for ($i = 1; $i <= 10; $i++) {
            $reglas["q{$i}"] = ['required', 'integer', 'between:1,5'];
        }

        $validado = $request->validate($reglas);

        $puntajeEstres = $validado['q1'] + $validado['q2'] + $validado['q3'] + $validado['q4'] + $validado['q5'];
        $puntajeAnsiedad = $validado['q6'] + $validado['q7'] + $validado['q8'] + $validado['q9'] + $validado['q10'];

        $nivelEstres = $this->calcularNivel($puntajeEstres);
        $nivelAnsiedad = $this->calcularNivel($puntajeAnsiedad);

                $recomendacion = $this->recomendarCategoria($puntajeEstres, $puntajeAnsiedad, $nivelEstres, $nivelAnsiedad);

        $test = TestEmocional::create([
            'user_id' => $request->user()->id,
            'puntaje_estres' => $puntajeEstres,
            'puntaje_ansiedad' => $puntajeAnsiedad,
            'nivel_estres' => $nivelEstres,
            'nivel_ansiedad' => $nivelAnsiedad,
            'categoria_recomendada' => $recomendacion['texto'],
            'categoria_slug' => $recomendacion['slug'],
            'respuestas' => $validado,
        ]);

        return redirect()->route('test-emocional.resultado', $test);
    }

    public function resultado(TestEmocional $test)
    {
        abort_unless($test->user_id === auth()->id(), 403);

        return view('test-emocional-resultado', ['test' => $test]);
    }

    private function calcularNivel(int $puntaje): string
    {
        return match (true) {
            $puntaje <= 9 => 'Bajo',
            $puntaje <= 14 => 'Moderado',
            $puntaje <= 19 => 'Alto',
            default => 'Muy alto',
        };
    }

        private function recomendarCategoria(int $puntajeEstres, int $puntajeAnsiedad, string $nivelEstres, string $nivelAnsiedad): array
    {
        if ($nivelEstres === 'Bajo' && $nivelAnsiedad === 'Bajo') {
            return ['texto' => 'Meditaciones (mantenimiento)', 'slug' => 'meditacion'];
        }

        if ($puntajeEstres > $puntajeAnsiedad) {
            return in_array($nivelEstres, ['Alto', 'Muy alto'])
                ? ['texto' => 'Respiración guiada', 'slug' => 'respiracion']
                : ['texto' => 'Relajación muscular', 'slug' => 'relajacion'];
        }

        if ($puntajeAnsiedad > $puntajeEstres) {
            return in_array($nivelAnsiedad, ['Alto', 'Muy alto'])
                ? ['texto' => 'Mindfulness', 'slug' => 'mindfulness']
                : ['texto' => 'Meditaciones', 'slug' => 'meditacion'];
        }

        return ['texto' => 'Respiración guiada y Mindfulness', 'slug' => 'respiracion'];
    }
}