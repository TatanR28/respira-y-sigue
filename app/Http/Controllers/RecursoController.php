<?php

namespace App\Http\Controllers;

use App\Models\Recurso;
use Illuminate\Http\Request;

class RecursoController extends Controller
{
    public function index(Request $request)
    {
        $tipoSeleccionado = $request->query('tipo', 'articulo');

        $tipos = [
            'articulo' => 'Artículos',
            'lectura' => 'Lecturas',
            'video' => 'Videos',
            'audio' => 'Audios',
        ];

        $recursos = Recurso::where('tipo', $tipoSeleccionado)
            ->latest()
            ->get();

        return view('recursos', [
            'recursos' => $recursos,
            'tipos' => $tipos,
            'tipoSeleccionado' => $tipoSeleccionado,
        ]);
    }

    public function show(Recurso $recurso)
    {
        return view('recurso-detalle', ['recurso' => $recurso]);
    }
}