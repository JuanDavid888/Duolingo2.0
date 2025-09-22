<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Iniciar sesión</h1>

    @if($errors->any())
        <div style="color:red;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Contraseña" required><br><br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
