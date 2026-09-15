<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recordatorios - Respira y Sigue</title>
    <link rel="stylesheet" href="{{ asset('css/Recordatorios.css') }}">
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
            <li class="active"><a href="{{ route('recordatorios') }}"><span>🔔</span> <span class="text">Recordatorios</span></a></li>
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

        <div class="top-bar">
            <h1>Mis recordatorios</h1>
            <button class="add-btn" type="button" onclick="toggleFormulario()">+</button>
        </div>

        @if (session('status'))
            <div style="background:#d1e7dd; color:#0f5132; padding:10px; border-radius:6px; margin-bottom:15px;">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="background:#f8d7da; color:#842029; padding:10px; border-radius:6px; margin-bottom:15px;">
                <ul style="margin:0; padding-left:20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div id="formularioNuevo" style="display:none; background:white; border:2px solid #89CFF0; border-radius:15px; padding:20px; margin-bottom:20px;">
            <form method="POST" action="{{ route('recordatorios.guardar') }}">
                @csrf

                <div style="margin-bottom:12px;">
                    <label>Título</label><br>
                    <input type="text" name="titulo" placeholder="Ej. Beber agua" required style="width:100%; padding:8px; margin-top:4px;">
                </div>

                <div style="margin-bottom:12px;">
                    <label>Hora</label><br>
                    <input type="time" name="hora" required style="padding:8px; margin-top:4px;">
                </div>

                <div style="margin-bottom:12px;">
                    <label>Ícono</label><br>
                    <select name="icono" style="padding:8px; margin-top:4px;">
                        <option value="💧">💧 Agua</option>
                        <option value="🫁">🫁 Respiración</option>
                        <option value="🚶">🚶 Pausa activa</option>
                        <option value="🌙">🌙 Descanso</option>
                        <option value="💊">💊 Medicamento</option>
                        <option value="🔔">🔔 General</option>
                    </select>
                </div>

                <button type="submit" class="btn-primary">Guardar recordatorio</button>
            </form>
        </div>

        <div class="tabs">
            <a href="{{ route('recordatorios', ['estado' => 'proximos']) }}">
                <button class="{{ $estado === 'proximos' ? 'active-tab' : '' }}" type="button">Próximos</button>
            </a>
            <a href="{{ route('recordatorios', ['estado' => 'completados']) }}">
                <button class="{{ $estado === 'completados' ? 'active-tab' : '' }}" type="button">Completados</button>
            </a>
        </div>

        @forelse ($recordatorios as $recordatorio)
            <div class="reminder-card">

                <div class="icon">{{ $recordatorio->icono }}</div>

                <div class="info">
                    <h3>{{ $recordatorio->titulo }}</h3>
                    <p>Hoy {{ $recordatorio->hora->format('h:i A') }}</p>
                </div>

                <form method="POST" action="{{ route('recordatorios.alternar', $recordatorio) }}">
                    @csrf
                    <label class="switch">
                        <input type="checkbox" onchange="this.form.submit()" {{ $recordatorio->activo ? 'checked' : '' }}>
                        <span class="slider"></span>
                    </label>
                </form>

                <form method="POST" action="{{ route('recordatorios.eliminar', $recordatorio) }}" style="margin-left:10px;" onsubmit="return confirm('¿Eliminar este recordatorio?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background:none; border:none; cursor:pointer; font-size:18px;">🗑️</button>
                </form>

            </div>
        @empty
            <p>No tienes recordatorios {{ $estado === 'proximos' ? 'activos' : 'desactivados' }} por ahora.</p>
        @endforelse

        <div class="quote-card">
            <p>Pequeños recordatorios, grandes cambios. 💙</p>
        </div>

    </main>

</div>

<script>
function toggleMenu(){
    document.getElementById("sidebar").classList.toggle("closed");
}

function toggleFormulario(){
    const form = document.getElementById("formularioNuevo");
    form.style.display = (form.style.display === "none") ? "block" : "none";
}
</script>

</body>
</html>