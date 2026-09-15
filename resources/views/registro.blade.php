<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/registro.css">
</head>
<body>

    <div class="register-container">
        <h2>Crear Cuenta</h2>

        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('registro') }}">
            @csrf
            <input type="text" name="name" placeholder="Nombre completo" value="{{ old('name') }}" required>
            <input type="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required>
            <input type="password" name="password" placeholder="Contraseña (mínimo 8 caracteres)" required>
            <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>

            <button type="submit">Registrarse</button>
        </form>

        <p>¿Ya tienes cuenta? <a href="{{ route('login') }}">Iniciar Sesión</a></p>
    </div>

</body>
</html>