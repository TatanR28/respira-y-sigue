<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - Respira y Sigue</title>
    <link rel="stylesheet" href="css/Perfil.css">
</head>
<body>

<div class="dashboard">

    <aside class="sidebar" id="sidebar">

        <button class="toggle-btn" onclick="toggleMenu()">
            ☰
        </button>

        <h2 class="logo">💙 Respira y Sigue</h2>

<ul>

    <li><a href="{{ route('dashboard') }}"><span>🏠</span> <span class="text">Inicio</span></a></li>
    <li><a href="{{ route('ejercicios') }}"><span>🫁</span> <span class="text">Ejercicios</span></a></li>
    <li><a href="{{ route('recursos') }}"><span>📚</span> <span class="text">Recursos</span></a></li>
    <li><a href="{{ route('recordatorios') }}"><span>🔔</span> <span class="text">Recordatorios</span></a></li>
    <li><a href="{{ route('test-emocional') }}"><span>💙</span> <span class="text">Test emocional</span></a></li>
    <li class="active"><a href="{{ route('perfil') }}"><span>👤</span> <span class="text">Perfil</span></a></li>
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

        <h1>Mi Perfil</h1>

        <p class="subtitle">
            Gestiona tu información personal.
        </p>

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

        <div class="profile-card">

            <div class="profile-image">
                👤
            </div>

            <form class="profile-form" method="POST" action="{{ route('perfil.actualizar') }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nombre completo</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                </div>

                <div class="form-group">
                    <label>Correo electrónico</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                </div>

                <div class="form-group">
                    <label>Fecha de nacimiento</label>
                    <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', optional(auth()->user()->fecha_nacimiento)->format('Y-m-d')) }}">
                </div>

                <div class="form-group">
                    <label>Género</label>

                    <select name="genero">
                        <option value="">Seleccionar</option>
                        <option value="Masculino" @selected(old('genero', auth()->user()->genero) == 'Masculino')>Masculino</option>
                        <option value="Femenino" @selected(old('genero', auth()->user()->genero) == 'Femenino')>Femenino</option>
                        <option value="Otro" @selected(old('genero', auth()->user()->genero) == 'Otro')>Otro</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Nueva contraseña (deja en blanco para no cambiarla)</label>
                    <input type="password" name="password">
                </div>

                <div class="form-group">
                    <label>Confirmar nueva contraseña</label>
                    <input type="password" name="password_confirmation">
                </div>

                <button type="submit" class="save-btn">
                    Guardar cambios
                </button>

            </form>

        </div>

        <div class="stats-card">

            <h3>Tu actividad</h3>

            <div class="stats">

                <div class="stat">
                    <h2>{{ $ejerciciosRealizados }}</h2>
                    <p>Ejercicios realizados</p>
                </div>

                <div class="stat">
                    <h2>{{ $testsCompletados }}</h2>
                    <p>Tests completados</p>
                </div>

                <div class="stat">
                    <h2>0</h2>
                    <p>Recordatorios activos</p>
                </div>

                        <div style="text-align:center; margin-top:20px;">
            <a href="{{ route('perfil.reporte') }}" target="_blank" class="save-btn" style="text-decoration:none; display:inline-block;">
                📄 Generar reporte completo
            </a>
        </div>
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