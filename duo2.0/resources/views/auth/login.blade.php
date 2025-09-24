<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #fbc2eb, #a6c1ee);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            display: flex;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 900px;
            max-width: 95%;
        }

        .form-section {
            flex: 1;
            padding: 40px;
        }

        .form-section h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
        }

        .form-section form {
            display: flex;
            flex-direction: column;
        }

        .form-section input {
            padding: 12px 15px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 1rem;
        }

        .form-section button {
            padding: 12px;
            background: #ff5f6d;
            border: none;
            border-radius: 10px;
            color: #fff;
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .form-section button:hover {
            background: #e04958;
        }

        .illustration-section {
            flex: 1;
            background: #f7f7f7;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .illustration-section img {
            max-width: 80%;
            height: auto;
        }

        .error-message {
            color: red;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Formulario -->
        <div class="form-section">
            <h1>Iniciar sesión</h1>

            @if ($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit">Entrar</button>
            </form>
        </div>

        <!-- Ilustración (pollito Kipo 🐤) -->
        <div class="illustration-section">
        <img src="{{ asset('img/WhatsApp%20Image%202025-09-23%20at%209.25.04%20AM.jpeg') }}" alt="Kipo">
        </div>
    </div>
</body>
</html>
