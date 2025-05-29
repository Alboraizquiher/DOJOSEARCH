<?php
session_start();
if (isset($_SESSION['error'])) {
    echo '<p style="color: red;">' . $_SESSION['error'] . '</p>';
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo '<p style="color: green;">' . $_SESSION['success'] . '</p>';
    unset($_SESSION['success']);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DojoSearch - Unirse al Dojo</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:wght@300;400;500;700&display=swap">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/register.css">
    <link rel="icon" type="image/png" href="../assets/images/logoDS.png">
</head>

<body>
    <div id="navbar">
        <div class="logo-container">
            <a href="../html/index.php" class="logo-link">
                <img src="../assets/images/logoDS.png" alt="Logo" class="logo" />
                <h2>DojoSearch</h2>
            </a>
        </div>

        <input type="checkbox" id="menu-toggle" class="menu-toggle" />
        <label for="menu-toggle" class="menu-toggle-label">&#9776;</label>

        <nav class="nav-menu">
            <a href="../html/events.php">EVENTOS</a>
            <a href="<?php echo isset($_SESSION['user']) ? ($_SESSION['user']['is_admin'] ? 'userAdmin.php' : 'userUser.php') : 'login.php'; ?>">PERFIL</a>
        </nav>
    </div>

    <section class="register-hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title">Únete al Dojo</h1>
                <p class="hero-subtitle">Comienza tu viaje marcial con nosotros</p>
                <div class="hero-divider"></div>
            </div>
        </div>
    </section>

    <section class="register-container">
        <div class="register-card">
            <div class="card-header">
                <h3>Crear Cuenta</h3>
                <div class="divider-small"></div>
                <p class="card-subtitle">Regístrate para acceder a todos los beneficios del dojo</p>
            </div>

            <form action="/DojoSearch/controllers/UserController.php" method="POST" class="martial-form" id="registerForm">
                <div class="form-row">
                    <div class="form-group">
                        <label for="name" class="form-label">Nombre Completo</label>
                        <div class="input-container">
                            <svg class="input-icon" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                            </svg>
                            <input type="text" id="name" name="name" placeholder="Tu nombre completo" required class="form-input">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="username" class="form-label">Nombre de Usuario</label>
                        <div class="input-container">
                            <svg class="input-icon" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z" />
                            </svg>
                            <input type="text" id="username" name="username" placeholder="Nombre de usuario" required class="form-input">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <div class="input-container">
                            <svg class="input-icon" viewBox="0 0 24 24">
                                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V8l8 5 8-5v10zm-8-7L4 6h16l-8 5z" />
                            </svg>
                            <input type="email" id="email" name="email" placeholder="tu@email.com" required class="form-input">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fecha_born" class="form-label">Fecha de Nacimiento</label>
                        <div class="input-container">
                            <svg class="input-icon" viewBox="0 0 24 24">
                                <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V9h14v10zM5 7V5h14v2H5zm2 4h10v2H7zm0 4h7v2H7z" />
                            </svg>
                            <input type="date" id="fecha_born" name="fecha_born" required class="form-input">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-container">
                            <svg class="input-icon" viewBox="0 0 24 24">
                                <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z" />
                            </svg>
                            <input type="password" id="password" name="password" placeholder="••••••••" required class="form-input">
                            <button type="button" class="toggle-password" aria-label="Mostrar contraseña">
                                <svg viewBox="0 0 24 24">
                                    <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
                                </svg>
                            </button>
                        </div>
                        <div class="password-strength">
                            <div class="strength-meter">
                                <span class="strength-bar"></span>
                                <span class="strength-bar"></span>
                                <span class="strength-bar"></span>
                                <span class="strength-bar"></span>
                            </div>
                            <span class="strength-text">Seguridad: <span id="strengthLabel">Débil</span></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
                        <div class="input-container">
                            <svg class="input-icon" viewBox="0 0 24 24" style="top: 27%;">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                            </svg>
                            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="••••••••" required class="form-input">
                        </div>
                    </div>
                </div>

                <div class="form-group terms-group">
                    <label class="terms-label">
                        <input type="checkbox" name="terms" id="terms" required>
                        <span class="checkmark"></span>
                        Acepto los <a href="#" class="terms-link">Términos y Condiciones</a> y la <a href="#" class="terms-link">Política de Privacidad</a>
                    </label>
                </div>

                <button type="submit" name="register" class="martial-btn primary">
                    <span>Completar Registro</span>
                    <svg class="btn-icon" viewBox="0 0 24 24">
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                    </svg>
                </button>

                <div class="login-link">
                    ¿Ya tienes cuenta? <a href="../html/login.php">Accede aquí</a>
                </div>
            </form>
        </div>
    </section>

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
                        <li><a href="../html/events.php">Eventos</a></li>
                        <li><a href="../html/login.php">Mi Perfil</a></li>
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

        // Validación de fortaleza de contraseña
        const passwordInput = document.getElementById('password');
        const strengthBars = document.querySelectorAll('.strength-bar');
        const strengthLabel = document.getElementById('strengthLabel');

        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;

            if (password.length >= 8) strength++;
            if (/\d/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            strengthBars.forEach((bar, index) => {
                bar.style.backgroundColor = index < strength ? getStrengthColor(strength) : '#333';
            });

            const strengthText = document.getElementById('strengthText');
            const strengthTexts = ['Débil', 'Moderada', 'Fuerte', 'Muy Fuerte'];
            strengthLabel.textContent = strengthTexts[strength - 1] || 'Débil';
            strengthLabel.style.color = getStrengthColor(strength);
        });

        function getStrengthColor(strength) {
            const colors = ['#ff4d4d', '#ffa4d4d', '#66cc66', '#4dff4d'];
            return colors[strength - 1] || '#ff4d4d';
        }

        // Validación de confirmación de contraseña
        const confirmPasswordInput = document.getElementById('confirmPassword');
        const registerForm = document.getElementById('registerForm');

        registerForm.addEventListener('submit', function(e) {
            if (passwordInput.value !== confirmPasswordInput.value) {
                e.preventDefault();
                confirmPasswordInput.style.borderColor = '#ff4d4d';
                alert('Las contraseñas no coinciden');
            }

            if (!document.getElementById('terms').checked) {
                e.preventDefault();
                alert('Error: Debes aceptar los términos y condiciones');
            }
        });

        confirmPasswordInput.addEventListener('input', function() {
            if (this.value === passwordInput.value) {
                this.style.borderColor = '#333';
            } else {
                this.style.borderColor = '#ff4d4d';
            }
        });

        // Efecto Navbar
        var prevScrollPos = window.pageYOffset;
        window.onscroll = function() {
            var currentScrollPos = window.pageYOffset;
            if (prevScrollPos > currentScrollPos) {
                document.getElementById("navbar").style.top = "0";
            } else {
                document.getElementById("navbar").style.top = "-80px";
            }
            prevScrollPos = currentScrollPos;
        }
    </script>
</body>

</html>