<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $ejercicio->titulo }} - Respira y Sigue</title>
    <link rel="stylesheet" href="{{ asset('css/Ejercicios.css') }}">
</head>
<body>

<div class="dashboard">

    <aside class="sidebar" id="sidebar">
        <button class="toggle-btn" onclick="toggleMenu()">☰</button>
        <h2 class="logo">💙 Respira y Sigue</h2>
        <ul>
            <li><a href="{{ route('dashboard') }}"><span>🏠</span> <span class="text">Inicio</span></a></li>
            <li class="active"><a href="{{ route('ejercicios') }}"><span>🫁</span> <span class="text">Ejercicios</span></a></li>
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

        <a href="{{ route('ejercicios') }}">← Volver a Ejercicios</a>

        <h1>{{ $ejercicio->titulo }}</h1>

        @if ($ejercicio->duracion_minutos)
            <p class="subtitle">⏱ Duración aproximada: {{ $ejercicio->duracion_minutos }} minutos</p>
        @endif

        <div class="question-card">
            <p>{{ $ejercicio->descripcion }}</p>
        </div>

        <div class="question-card">
            <h3>Instrucciones</h3>
            <p>{!! nl2br(e($ejercicio->instrucciones)) !!}</p>
        </div>

        <form method="POST" action="{{ route('ejercicios.completar', $ejercicio) }}">
            @csrf
            <button type="submit" class="btn-primary">Marcar como completado ✔</button>
        </form>

    </main>

</div>

<script>
function toggleMenu(){
    document.getElementById("sidebar").classList.toggle("closed");
}
</script>

</body>
</html>