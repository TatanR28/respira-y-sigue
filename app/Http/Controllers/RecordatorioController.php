<?php

namespace App\Http\Controllers;

use App\Models\Recordatorio;
use Illuminate\Http\Request;

class RecordatorioController extends Controller
{
    public function index(Request $request)
    {
        $estado = $request->query('estado', 'proximos');

        $recordatorios = Recordatorio::where('user_id', $request->user()->id)
            ->where('activo', $estado === 'proximos')
            ->orderBy('hora')
            ->get();

        return view('recordatorios', [
            'recordatorios' => $recordatorios,
            'estado' => $estado,
        ]);
    }

    public function store(Request $request)
    {
        $validado = $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'hora' => ['required', 'date_format:H:i'],
            'icono' => ['required', 'string', 'max:10'],
        ]);

        Recordatorio::create([
            'user_id' => $request->user()->id,
            'titulo' => $validado['titulo'],
            'hora' => $validado['hora'],
            'icono' => $validado['icono'],
            'activo' => true,
        ]);

        return redirect()->route('recordatorios')->with('status', 'Recordatorio creado correctamente.');
    }

    public function alternar(Request $request, Recordatorio $recordatorio)
    {
        abort_unless($recordatorio->user_id === $request->user()->id, 403);

        $recordatorio->update(['activo' => ! $recordatorio->activo]);

        return redirect()->back();
    }

    public function destroy(Request $request, Recordatorio $recordatorio)
    {
        abort_unless($recordatorio->user_id === $request->user()->id, 403);

        $recordatorio->delete();

        return redirect()->route('recordatorios')->with('status', 'Recordatorio eliminado.');
    }
}