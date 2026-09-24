<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Emocional - Respira y Sigue</title>
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

        <h1>Test emocional diario</h1>
        <p class="subtitle">Responde estas preguntas para conocer cómo te sientes hoy.</p>

        <div class="leyenda-escala">
            <span class="badge">5 = Muy alto</span>
            <span class="badge">4 = Alto</span>
            <span class="badge">3 = Intermedio</span>
            <span class="badge">2 = Bajo</span>
            <span class="badge">1 = Muy bajo</span>
        </div>

        @if ($errors->any())
            <div style="background:#f8d7da; color:#842029; padding:10px; border-radius:6px; margin-bottom:15px;">
                <ul style="margin:0; padding-left:20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="progress-container">
            <div class="progress-bar">
                <div class="progress" id="progressBar" style="width:10%;"></div>
            </div>
            <span id="progressText">Pregunta 1 de 10</span>
        </div>

        <form method="POST" action="{{ route('test-emocional.guardar') }}" id="testForm">
            @csrf

            @php
                $preguntas = [
                    1 => '¿Cómo ha sido tu nivel de estrés hoy?',
                    2 => '¿Te ha costado concentrarte por el estrés?',
                    3 => '¿Has sentido tensión física (dolor de cabeza, cuello o espalda)?',
                    4 => '¿Sientes que tienes demasiadas responsabilidades encima?',
                    5 => '¿Te cuesta relajarte al final del día?',
                    6 => '¿Has sentido preocupación excesiva hoy?',
                    7 => '¿Has tenido pensamientos acelerados o difíciles de controlar?',
                    8 => '¿Has sentido palpitaciones o nerviosismo sin razón aparente?',
                    9 => '¿Te ha costado conciliar el sueño por pensamientos ansiosos?',
                    10 => '¿Sientes miedo o inquietud frente a situaciones cotidianas?',
                ];
            @endphp

            @foreach ($preguntas as $numero => $texto)
                <div class="question-step" data-step="{{ $numero }}" style="{{ $numero === 1 ? '' : 'display:none;' }}">
                    <div class="question-card">
                        <h3>{{ $texto }}</h3>

                        <div class="opciones-numericas">
                            <label class="opcion-num">
                                <input type="radio" name="q{{ $numero }}" value="5" required>
                                <span class="numero">5</span>
                                <span class="etiqueta">Muy alto</span>
                            </label>
                            <label class="opcion-num">
                                <input type="radio" name="q{{ $numero }}" value="4">
                                <span class="numero">4</span>
                                <span class="etiqueta">Alto</span>
                            </label>
                            <label class="opcion-num">
                                <input type="radio" name="q{{ $numero }}" value="3">
                                <span class="numero">3</span>
                                <span class="etiqueta">Intermedio</span>
                            </label>
                            <label class="opcion-num">
                                <input type="radio" name="q{{ $numero }}" value="2">
                                <span class="numero">2</span>
                                <span class="etiqueta">Bajo</span>
                            </label>
                            <label class="opcion-num">
                                <input type="radio" name="q{{ $numero }}" value="1">
                                <span class="numero">1</span>
                                <span class="etiqueta">Muy bajo</span>
                            </label>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="buttons">
                <button type="button" class="btn-secondary" id="btnAnterior" onclick="cambiarPaso(-1)" style="visibility:hidden;">
                    ← Anterior
                </button>

                <button type="button" class="btn-primary" id="btnSiguiente" onclick="cambiarPaso(1)">
                    Siguiente →
                </button>

                <button type="submit" class="btn-primary" id="btnFinalizar" style="display:none;">
                    Finalizar ✔
                </button>
            </div>

        </form>

        <div class="info-card">
            ⭐ Este test es solo para ti y nos ayuda a recomendarte mejores ejercicios.
        </div>

    </main>

</div>

<script>
function toggleMenu(){
    document.getElementById("sidebar").classList.toggle("closed");
}

const totalPreguntas = 10;
let pasoActual = 1;

function mostrarPaso(paso) {
    document.querySelectorAll(".question-step").forEach(function (el) {
        el.style.display = (parseInt(el.dataset.step) === paso) ? "block" : "none";
    });

    document.getElementById("progressBar").style.width = ((paso / totalPreguntas) * 100) + "%";
    document.getElementById("progressText").textContent = "Pregunta " + paso + " de " + totalPreguntas;

    document.getElementById("btnAnterior").style.visibility = (paso === 1) ? "hidden" : "visible";
    document.getElementById("btnSiguiente").style.display = (paso === totalPreguntas) ? "none" : "inline-block";
    document.getElementById("btnFinalizar").style.display = (paso === totalPreguntas) ? "inline-block" : "none";
}

function cambiarPaso(direccion) {
    const seleccionActual = document.querySelector('input[name="q' + pasoActual + '"]:checked');

    if (direccion === 1 && !seleccionActual) {
        alert("Por favor selecciona una opción antes de continuar.");
        return;
    }

    const nuevoPaso = pasoActual + direccion;

    if (nuevoPaso < 1 || nuevoPaso > totalPreguntas) {
        return;
    }

    pasoActual = nuevoPaso;
    mostrarPaso(pasoActual);
}
</script>

</body>
</html>