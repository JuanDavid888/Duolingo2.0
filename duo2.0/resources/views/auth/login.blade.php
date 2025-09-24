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
            background: linear-gradient(135deg, var(--kipo-yellow), var(--kipo-orange));
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow: hidden;
            position: relative;
        }

        /* Contenedor de video - Ocupa toda la pantalla */
        .video-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(7, 59, 76, 0.9);
            transition: opacity 1s ease, visibility 1s ease;
        }

        .video-content {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }

        .video-wrapper {
            width: 80%;
            max-width: 800px;
            height: 60%;
            margin-bottom: 20px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .video-wrapper video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .video-content h2 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .video-content p {
            font-size: 1.2rem;
            margin-bottom: 25px;
            opacity: 0.9;
        }

        .skip-btn {
            padding: 12px 30px;
            background: var(--kipo-yellow);
            border: none;
            border-radius: 50px;
            color: var(--kipo-dark);
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 5px 15px rgba(255, 209, 102, 0.4);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s ease, visibility 0.5s ease, transform 0.3s ease;
        }

        .skip-btn.visible {
            opacity: 1;
            visibility: visible;
        }

        .skip-btn:hover {
            background: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 209, 102, 0.6);
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

        /* Responsive */
        @media (max-width: 900px) {
            .video-content h2 {
                font-size: 2rem;
            }
            
            .video-content p {
                font-size: 1rem;
            }
            
            .video-wrapper {
                width: 90%;
                height: 50%;
            }
        }

        @media (max-width: 480px) {
            .video-content h2 {
                font-size: 1.8rem;
            }
            
            .video-wrapper {
                width: 95%;
                height: 40%;
            }
        }
    </style>
</head>
<body>
    <!-- Contenedor de video introductorio -->
    <div class="video-container" id="videoContainer">
        <div class="video-content">
            <div class="video-wrapper">
                <!-- Usa tu video local kilpo.mp4 -->
                <video id="introVideo" autoplay muted>
                    <source src="{{ asset('img/kilpo.mp4') }}" type="video/mp4">
                    Tu navegador no soporta el elemento de video.
                </video>
            </div>
            <h2>¡Bienvenido a KipoLogin!</h2>
            <p>Disfruta de una experiencia única con nuestro amigable pollito Kipo</p>
            <button class="skip-btn" id="skipBtn">Continuar <i class="fas fa-forward"></i></button>
        </div>
    </div>
    
    <!-- Burbujas de fondo -->
    <div class="bubbles" id="bubbles"></div>

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
        
        // Control del video introductorio
        function setupVideoIntro() {
            const videoContainer = document.getElementById('videoContainer');
            const skipBtn = document.getElementById('skipBtn');
            const video = document.getElementById('introVideo');
            
            // Mostrar el botón después de 7 segundos
            setTimeout(() => {
                skipBtn.classList.add('visible');
            }, 7000);
            
            // Ocultar video y redirigir al login después de que termine el video
            video.addEventListener('ended', function() {
                redirectToLogin();
            });
            
            // Permitir saltar el video
            skipBtn.addEventListener('click', function() {
                video.pause();
                redirectToLogin();
            });
            
            // Si el video no se carga, redirigir después de 10 segundos
            setTimeout(() => {
                if (videoContainer.style.visibility !== 'hidden') {
                    redirectToLogin();
                }
            }, 10000); // 10 segundos como respaldo
        }
        
        // Función para redirigir al login
        function redirectToLogin() {
            window.location.href = "{{ route('login') }}";
        }
        
        // Inicializar cuando el DOM esté listo
        document.addEventListener('DOMContentLoaded', function() {
            createBubbles();
            setupVideoIntro();
        });
    </script>
</body>
</html>