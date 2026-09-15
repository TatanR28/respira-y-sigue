<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios - Respira y Sigue</title>
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

        <h1>Ejercicios</h1>
        <p class="subtitle">Elige el ejercicio que necesitas hoy</p>

        @if (session('status'))
            <div style="background:#d1e7dd; color:#0f5132; padding:10px; border-radius:6px; margin-bottom:15px;">
                {{ session('status') }}
            </div>
        @endif

             <div class="filtros-categoria">
            <a href="{{ route('ejercicios') }}" class="filtro-btn {{ ! $categoriaSeleccionada ? 'activo' : '' }}">Todos</a>
            @foreach ($categorias as $slug => $info)
                <a href="{{ route('ejercicios', ['categoria' => $slug]) }}" class="filtro-btn {{ $categoriaSeleccionada === $slug ? 'activo' : '' }}">
                    {{ $info['icono'] }} {{ $info['nombre'] }}
                </a>
            @endforeach
        </div>

        @forelse ($ejercicios as $ejercicio)
            <a href="{{ route('ejercicios.detalle', $ejercicio) }}" style="text-decoration:none; color:inherit;">
                <div class="exercise-card">
                    <div class="icon">
                        {{ $categorias[$ejercicio->categoria]['icono'] ?? '💙' }}
                    </div>
                    <div>
                        <h3>{{ $ejercicio->titulo }}</h3>
                        <p>{{ $ejercicio->descripcion }}</p>
                    </div>
                    <span class="arrow">➜</span>
                </div>
            </a>
        @empty
            <p>No hay ejercicios en esta categoría todavía.</p>
        @endforelse

    </main>

</div>

<script>
function toggleMenu(){
    document.getElementById("sidebar").classList.toggle("closed");
}
</script>

</body>
</html>