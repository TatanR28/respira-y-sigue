<?php

namespace App\Http\Controllers;

use App\Models\Recordatorio;
use App\Models\Ejercicio;
use App\Models\EjercicioRegistro;
use App\Models\EstadoAnimo;
use App\Models\TestEmocional;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    private array $frases = [
        'No tienes que ser perfecto para avanzar, solo tienes que seguir.',
        'Respira. Estás exactamente donde necesitas estar.',
        'Cada pequeño paso cuenta, incluso los que no se ven.',
        'Está bien no estar bien todo el tiempo.',
        'Tu calma de hoy es el resultado de tu esfuerzo de ayer.',
        'Sé amable contigo mismo, estás haciendo lo mejor que puedes.',
        'La paz empieza con una respiración profunda.',
    ];

    public function index(Request $request)
    {
        $usuario = $request->user();

        $estadoHoy = EstadoAnimo::where('user_id', $usuario->id)
            ->whereDate('fecha', now())
            ->first();

        $ultimoTest = TestEmocional::where('user_id', $usuario->id)
            ->whereDate('created_at', now())
            ->latest()
            ->first();

        $ejercicioRecomendado = $ultimoTest
            ? Ejercicio::where('categoria', $ultimoTest->categoria_slug)->inRandomOrder()->first()
            : null;

        $inicioSemana = Carbon::now()->startOfWeek();
        $ejerciciosEstaSemana = EjercicioRegistro::where('user_id', $usuario->id)
            ->where('completado_en', '>=', $inicioSemana)
            ->count();

        $metaSemanal = 5;
        $progreso = (int) min(100, round(($ejerciciosEstaSemana / $metaSemanal) * 100));

                $fraseDelDia = $this->frases[now()->dayOfYear % count($this->frases)];

        $proximoRecordatorio = Recordatorio::where('user_id', $usuario->id)
            ->where('activo', true)
            ->orderBy('hora')
            ->get()
            ->first(fn ($r) => $r->hora->format('H:i') >= now()->format('H:i'))
            ?? Recordatorio::where('user_id', $usuario->id)->where('activo', true)->orderBy('hora')->first();

                return view('dashboard', [
            'estadoHoy' => $estadoHoy,
            'ejercicioRecomendado' => $ejercicioRecomendado,
            'ejerciciosEstaSemana' => $ejerciciosEstaSemana,
            'metaSemanal' => $metaSemanal,
            'progreso' => $progreso,
            'fraseDelDia' => $fraseDelDia,
            'proximoRecordatorio' => $proximoRecordatorio,
        ]);
    }

    public function guardarEstado(Request $request)
    {
        $validado = $request->validate([
            'valor' => ['required', 'integer', 'between:1,5'],
        ]);

        EstadoAnimo::updateOrCreate(
            ['user_id' => $request->user()->id, 'fecha' => now()->toDateString()],
            ['valor' => $validado['valor']]
        );

        return redirect()->route('dashboard');
    }
}