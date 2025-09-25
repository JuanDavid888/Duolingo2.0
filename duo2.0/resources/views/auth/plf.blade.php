<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duolingo - Réplica</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
            color: white;
            min-height: 100vh;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            background: rgba(31, 41, 55, 0.8);
            padding: 20px 0;
            backdrop-filter: blur(10px);
            border-right: 1px solid rgba(55, 65, 81, 0.3);
        }

        .logo {
            padding: 0 20px 30px 20px;
            font-size: 32px;
            font-weight: bold;
            color: #58cc02;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            margin: 2px 0;
            cursor: pointer;
            transition: all 0.3s ease;
            border-radius: 0 25px 25px 0;
            margin-right: 20px;
        }

        .nav-item:hover {
            background: rgba(88, 204, 2, 0.1);
        }

        .nav-item.active {
            background: rgba(88, 204, 2, 0.2);
            border-left: 4px solid #58cc02;
        }

        .nav-icon {
            width: 24px;
            height: 24px;
            margin-right: 15px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .nav-text {
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Main content */
        .main-content {
            flex: 1;
            display: flex;
        }

        .lesson-area {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 40px;
            background: rgba(59, 130, 246, 0.9);
            padding: 15px 25px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        .back-arrow {
            color: white;
            font-size: 20px;
            margin-right: 15px;
        }

        .lesson-title {
            font-size: 18px;
            font-weight: bold;
        }

        .lesson-subtitle {
            font-size: 24px;
            font-weight: bold;
            margin-top: 5px;
        }

        .guide-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            margin-left: auto;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Lesson path */
        .lesson-path {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
            position: relative;
        }

        .lesson-node {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }

        .lesson-node.completed {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
        }

        .lesson-node.current {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            box-shadow: 0 8px 25px rgba(251, 191, 36, 0.4);
            animation: pulse 2s infinite;
        }

        .lesson-node.locked {
            background: rgba(107, 114, 128, 0.6);
            cursor: not-allowed;
        }

        .lesson-node::after {
            content: '';
            position: absolute;
            bottom: -30px;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 30px;
            background: linear-gradient(to bottom, rgba(59, 130, 246, 0.6), transparent);
            z-index: 1;
        }

        .lesson-node:last-child::after {
            display: none;
        }

        .lesson-icon {
            font-size: 24px;
            color: white;
        }

        .treasure-chest {
            width: 100px;
            height: 80px;
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(251, 191, 36, 0.4);
            margin: 20px 0;
        }

        .final-node {
            width: 100px;
            height: 80px;
            background: linear-gradient(135deg, #06b6d4, #0891b2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(6, 182, 212, 0.4);
        }

        /* Character */
        .character {
            position: absolute;
            right: 200px;
            top: 300px;
            width: 150px;
            height: 150px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="30" r="15" fill="%23654321"/><circle cx="50" cy="50" r="20" fill="%23ffa500"/><circle cx="45" cy="27" r="2" fill="white"/><circle cx="55" cy="27" r="2" fill="white"/><path d="M45 35 Q50 40 55 35" stroke="white" stroke-width="2" fill="none"/></svg>') no-repeat center;
            background-size: contain;
        }

        /* Right sidebar */
        .right-sidebar {
            width: 320px;
            padding: 20px;
            background: rgba(31, 41, 55, 0.6);
            backdrop-filter: blur(10px);
            border-left: 1px solid rgba(55, 65, 81, 0.3);
        }

        .stats {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .stat-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
        }

        .flame { background: #ff4444; }
        .gem { background: #44aaff; }
        .heart { background: #ff6b6b; }

        .super-offer {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            text-align: center;
        }

        .super-badge {
            background: linear-gradient(45deg, #fbbf24, #f59e0b);
            color: white;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 10px;
        }

        .offer-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .offer-description {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .try-btn {
            background: #3b82f6;
            border: none;
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .see-all {
            color: #3b82f6;
            font-size: 14px;
            text-decoration: none;
            text-transform: uppercase;
            font-weight: 600;
        }

        .achievement {
            background: rgba(55, 65, 81, 0.5);
            border-radius: 12px;
            padding: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .achievement-icon {
            width: 40px;
            height: 40px;
            background: #374151;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .achievement-content h4 {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .achievement-content p {
            font-size: 14px;
            opacity: 0.7;
            line-height: 1.3;
        }

        .challenge {
            background: rgba(55, 65, 81, 0.5);
            border-radius: 12px;
            padding: 15px;
        }

        .challenge-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .challenge-icon {
            color: #fbbf24;
            font-size: 20px;
        }

        .challenge-title {
            font-size: 16px;
            font-weight: bold;
        }

        .progress-bar {
            background: rgba(107, 114, 128, 0.5);
            height: 8px;
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 8px;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #fbbf24, #f59e0b);
            width: 0%;
            transition: width 0.5s ease;
        }

        .progress-text {
            font-size: 14px;
            opacity: 0.7;
            display: flex;
            justify-content: space-between;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .hover-effect:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">🐣Piko</div>
            <div class="nav-item active">
                <div class="nav-icon" style="background: #58cc02;">🏠</div>
                <div class="nav-text">Aprender</div>
            </div>
            <div class="nav-item">
                <div class="nav-icon" style="background: #1cb0f6;">💪</div>
                <div class="nav-text">Practicar</div>
            </div>
            <div class="nav-item">
                <div class="nav-icon" style="background: #ff9600;">🎯</div>
                <div class="nav-text">Desafíos</div>
            </div>
            <div class="nav-item">
                <div class="nav-icon" style="background: #ff4b4b;">🏪</div>
                <div class="nav-text">Tienda</div>
            </div>
            <div class="nav-item">
                <div class="nav-icon" style="background: #ce82ff;">👤</div>
                <div class="nav-text">Perfil</div>
            </div>
        </div>

        <!-- Main content -->
        <div class="main-content">
            <div class="lesson-area">
                <div class="header">
                    <span class="back-arrow">←</span>
                    <div>
                        <div class="lesson-title">ETAPA 2, SECCIÓN 1</div>
                        <div class="lesson-subtitle">Saluda y despídete</div>
                    </div>
                    <button class="guide-btn">
                        📖 GUÍA
                    </button>
                </div>

                <div class="lesson-path">
                    <div class="lesson-node completed hover-effect">
                        <div class="lesson-icon">✓</div>
                    </div>
                    <div class="lesson-node completed hover-effect">
                        <div class="lesson-icon">📖</div>
                    </div>
                    <div class="lesson-node current hover-effect">
                        <div class="lesson-icon">✓</div>
                    </div>
                    <div class="lesson-node completed hover-effect">
                        <div class="lesson-icon">✓</div>
                    </div>
                    <div class="treasure-chest hover-effect">
                        <span>📦</span>
                    </div>
                    <div class="lesson-node completed hover-effect">
                        <div class="lesson-icon">✓</div>
                    </div>
                    <div class="final-node hover-effect">
                        <span>1</span>
                    </div>
                </div>

                <div class="character"></div>
            </div>

            <!-- Right sidebar -->
            <div class="right-sidebar">
                <div class="stats">
                    <div class="stat-item">
                        <div class="stat-icon flame">🔥</div>
                        <span style="font-weight: bold;">0</span>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon gem">💎</div>
                        <span style="color: #44aaff; font-weight: bold;">214</span>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon heart">❤️</div>
                        <span style="color: #ff6b6b; font-weight: bold;">5</span>
                    </div>
                </div>

                <div class="super-offer">
                    <div class="super-badge">SUPER</div>
                    <div class="offer-title">Prueba Super gratis</div>
                    <div class="offer-description">
                        Sin anuncios, con prácticas personalizadas y sin límites para el nivel Legendario.
                    </div>
                    <button class="try-btn">Probar 2 semanas gratis</button>
                </div>

                <div class="section">
                    <div class="section-title">
                        LIGAS
                        <a href="#" class="see-all">Ingresar a las ligas</a>
                    </div>
                    <div class="achievement">
                        <div class="achievement-icon">🥈</div>
                        <div class="achievement-content">
                            <h4>¡Bien hecho!</h4>
                            <p>Quedaste en el puesto #14 y mantuviste tu posición en la División Plata</p>
                        </div>
                    </div>
                </div>

                <div class="section">
                    <div class="section-title">
                        Desafíos del día
                        <a href="#" class="see-all">Ver todos</a>
                    </div>
                    <div class="challenge">
                        <div class="challenge-header">
                            <span class="challenge-icon">⚡</span>
                            <span class="challenge-title">Gana 10 EXP</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 0%;"></div>
                        </div>
                        <div class="progress-text">
                            <span>0 / 10</span>
                            <span>🏆</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add hover effects and animations
        document.addEventListener('DOMContentLoaded', function() {
            // Animate progress bar on load
            setTimeout(() => {
                const progressBar = document.querySelector('.progress-fill');
                if (progressBar) {
                    progressBar.style.width = '0%';
                }
            }, 500);

            // Add click effects to lesson nodes
            document.querySelectorAll('.lesson-node, .treasure-chest, .final-node').forEach(node => {
                node.addEventListener('click', function() {
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                });
            });

            // Add nav item click effects
            document.querySelectorAll('.nav-item').forEach(item => {
                item.addEventListener('click', function() {
                    document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
</body>
</html>