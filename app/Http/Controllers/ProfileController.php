<?php

namespace App\Http\Controllers;

use App\Models\EjercicioRegistro;
use App\Models\EstadoAnimo;
use App\Models\Recordatorio;
use App\Models\TestEmocional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'fecha_nacimiento' => ['nullable', 'date'],
            'genero' => ['nullable', 'string', 'in:Masculino,Femenino,Otro'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->fecha_nacimiento = $validated['fecha_nacimiento'] ?? null;
        $user->genero = $validated['genero'] ?? null;

        if (! empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('perfil')->with('status', 'Perfil actualizado correctamente.');
    }

        public function reporte(Request $request)
    {
        $usuario = $request->user();

        $tests = TestEmocional::where('user_id', $usuario->id)->latest()->get();

        $ejerciciosCompletados = EjercicioRegistro::where('user_id', $usuario->id)
            ->with('ejercicio')
            ->orderByDesc('completado_en')
            ->get();

        $recordatoriosActivos = Recordatorio::where('user_id', $usuario->id)
            ->where('activo', true)
            ->orderBy('hora')
            ->get();

        $estadosAnimo = EstadoAnimo::where('user_id', $usuario->id)
            ->orderByDesc('fecha')
            ->take(14)
            ->get();

        return view('perfil-reporte', [
            'usuario' => $usuario,
            'tests' => $tests,
            'ejerciciosCompletados' => $ejerciciosCompletados,
            'recordatoriosActivos' => $recordatoriosActivos,
            'estadosAnimo' => $estadosAnimo,
        ]);
    }
}