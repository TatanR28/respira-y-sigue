<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del test - Respira y Sigue</title>
    <link rel="stylesheet" href="{{ asset('css/Test emocional.css') }}">
</head>
<body>

<div class="dashboard">

    <aside class="sidebar" id="sidebar">
        <button class="toggle-btn" onclick="toggleMenu()">☰</button>
        <h2 class="logo">💙 Respira y Sigue</h2>
        <ul>
            <li><a href="{{ route('dashboard') }}"><span>🏠</span> <span class="text">Inicio</span></a></li>
            <li><a href="{{ route('ejercicios') }}"><span>🫁</span> <span class="text">Ejercicios</span></a></li>
            <li><a href="{{ route('recursos') }}"><span>📚</span> <span class="text">Recursos</span></a></li>
            <li><a href="{{ route('recordatorios') }}"><span>🔔</span> <span class="text">Recordatorios</span></a></li>
            <li class="active"><a href="{{ route('test-emocional') }}"><span>💙</span> <span class="text">Test emocional</span></a></li>
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

        <h1>Resultado de tu test</h1>
        <p class="subtitle">Esto es lo que detectamos hoy:</p>

        <div class="question-card">
            <h3>Nivel de estrés: {{ $test->nivel_estres }}</h3>
            <p>Puntaje: {{ $test->puntaje_estres }} / 25</p>
        </div>

        <div class="question-card">
            <h3>Nivel de ansiedad: {{ $test->nivel_ansiedad }}</h3>
            <p>Puntaje: {{ $test->puntaje_ansiedad }} / 25</p>
        </div>

        <div class="info-card">
            💡 Recomendación: <strong>{{ $test->categoria_recomendada }}</strong>
        </div>

        <div class="buttons">
            <a href="{{ route('ejercicios', ['categoria' => $test->categoria_slug]) }}" class="btn-primary">Ver ejercicios recomendados →</a>
        </div>

    </main>

</div>

<script>
function toggleMenu(){
    document.getElementById("sidebar").classList.toggle("closed");
}
</script>

</body>
</html>