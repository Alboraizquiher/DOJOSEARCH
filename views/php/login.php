<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: ' . ($_SESSION['user']['is_admin'] ? 'userAdmin.php' : 'userUser.php'));
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DojoSearch - Acceso al Dojo</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:wght@300;400;500;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="icon" type="image/png" href="../assets/images/logoDS.png">
</head>

<body>
    <div id="navbar">
        <div class="logo-container">
            <a href="../php/index.php" class="logo-link">
                <img src="../assets/images/logoDS.png" alt="Logo" class="logo" />
                <h2>DojoSearch</h2>
            </a>
        </div>

        <input type="checkbox" id="menu-toggle" class="menu-toggle" />
        <label for="menu-toggle" class="menu-toggle-label">&#9776;</label>

        <nav class="nav-menu">
            <a href="../php/events.php">EVENTOS</a>
            <a href="<?php echo isset($_SESSION['user']) ? ($_SESSION['user']['is_admin'] ? 'userAdmin.php' : 'userUser.php') : 'login.php'; ?>">PERFIL</a>
        </nav>
    </div>

    <!-- Hero Section Mejorada -->
    <section class="login-hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title">Bienvenido, Guerrero</h1>
                <p class="hero-subtitle">Accede a tu dojo personal y comienza tu entrenamiento</p>
                <div class="hero-divider"></div>
            </div>
        </div>
    </section>

    <section class="login-container">
        <div class="login-card">
            <div class="card-header">
                <h3>Acceso al Dojo</h3>
                <div class="divider-small"></div>
            </div>

            <form action="/DojoSearch/controllers/UserController.php" method="POST" class="martial-form">
                <input type="hidden" name="action" value="login"> <!-- Campo añadido -->
                <div class="form-group">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <div class="input-container">
                        <svg class="input-icon" viewBox="0 0 24 24">
                            <path
                                d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V8l8 5 8-5v10zm-8-7L4 6h16l-8 5z" />
                        </svg>
                        <input type="email" id="email" name="email" placeholder="tu@email.com" required
                            class="form-input">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Contraseña</label>
                    <div class="input-container">
                        <svg class="input-icon" viewBox="0 0 24 24">
                            <path
                                d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z" />
                        </svg>
                        <input type="password" id="password" name="password" placeholder="••••••••" required
                            class="form-input">
                        <button type="button" class="toggle-password" aria-label="Mostrar contraseña">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span class="checkmark"></span>
                        Recordar sesión
                    </label>
                    <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
                </div>

                <button type="submit" name="login" class="martial-btn primary">
                    <span>Acceder al Dojo</span>
                    <svg class="btn-icon" viewBox="0 0 24 24">
                        <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z" />
                    </svg>
                </button>
            </form>

            <div class="auth-divider">
                <span>O</span>
            </div>

            <div class="social-login">
                <p>Accede con tus redes sociales</p>
                <div class="social-buttons">
                    <button type="button" class="social-btn google">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M12.545 10.239v3.821h5.445c-0.712 2.315-2.647 3.972-5.445 3.972-3.332 0-6.033-2.701-6.033-6.032s2.701-6.032 6.033-6.032c1.498 0 2.866 0.549 3.921 1.453l2.814-2.814c-1.786-1.667-4.166-2.698-6.735-2.698-5.522 0-10 4.477-10 10s4.478 10 10 10c8.396 0 10-7.524 10-10 0-0.67-0.065-1.34-0.182-2h-9.818z" />
                        </svg>
                        Google
                    </button>
                    <button type="button" class="social-btn facebook">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M22.675 0h-21.35c-0.732 0-1.325 0.593-1.325 1.325v21.351c0 0.731 0.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463 0.099 2.795 0.143v3.24l-1.918 0.001c-1.504 0-1.795 0.715-1.795 1.763v2.313h3.587l-0.467 3.622h-3.12v9.293h6.116c0.73 0 1.323-0.593 1.323-1.325v-21.35c0-0.732-0.593-1.325-1.325-1.325z" />
                        </svg>
                        Facebook
                    </button>
                </div>
            </div>

            <div class="register-link">
                ¿No tienes cuenta? <a href="../php/register.php">Únete al Dojo</a>
            </div>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="martial-footer">
        <div class="footer-container">
            <div class="footer-grid">
                <div class="footer-column">
                    <div class="footer-brand">
                        <img src="../assets/images/logoDS.png" alt="DojoSearch Logo" class="footer-logo">
                        <h3 class="footer-title">DojoSearch</h3>
                    </div>
                    <div class="social-links">
                        <a href="#" class="social-icon" aria-label="Instagram">
                            <img src="../assets/images/social-media/instagram.png" alt="Instagram">
                        </a>
                        <a href="#" class="social-icon" aria-label="Facebook">
                            <img src="../assets/images/social-media/facebook.png" alt="Facebook">
                        </a>
                        <a href="#" class="social-icon" aria-label="YouTube">
                            <img src="../assets/images/social-media/youtube.png" alt="YouTube">
                        </a>
                        <a href="#" class="social-icon" aria-label="LinkedIn">
                            <img src="../assets/images/social-media/linkedin.png" alt="LinkedIn">
                        </a>
                    </div>
                    <div class="newsletter">
                        <h4>Recibe novedades</h4>
                        <form class="newsletter-form">
                            <input type="email" placeholder="Tu mejor email" required>
                            <button type="submit">Enviar</button>
                        </form>
                    </div>
                </div>

                <div class="footer-column">
                    <h4 class="footer-heading">Explora</h4>
                    <ul class="footer-links">
                        <li><a href="../php/events.php">Eventos</a></li>
                        <li><a href="../php/login.php">Mi Perfil</a></li>
                        <li><a href="#">Galería</a></li>
                        <li><a href="#">Blog Marcial</a></li>
                        <li><a href="#">Tienda</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h4 class="footer-heading">Contacto</h4>
                    <ul class="contact-info">
                        <li>
                            <img src="../assets/images/icons/pin.png" alt="Ubicación">
                            <span>500 Terry Francine St<br>San Francisco, CA 94158</span>
                        </li>
                        <li>
                            <img src="../assets/images/icons/phone.png" alt="Teléfono">
                            <span>123-456-7890</span>
                        </li>
                        <li>
                            <img src="../assets/images/icons/email.png" alt="Email">
                            <span>info@dojosearch.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-divider"></div>

            <div class="footer-bottom">
                <div class="legal-links">
                    <a href="#">Accesibilidad</a>
                    <a href="#">Términos y condiciones</a>
                    <a href="#">Política de privacidad</a>
                </div>
                <p class="copyright">&copy; 2023 DojoSearch. Todos los derechos reservados</p>
            </div>
        </div>
    </footer>

    <script>
        // Mostrar/ocultar contraseña
        document.querySelector('.toggle-password').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('svg');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.innerHTML = '<path d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.26 2.7-2.89 3.43-4.75-1.73-4.39-6-7.5-11-7.5-1.4 0-2.74.25-3.98.7l2.16 2.16C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28.46.46C3.08 8.3 1.78 10.02 1 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3 .22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53-2.76 0-5-2.24-5-5 0-.79.2-1.53.53-2.2zm4.31-.78l3.15 3.15.02-.16c0-1.66-1.34-3-3-3l-.17.01z"/>';
            } else {
                passwordInput.type = 'password';
                icon.innerHTML = '<path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>';
            }
        });

        // Efecto navbar al hacer scroll
        var prevScrollpos = window.pageYOffset;
        window.onscroll = function() {
            var currentScrollPos = window.pageYOffset;
            if (prevScrollpos > currentScrollPos) {
                document.getElementById("navbar").style.top = "0";
            } else {
                document.getElementById("navbar").style.top = "-80px";
            }
            prevScrollpos = currentScrollPos;
        }
    </script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>