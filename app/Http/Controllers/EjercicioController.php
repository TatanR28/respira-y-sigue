<?php

namespace App\Http\Controllers;

use App\Models\Ejercicio;
use App\Models\EjercicioRegistro;
use Illuminate\Http\Request;

class EjercicioController extends Controller
{
    public function index(Request $request)
    {
        $categoriaSeleccionada = $request->query('categoria');

        $categorias = [
            'respiracion' => ['nombre' => 'Respiración guiada', 'icono' => '🫁'],
            'relajacion' => ['nombre' => 'Relajación muscular', 'icono' => '🚶'],
            'mindfulness' => ['nombre' => 'Mindfulness', 'icono' => '🌿'],
            'meditacion' => ['nombre' => 'Meditaciones', 'icono' => '🪷'],
        ];

        $ejercicios = Ejercicio::when($categoriaSeleccionada, function ($query) use ($categoriaSeleccionada) {
                return $query->where('categoria', $categoriaSeleccionada);
            })
            ->orderBy('categoria')
            ->get();

        return view('ejercicios', [
            'ejercicios' => $ejercicios,
            'categorias' => $categorias,
            'categoriaSeleccionada' => $categoriaSeleccionada,
        ]);
    }

    public function show(Ejercicio $ejercicio)
    {
        return view('ejercicio-detalle', ['ejercicio' => $ejercicio]);
    }

    public function completar(Request $request, Ejercicio $ejercicio)
    {
        EjercicioRegistro::create([
            'user_id' => $request->user()->id,
            'ejercicio_id' => $ejercicio->id,
            'completado_en' => now(),
        ]);

        return redirect()->route('ejercicios')->with('status', '¡Ejercicio completado! Sigue así 💙');
    }
}