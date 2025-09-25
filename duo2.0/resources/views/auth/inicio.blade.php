<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KipoLogin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Variables CSS inspiradas en Kipo */
        :root {
            --kipo-yellow: #eeeae3;
            --kipo-orange: #FF9E6D;
            --kipo-blue: #06D6A0;
            --kipo-light-blue: #118AB2;
            --kipo-dark: #073B4C;
            --kipo-light: #FFFCF9;
            --border-radius: 20px;
            --box-shadow: 0 15px 35px rgba(7, 59, 76, 0.1);
            --transition: all 0.3s ease;
        }

        /* Reset y estilos base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Nunito', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, var(--kipo-yellow), var(--kipo-orange));
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow: hidden;
            position: relative;
        }

        /* Efectos de burbujas de fondo */
        .bubbles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .bubble {
            position: absolute;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: float 15s infinite linear;
        }

        @keyframes float {
            0% {
                transform: translateY(0) translateX(0) rotate(0deg);
                opacity: 0.5;
            }
            100% {
                transform: translateY(-1000px) translateX(500px) rotate(720deg);
                opacity: 0;
            }
        }

        /* Contenedor principal del login - Ocupa toda la pantalla */
        .login-container {
            display: flex;
            background: rgba(255, 252, 249, 0.95);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            width: 1000px;
            max-width: 95%;
            min-height: 600px;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            /* Centrado absoluto */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: fadeIn 0.8s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translate(-50%, -40%);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }

        /* Sección del formulario */
        .form-section {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        /* Selector de idioma */
        .language-selector {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 10px;
            z-index: 2;
        }

        .language-flag {
            width: 30px;
            height: 20px;
            border-radius: 3px;
            cursor: pointer;
            transition: var(--transition);
            border: 2px solid transparent;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .language-flag:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .language-flag.active {
            border-color: var(--kipo-yellow);
            box-shadow: 0 0 0 3px rgba(255, 209, 102, 0.3);
        }

        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            background: var(--kipo-yellow);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: var(--kipo-dark);
            font-size: 1.5rem;
            box-shadow: 0 5px 15px rgba(255, 209, 102, 0.4);
        }

        .logo-text {
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--kipo-yellow), var(--kipo-orange));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-section h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            color: var(--kipo-dark);
            font-weight: 700;
        }

        .form-section p {
            color: var(--kipo-dark);
            opacity: 0.7;
            margin-bottom: 30px;
            font-size: 1.1rem;
        }

        .form-section form {
            display: flex;
            flex-direction: column;
        }

        .input-group {
            position: relative;
            margin-bottom: 25px;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--kipo-dark);
            opacity: 0.6;
            font-size: 1.2rem;
            transition: var(--transition);
        }

        .form-section input {
            padding: 15px 15px 15px 50px;
            border: 2px solid rgba(7, 59, 76, 0.1);
            border-radius: 12px;
            font-size: 1rem;
            width: 100%;
            transition: var(--transition);
            background-color: rgba(255, 209, 102, 0.1);
            color: var(--kipo-dark);
        }

        .form-section input:focus {
            border-color: var(--kipo-yellow);
            box-shadow: 0 0 0 3px rgba(255, 209, 102, 0.3);
            outline: none;
            background-color: white;
        }

        .form-section input:focus + i {
            color: var(--kipo-yellow);
            opacity: 1;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 0.9rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            color: var(--kipo-dark);
        }

        .remember-me input {
            margin-right: 8px;
            width: auto;
            accent-color: var(--kipo-yellow);
        }

        .forgot-password {
            color: var(--kipo-light-blue);
            text-decoration: none;
            transition: var(--transition);
            font-weight: 600;
        }

        .forgot-password:hover {
            color: var(--kipo-blue);
            text-decoration: underline;
        }

        .form-section button {
            padding: 15px;
            background: linear-gradient(135deg, var(--kipo-yellow), var(--kipo-orange));
            border: none;
            border-radius: 12px;
            color: var(--kipo-dark);
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 5px 15px rgba(255, 209, 102, 0.4);
            position: relative;
            overflow: hidden;
        }

        .form-section button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 209, 102, 0.6);
        }

        .form-section button:active {
            transform: translateY(0);
        }

        .form-section button::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: 0.5s;
        }

        .form-section button:hover::after {
            left: 100%;
        }

        .register-link {
            text-align: center;
            margin-top: 30px;
            color: var(--kipo-dark);
            opacity: 0.7;
        }

        .register-link a {
            color: var(--kipo-light-blue);
            text-decoration: none;
            font-weight: 700;
            transition: var(--transition);
        }

        .register-link a:hover {
            color: var(--kipo-blue);
            text-decoration: underline;
        }

        /* Sección de ilustración */
        .illustration-section {
            flex: 1;
            background: linear-gradient(135deg, var(--kipo-yellow), var(--kipo-orange));
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .illustration-section::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" fill="none"><defs><pattern id="grid" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.2)"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            animation: moveGrid 20s linear infinite;
        }

        @keyframes moveGrid {
            0% {
                transform: translate(0, 0);
            }
            100% {
                transform: translate(-50px, -50px);
            }
        }

        .illustration-content {
            position: relative;
            z-index: 1;
            text-align: center;
            color: var(--kipo-dark);
        }

        .kipo-frame {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            box-shadow: 0 15px 30px rgba(7, 59, 76, 0.2);
            border: 8px solid white;
            overflow: hidden;
            transition: var(--transition);
        }

        .kipo-frame:hover {
            transform: scale(1.05) rotate(5deg);
        }

        .kipo-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .illustration-section h2 {
            font-size: 2rem;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .illustration-section p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* Mensajes de error */
        .error-message {
            color: #E53E3E;
            margin-bottom: 15px;
            font-size: 0.9rem;
            padding: 10px 15px;
            background-color: rgba(229, 62, 62, 0.1);
            border-radius: 8px;
            border-left: 4px solid #E53E3E;
            display: flex;
            align-items: center;
        }

        .error-message i {
            margin-right: 10px;
        }

        /* Indicadores de validación */
        .validation-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0;
            transition: var(--transition);
        }

        .input-group.valid .validation-icon {
            opacity: 1;
            color: var(--kipo-blue);
        }

        .input-group.invalid .validation-icon {
            opacity: 1;
            color: #E53E3E;
        }

        /* Elementos decorativos Kipo */
        .kipo-decoration {
            position: absolute;
            z-index: -1;
        }

        .decoration-1 {
            width: 100px;
            height: 100px;
            background: var(--kipo-yellow);
            border-radius: 50%;
            top: -30px;
            right: -30px;
            opacity: 0.3;
        }

        .decoration-2 {
            width: 70px;
            height: 70px;
            background: var(--kipo-orange);
            border-radius: 50%;
            bottom: -20px;
            left: -20px;
            opacity: 0.3;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .login-container {
                flex-direction: column;
                width: 95%;
                max-width: 500px;
            }
            
            .illustration-section {
                display: none;
            }
            
            .form-section {
                padding: 40px 30px;
            }
        }

        @media (max-width: 480px) {
            .form-section {
                padding: 30px 20px;
            }
            
            .form-section h1 {
                font-size: 2rem;
            }
            
            .form-options {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .forgot-password {
                margin-top: 10px;
            }
            
            .logo-text {
                font-size: 1.5rem;
            }
            
            .language-selector {
                top: 10px;
                right: 10px;
            }
            
            .language-flag {
                width: 25px;
                height: 16px;
            }
        }
    </style>
</head>
<body>
    <!-- Burbujas de fondo -->
    <div class="bubbles" id="bubbles"></div>
    
    <!-- Contenedor principal del login -->
    <div class="login-container" id="loginContainer">
        <!-- Elementos decorativos -->
        <div class="kipo-decoration decoration-1"></div>
        <div class="kipo-decoration decoration-2"></div>
        
        <!-- Formulario -->
        <div class="form-section">
            <!-- Selector de idioma -->
            <div class="language-selector">
                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMCAyMCI+PHJlY3Qgd2lkdGg9IjMwIiBoZWlnaHQ9IjIwIiBmaWxsPSIjYzYwMDI2Ii8+PHJlY3Qgd2lkdGg9IjEwIiBoZWlnaHQ9IjIwIiBmaWxsPSIjZmZmIi8+PHJlY3QgeD0iMTAiIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgZmlsbD0iI2MwMCIvPjwvc3ZnPg==" alt="Español" class="language-flag active" data-lang="es">
                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMCAyMCI+PHJlY3Qgd2lkdGg9IjMwIiBoZWlnaHQ9IjIwIiBmaWxsPSIjYmQwMDIzIi8+PHBhdGggZD0iTTAgMEgzMFYyMEgwWiIgZmlsbD0iI2JkMDAyMyIvPjxwYXRoIGQ9Ik0wIDBIMzBWNEgwWiIgZmlsbD0iI3doaXRlIi8+PHBhdGggZD0iTTAgOEgzMFYxMkgwWiIgZmlsbD0iI3doaXRlIi8+PHBhdGggZD0iTTAgMTZIMzBWMTZIMFYyMEgwWiIgZmlsbD0iI3doaXRlIi8+PHBhdGggZD0iTTAgNEgzMFY4SDBaIiBmaWxsPSIjMDAyNzY4Ii8+PHBhdGggZD0iTTAgMTJIMzBWMTZIMFYxMloiIGZpbGw9IiMwMDI3NjgiLz48L3N2Zz4=" alt="English" class="language-flag" data-lang="en">
            </div>
            
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-kiwi-bird"></i>
                </div>
                <div class="logo-text">KipoLogin</div>
            </div>
            
            <h1 id="greeting">¡Hola de nuevo!</h1>
            <p id="subtitle">Inicia sesión para continuar tu aventura</p>

            @if ($errors->any())
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="email" placeholder="Correo electrónico" required>
                    <i class="fas fa-check validation-icon"></i>
                </div>
                
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="Contraseña" required>
                    <i class="fas fa-check validation-icon"></i>
                </div>
                
                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember"> <span id="remember-text">Recordarme</span>
                    </label>
                    <a href="#" class="forgot-password" id="forgot-password">¿Olvidaste tu contraseña?</a>
                </div>
                
                <button type="submit" id="login-button">Iniciar sesión</button>
            </form>
            
            <div class="register-link">
                <span id="no-account">¿No tienes una cuenta?</span> <a href="#" id="register-link">Regístrate aquí</a>
            </div>
        </div>

        <!-- Ilustración -->
        <div class="illustration-section">
            <div class="illustration-content">
                <div class="kipo-frame">
                    <img src="{{ asset('img/kipo.jpeg') }}" alt="Kipo el pollito">
                </div>
                <h2 id="welcome-text">¡Bienvenido!</h2>
                <p id="kipo-ready">Kipo está listo para acompañarte</p>
            </div>
        </div>
    </div>

    <script>
        // Crear burbujas de fondo
        function createBubbles() {
            const bubblesContainer = document.getElementById('bubbles');
            const bubbleCount = 20;
            
            for (let i = 0; i < bubbleCount; i++) {
                const bubble = document.createElement('div');
                bubble.classList.add('bubble');
                
                // Tamaño aleatorio
                const size = Math.random() * 60 + 20;
                bubble.style.width = `${size}px`;
                bubble.style.height = `${size}px`;
                
                // Posición inicial aleatoria
                bubble.style.left = `${Math.random() * 100}%`;
                bubble.style.top = `${Math.random() * 100 + 100}%`;
                
                // Duración de animación aleatoria
                const duration = Math.random() * 20 + 10;
                bubble.style.animationDuration = `${duration}s`;
                
                // Retraso aleatorio
                const delay = Math.random() * 5;
                bubble.style.animationDelay = `${delay}s`;
                
                // Color basado en la paleta de Kipo
                const colors = ['rgba(255, 209, 102, 0.3)', 'rgba(255, 158, 109, 0.3)', 'rgba(6, 214, 160, 0.3)'];
                bubble.style.background = colors[Math.floor(Math.random() * colors.length)];
                
                bubblesContainer.appendChild(bubble);
            }
        }
        
        // Validación en tiempo real
        function setupValidation() {
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            
            emailInput.addEventListener('input', function() {
                validateEmail(this);
            });
            
            passwordInput.addEventListener('input', function() {
                validatePassword(this);
            });
            
            // Validar formulario al enviar
            document.getElementById('loginForm').addEventListener('submit', function(e) {
                if (!validateEmail(emailInput) || !validatePassword(passwordInput)) {
                    e.preventDefault();
                    // Aquí podrías mostrar un mensaje de error más específico
                }
            });
        }
        
        function validateEmail(input) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const isValid = emailRegex.test(input.value);
            
            if (isValid) {
                input.parentElement.classList.add('valid');
                input.parentElement.classList.remove('invalid');
            } else if (input.value.length > 0) {
                input.parentElement.classList.add('invalid');
                input.parentElement.classList.remove('valid');
            } else {
                input.parentElement.classList.remove('valid', 'invalid');
            }
            
            return isValid;
        }
        
        function validatePassword(input) {
            const isValid = input.value.length >= 6;
            
            if (isValid) {
                input.parentElement.classList.add('valid');
                input.parentElement.classList.remove('invalid');
            } else if (input.value.length > 0) {
                input.parentElement.classList.add('invalid');
                input.parentElement.classList.remove('valid');
            } else {
                input.parentElement.classList.remove('valid', 'invalid');
            }
            
            return isValid;
        }
        
        // Configuración del selector de idioma
        function setupLanguageSelector() {
            const flags = document.querySelectorAll('.language-flag');
            const currentLang = 'es'; // Idioma por defecto
            
            // Textos en diferentes idiomas
            const translations = {
                es: {
                    greeting: "¡Hola de nuevo!",
                    subtitle: "Inicia sesión para continuar tu aventura",
                    emailPlaceholder: "Correo electrónico",
                    passwordPlaceholder: "Contraseña",
                    rememberText: "Recordarme",
                    forgotPassword: "¿Olvidaste tu contraseña?",
                    loginButton: "Iniciar sesión",
                    noAccount: "¿No tienes una cuenta?",
                    registerLink: "Regístrate aquí",
                    welcomeText: "¡Bienvenido!",
                    kipoReady: "Kipo está listo para acompañarte"
                },
                en: {
                    greeting: "Hello again!",
                    subtitle: "Sign in to continue your adventure",
                    emailPlaceholder: "Email address",
                    passwordPlaceholder: "Password",
                    rememberText: "Remember me",
                    forgotPassword: "Forgot your password?",
                    loginButton: "Sign in",
                    noAccount: "Don't have an account?",
                    registerLink: "Register here",
                    welcomeText: "Welcome!",
                    kipoReady: "Kipo is ready to accompany you"
                }
            };
            
            // Función para cambiar el idioma
            function changeLanguage(lang) {
                // Actualizar textos
                document.getElementById('greeting').textContent = translations[lang].greeting;
                document.getElementById('subtitle').textContent = translations[lang].subtitle;
                document.getElementById('email').placeholder = translations[lang].emailPlaceholder;
                document.getElementById('password').placeholder = translations[lang].passwordPlaceholder;
                document.getElementById('remember-text').textContent = translations[lang].rememberText;
                document.getElementById('forgot-password').textContent = translations[lang].forgotPassword;
                document.getElementById('login-button').textContent = translations[lang].loginButton;
                document.getElementById('no-account').textContent = translations[lang].noAccount;
                document.getElementById('register-link').textContent = translations[lang].registerLink;
                document.getElementById('welcome-text').textContent = translations[lang].welcomeText;
                document.getElementById('kipo-ready').textContent = translations[lang].kipoReady;
                
                // Actualizar estado activo de las banderas
                flags.forEach(flag => {
                    if (flag.dataset.lang === lang) {
                        flag.classList.add('active');
                    } else {
                        flag.classList.remove('active');
                    }
                });
            }
            
            // Añadir eventos a las banderas
            flags.forEach(flag => {
                flag.addEventListener('click', function() {
                    const lang = this.dataset.lang;
                    changeLanguage(lang);
                });
            });
            
            // Inicializar con el idioma por defecto
            changeLanguage(currentLang);
        }
        
        // Inicializar cuando el DOM esté listo
        document.addEventListener('DOMContentLoaded', function() {
            createBubbles();
            setupValidation();
            setupLanguageSelector();
        });
    </script>
    
</body>
</html>