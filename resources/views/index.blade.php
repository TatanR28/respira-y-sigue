<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Respira y sigue</title>
    
</head>
<body>
    <header>
    <nav class="navbar">
        <div class="logo">
            Respira y sigue
        </div>

        <ul class="nav-links">
            <li><a href="{{ route('home') }}">Inicio</a></li>
            <li><a href="{{ route('test-emocional') }}">Test emocional</a></li>
            <li><a href="{{ route('ejercicios') }}">Ejercicios</a></li>
            <li><a href="#">Contacto</a></li>
        </ul>

        <a href="{{ route('login') }}" class="btn-login">Iniciar Sesión</a>
    </nav>
</header>

<main>

    <section class="hero">

        <div class="hero-text">
            <h1>Toma un respiro, sigue adelante 💙</h1>

            <p>
                Te acompañamos en tu bienestar emocional con
                herramientas, ejercicios y apoyo para tu día a día.
            </p>

            <a href="{{ route('login') }}" class="btn-comenzar">
                Comenzar ahora
            </a>
        </div>

        <div class="hero-image">
            <img src="imagenes/Home.png" alt="Bienestar emocional">
        </div>

    </section>

    <section class="funciones">

        <h2>¿Qué puedes hacer aquí?</h2>

        <div class="cards">

            <div class="card">
                <h3>🫁</h3>
                <h4>Ejercicios</h4>
                <p>Respiración guiada y relajación.</p>
            </div>

            <div class="card">
                <h3>📖</h3>
                <h4>Lecturas</h4>
                <p>Artículos para reflexionar.</p>
            </div>

            <div class="card">
                <h3>📝</h3>
                <h4>Recordatorios</h4>
                <p>Hábitos positivos diarios.</p>
            </div>

            <div class="card">
                <h3>😊</h3>
                <h4>Test emocional</h4>
                <p>Conoce cómo te sientes hoy.</p>
            </div>

            <div class="card">
                <h3>💙</h3>
                <h4>Mensajes</h4>
                <p>Motivación para seguir adelante.</p>
            </div>

        </div>

    </section>

    <footer class="footer">

    <div class="footer-content">

        <h3>Respira y Sigue 💙</h3>

        <p>
            Un espacio para cuidar tu bienestar emocional,
            respirar con calma y seguir adelante.
        </p>

        <div class="footer-links">
            <a href="Index.html">Inicio</a>
            <a href="#">Sobre Nosotros</a>
            <a href="#">Contacto</a>
            <a href="#">Privacidad</a>
        </div>

        <p class="copyright">
            © 2026 Respira y Sigue. Todos los derechos reservados.
        </p>

    </div>

</footer>

</main>
</body>
</html>