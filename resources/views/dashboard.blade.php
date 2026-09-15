<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Respira y Sigue</title>
    <link rel="stylesheet" href="{{ asset('css/Dashboard.css') }}">
</head>
<body>

<div class="dashboard">

    <aside class="sidebar" id="sidebar">

        <button class="toggle-btn" onclick="toggleMenu()">☰</button>

        <h2 class="logo">💙 Respira y Sigue</h2>

        <ul>
            <li class="active"><a href="{{ route('dashboard') }}"><span>🏠</span> <span class="text">Inicio</span></a></li>
            <li><a href="{{ route('ejercicios') }}"><span>🫁</span> <span class="text">Ejercicios</span></a></li>
            <li><a href="{{ route('recursos') }}"><span>📚</span> <span class="text">Recursos</span></a></li>
            <li><a href="{{ route('recordatorios') }}"><span>🔔</span> <span class="text">Recordatorios</span></a></li>
            <li><a href="{{ route('test-emocional') }}"><span>💙</span> <span class="text">Test emocional</span></a></li>
            <li><a href="{{ route('perfil') }}"><span>👤</span> <span class="text">Perfil</span></a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="background:none; border:none; padding:0; cursor:pointer; font:inherit; color:inherit; text-align:left; width:100%;">
                        <span>🚪</span> <span class="text">Cerrar sesión</span>
                    </button>
                </form>
            </li>
        </ul>

    </aside>

    <main class="content">

        <div class="welcome">
            <h1>¡Bienvenido, {{ auth()->user()->name }}! 👋</h1>
            <p>¿Cómo te sientes hoy?</p>
        </div>

        <div class="emociones">
            @php
                $opcionesAnimo = [
                    1 => ['emoji' => '😔', 'label' => 'Muy mal'],
                    2 => ['emoji' => '😕', 'label' => 'Mal'],
                    3 => ['emoji' => '😐', 'label' => 'Regular'],
                    4 => ['emoji' => '🙂', 'label' => 'Bien'],
                    5 => ['emoji' => '😁', 'label' => 'Muy bien'],
                ];
            @endphp

            @foreach ($opcionesAnimo as $valor => $opcion)
                <form method="POST" action="{{ route('dashboard.estado-animo') }}" style="display:contents;">
                    @csrf
                    <input type="hidden" name="valor" value="{{ $valor }}">
                    <button type="submit" class="mood" style="border:none; cursor:pointer; background:{{ $estadoHoy && $estadoHoy->valor == $valor ? '#BFE7FA' : 'transparent' }}; border-radius:12px;">
                        {{ $opcion['emoji'] }}<span>{{ $opcion['label'] }}</span>
                    </button>
                </form>
            @endforeach
        </div>

        <div class="cards">

            <div class="card">
                <h3>🫁 Ejercicio recomendado</h3>
                @if ($ejercicioRecomendado)
                    <p>{{ $ejercicioRecomendado->titulo }}</p>
                    <button class="btn-home"><a href="{{ route('ejercicios.detalle', $ejercicioRecomendado) }}">Comenzar</a></button>
                @else
                    <p>Haz el test emocional de hoy para recibir tu recomendación personalizada.</p>
                    <button class="btn-home"><a href="{{ route('test-emocional') }}">Hacer test de hoy</a></button>
                @endif
            </div>

            <div class="card">
                <h3>💭 Frase del día</h3>
                <p>"{{ $fraseDelDia }}"</p>
            </div>

            <div class="card">
                <h3>🔔 Próximo recordatorio</h3>
                @if ($proximoRecordatorio)
                    <p>{{ $proximoRecordatorio->icono }} {{ $proximoRecordatorio->titulo }} — {{ $proximoRecordatorio->hora->format('h:i A') }}</p>
                @else
                    <p>No tienes recordatorios activos todavía.</p>
                @endif
                <button class="btn-home"><a href="{{ route('recordatorios') }}">Ver recordatorios</a></button>
            </div>

            <div class="card">
                <h3>📈 Tu progreso</h3>
                <p>{{ $ejerciciosEstaSemana }} / {{ $metaSemanal }} ejercicios esta semana</p>
                <p>{{ $progreso }}% completado</p>
            </div>

        </div>

    </main>

</div>
<script>
function toggleMenu(){
    document
        .getElementById("sidebar")
        .classList
        .toggle("closed");
}
</script>

</body>
</html>