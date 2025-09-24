<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a KipoLogin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Variables CSS inspiradas en Kipo */
        :root {
            --kipo-yellow: #FFD166;
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
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
            position: relative;
        }

        /* Video de fondo que ocupa toda la pantalla */
        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .video-background video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Capa oscura sobre el video */
        .video-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(228, 228, 228, 0.767);
            z-index: 0;
        }

        /* Contenedor de contenido */
        .content-container {
            position: relative;
            z-index: 1;
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: rgb(0, 0, 0);
            padding: 20px;
        }

        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .logo-icon {
            width: 70px;
            height: 70px;
            background: var(--kipo-yellow);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            color: var(--kipo-dark);
            font-size: 2rem;
            box-shadow: 0 10px 25px rgba(255, 209, 102, 0.5);
        }

        .logo-text {
            font-size: 3rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--kipo-yellow), var(--kipo-orange));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .content-container h2 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            font-weight: 700;
            text-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .content-container p {
            font-size: 1.5rem;
            margin-bottom: 40px;
            opacity: 0.9;
            max-width: 600px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .skip-btn {
            padding: 15px 40px;
            background: var(--kipo-yellow);
            border: none;
            border-radius: 50px;
            color: var(--kipo-dark);
            font-weight: 700;
            font-size: 1.2rem;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 8px 25px rgba(255, 209, 102, 0.5);
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
            transition: opacity 0.8s ease, visibility 0.8s ease, transform 0.8s ease;
        }

        .skip-btn.visible {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .skip-btn:hover {
            background: white;
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 12px 30px rgba(255, 209, 102, 0.7);
        }

        .skip-btn i {
            margin-left: 10px;
        }

        /* Efectos de burbujas de fondo */
        .bubbles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .bubble {
            position: absolute;
            background: rgba(255, 255, 255, 0.2);
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

        /* Indicador de carga */
        .loading-text {
            position: absolute;
            bottom: 30px;
            color: white;
            opacity: 0.7;
            font-size: 1rem;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .content-container h2 {
                font-size: 2.5rem;
            }
            
            .content-container p {
                font-size: 1.2rem;
            }
            
            .logo-text {
                font-size: 2.2rem;
            }
            
            .logo-icon {
                width: 50px;
                height: 50px;
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .content-container h2 {
                font-size: 2rem;
            }
            
            .content-container p {
                font-size: 1rem;
                padding: 0 20px;
            }
            
            .logo-text {
                font-size: 1.8rem;
            }
            
            .skip-btn {
                padding: 12px 30px;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Video de fondo -->
    <div class="video-background">
        <video id="introVideo" autoplay muted loop>
            <source src="{{ asset('img/kiipo.mp4') }}" type="video/mp4">
            Tu navegador no soporta el elemento de video.
        </video>
    </div>
    
    <!-- Capa oscura sobre el video -->
    <div class="video-overlay"></div>
    
    <!-- Burbujas de fondo -->
    <div class="bubbles" id="bubbles"></div>

    <!-- Contenido principal -->
    <div class="content-container">
        <div class="logo">
            <div class="logo-icon">
                <i class="fas fa-kiwi-bird"></i>
            </div>
            <div class="logo-text">KipoLogin</div>
        </div>
        
        <h2>¡Bienvenido a KipoLogin!</h2>
        <p>Disfruta de una experiencia única con nuestro amigable pollito Kipo</p>
        
        <button class="skip-btn" id="skipBtn" onclick="redirectToLogin()">
            Continuar <i class="fas fa-forward"></i>
        </button>
        
        <div class="loading-text" id="loadingText">
            El video se reproducirá en breve...
        </div>
    </div>

    <script>
        // Crear burbujas de fondo
        function createBubbles() {
            const bubblesContainer = document.getElementById('bubbles');
            const bubbleCount = 25;
            
            for (let i = 0; i < bubbleCount; i++) {
                const bubble = document.createElement('div');
                bubble.classList.add('bubble');
                
                // Tamaño aleatorio
                const size = Math.random() * 80 + 30;
                bubble.style.width = `${size}px`;
                bubble.style.height = `${size}px`;
                
                // Posición inicial aleatoria
                bubble.style.left = `${Math.random() * 100}%`;
                bubble.style.top = `${Math.random() * 100 + 100}%`;
                
                // Duración de animación aleatoria
                const duration = Math.random() * 25 + 15;
                bubble.style.animationDuration = `${duration}s`;
                
                // Retraso aleatorio
                const delay = Math.random() * 10;
                bubble.style.animationDelay = `${delay}s`;
                
                // Color basado en la paleta de Kipo
                const colors = [
                    'rgba(255, 209, 102, 0.3)', 
                    'rgba(255, 158, 109, 0.3)', 
                    'rgba(6, 214, 160, 0.3)',
                    'rgba(17, 138, 178, 0.3)'
                ];
                bubble.style.background = colors[Math.floor(Math.random() * colors.length)];
                
                bubblesContainer.appendChild(bubble);
            }
        }
        
        // Control del video introductorio
        function setupVideoIntro() {
            const skipBtn = document.getElementById('skipBtn');
            const loadingText = document.getElementById('loadingText');
            const video = document.getElementById('introVideo');
            
            // Verificar si el video se está cargando
            video.addEventListener('loadeddata', function() {
                loadingText.textContent = "Video cargado correctamente";
                setTimeout(() => {
                    loadingText.style.opacity = '0';
                }, 2000);
            });
            
            video.addEventListener('error', function() {
                loadingText.textContent = "Error al cargar el video. Redirigiendo...";
                setTimeout(redirectToLogin, 2000);
            });
            
            // Mostrar el botón después de 7 segundos
            setTimeout(() => {
                skipBtn.classList.add('visible');
                loadingText.textContent = "Presiona Continuar para comenzar";
            }, 7000);
            
            // Redirigir al login después de que termine el video (si no está en loop)
            video.addEventListener('ended', function() {
                if (!video.loop) {
                    redirectToLogin();
                }
            });
            
            // Permitir saltar el video
            skipBtn.addEventListener('click', function() {
                video.pause();
                redirectToLogin();
            });
            
            // Redirigir automáticamente después de 30 segundos como respaldo
            setTimeout(() => {
                if (skipBtn.style.visibility !== 'hidden') {
                    redirectToLogin();
                }
            }, 30000);
        }
        
        // En login.blade.php - cambia la función redirectToLogin()
        function redirectToLogin() {
    // Agregar efecto de desvanecimiento
    document.body.style.transition = 'opacity 0.8s ease';
    document.body.style.opacity = '0';
    
    setTimeout(() => {
        window.location.href = "{{ route('inicio.principal') }}";
    }, 800);
}
        
        // Efecto de escritura para el texto de carga
        function typeWriterEffect() {
            const text = "Cargando experiencia Kipo...";
            const loadingText = document.getElementById('loadingText');
            let i = 0;
            
            function type() {
                if (i < text.length) {
                    loadingText.textContent += text.charAt(i);
                    i++;
                    setTimeout(type, 100);
                }
            }
            
            // Comenzar después de un breve retraso
            setTimeout(type, 1000);
        }
        
        // Inicializar cuando el DOM esté listo
        document.addEventListener('DOMContentLoaded', function() {
            createBubbles();
            setupVideoIntro();
            typeWriterEffect();
            
            // Efecto de entrada para el contenido
            setTimeout(() => {
                document.querySelector('.content-container').style.opacity = '1';
                document.querySelector('.content-container').style.transform = 'translateY(0)';
            }, 500);
        });
        
        // Estilos iniciales para animación de entrada
        document.querySelector('.content-container').style.opacity = '0';
        document.querySelector('.content-container').style.transform = 'translateY(20px)';
        document.querySelector('.content-container').style.transition = 'opacity 1s ease, transform 1s ease';
    </script>
</body>
</html>