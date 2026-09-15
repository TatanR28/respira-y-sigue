<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

    <div class="login-container">
        <h2>Iniciar Sesión</h2>

        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required>
            <input type="password" name="password" placeholder="Contraseña" required>

            <button type="submit">Entrar</button>
        </form>

        <p>¿No tienes cuenta? <a href="{{ route('registro') }}">Regístrate</a></p>
    </div>

</body>
</html>