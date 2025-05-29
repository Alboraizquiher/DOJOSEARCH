<?php
ini_set('session.gc_maxlifetime', 86400);
session_set_cookie_params([
    'lifetime' => 86400,
    'path' => '/',
    'domain' => '',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Lax'
]);

session_start();
require_once '../../controllers/UserController.php';
UserController::checkSession();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos Marciales | DojoSearch</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/events.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@400;600;700&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/png" href="../assets/images/logoDS.png">
</head>

<body>
    <div id="navbar">
        <div class="logo-container">
            <a href="../html/index.php" class="logo-link">
                <img src="../assets/images/logoDS.png" alt="Logo DojoSearch" class="logo" />
                <h2>DojoSearch</h2>
            </a>
        </div>

        <input type="checkbox" id="menu-toggle" class="menu-toggle" />
        <label for="menu-toggle" class="menu-toggle-label">&#9776;</label>

        <nav class="nav-menu">
            <a href="../html/events.php">EVENTOS</a>
            <?php if (!empty($_SESSION['user']) && is_array($_SESSION['user'])): ?>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="<?php echo !empty($_SESSION['user']['photo']) ? 'data:image/jpeg;base64,' . base64_encode($_SESSION['user']['photo']) : 'https://via.placeholder.com/30?text=Sin+Foto'; ?>" alt="Foto de perfil" class="profile-pic-nav" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 5px;">
                        PERFIL
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="/DojoSearch/views/html/<?php echo $_SESSION['user']['is_admin'] ? 'userAdmin.php' : 'userUser.php'; ?>">Configurar Perfil</a>
                        <a class="dropdown-item" href="/DojoSearch/controllers/UserController.php?action=logout">Cerrar Sesión</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="/DojoSearch/views/html/login.php" class="nav-link">PERFIL</a>
            <?php endif; ?>
        </nav>
    </div>

    <header class="events-hero">
        <div class="events-hero-overlay"></div>
        <div class="events-hero-content">
            <h1 class="events-hero-title">Eventos Marciales</h1>
            <div class="events-hero-divider"></div>
            <p class="events-hero-subtitle">Descubre los mejores torneos y seminarios de artes marciales</p>
        </div>
    </header>

    <section class="events-filter">
        <div class="filter-container">
            <div class="filter-group">
                <label for="discipline"><i class="fas fa-fist-raised"></i> Disciplina</label>
                <select id="discipline" class="filter-select">
                    <option value="all">Todas</option>
                    <option value="karate">Karate</option>
                    <option value="taekwondo">Taekwondo</option>
                    <option value="jiujitsu">Jiu-Jitsu</option>
                    <option value="muaythai">Muay Thai</option>
                    <option value="judo">Judo</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="location"><i class="fas fa-map-marker-alt"></i> Ubicación</label>
                <select id="location" class="filter-select">
                    <option value="all">Todas</option>
                    <option value="europe">Europa</option>
                    <option value="asia">Asia</option>
                    <option value="america">América</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="date"><i class="fas fa-calendar-alt"></i> Fecha</label>
                <select id="date" class="filter-select">
                    <option value="all">Próximos eventos</option>
                    <option value="month">Este mes</option>
                    <option value="year">Este año</option>
                </select>
            </div>
            <button class="filter-reset red-button">Limpiar filtros</button>
        </div>
    </section>

    <main class="events-container">
        <div class="events-grid">
            <!-- Evento 1 - Karate -->
            <div class="event-card">
                <div class="event-badge">Karate</div>
                <div class="event-image">
                    <img src="../assets/images/events/event1.jpg" alt="Torneo de Karate 2021">
                    <div class="event-overlay">
                        <button class="event-action red-button">¡Apúntate!</button>
                    </div>
                </div>
                <div class="event-content">
                    <div class="event-header">
                        <h3 class="event-title">Torneo de Karate 2024</h3>
                        <div class="event-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Stade Pierre de Coubertin, París</span>
                        </div>
                    </div>
                    <div class="event-meta">
                        <div class="event-date">
                            <i class="fas fa-calendar-alt"></i>
                            <span>11 JUN 2024</span>
                        </div>
                        <div class="event-price">25€</div>
                    </div>
                    <p class="event-description">
                        El Torneo de Clasificación de Karate 2024 se llevará a cabo en el emblemático Stade Pierre de
                        Coubertin. ¡No te pierdas la oportunidad de presenciar este espectáculo deportivo único!
                    </p>
                    <div class="event-footer">
                        <div class="event-difficulty">
                            <span class="difficulty-label">Nivel:</span>
                            <div class="difficulty-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                        <button class="event-details red-button">Más detalles</button>
                    </div>
                </div>
            </div>

            <!-- Evento 2 - Taekwondo -->
            <div class="event-card">
                <div class="event-badge">Taekwondo</div>
                <div class="event-image">
                    <img src="../assets/images/events/event2.jpg" alt="Liga Nocturna de Taekwondo 2024">
                    <div class="event-overlay">
                        <button class="event-action red-button">¡Apúntate!</button>
                    </div>
                </div>
                <div class="event-content">
                    <div class="event-header">
                        <h3 class="event-title">Liga Nocturna de Taekwondo</h3>
                        <div class="event-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Seoul Olympic Park, Corea del Sur</span>
                        </div>
                    </div>
                    <div class="event-meta">
                        <div class="event-date">
                            <i class="fas fa-calendar-alt"></i>
                            <span>24 AGO 2024</span>
                        </div>
                        <div class="event-price">35€</div>
                    </div>
                    <p class="event-description">
                        Competencia bajo luces ultravioleta con equipos fluorescentes. Incluye exhibición de rompimiento
                        de tablas extremo y categoría especial de formas creativas.
                    </p>
                    <div class="event-footer">
                        <div class="event-difficulty">
                            <span class="difficulty-label">Nivel:</span>
                            <div class="difficulty-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                        <button class="event-details red-button">Más detalles</button>
                    </div>
                </div>
            </div>

            <!-- Evento 3 - Jiu-Jitsu -->
            <div class="event-card">
                <div class="event-badge">Jiu-Jitsu</div>
                <div class="event-image">
                    <img src="../assets/images/events/event3.jpg" alt="Combate Arena de Playa 2024">
                    <div class="event-overlay">
                        <button class="event-action red-button">¡Apúntate!</button>
                    </div>
                </div>
                <div class="event-content">
                    <div class="event-header">
                        <h3 class="event-title">Combate Arena de Playa</h3>
                        <div class="event-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Playa de Copacabana, Río de Janeiro</span>
                        </div>
                    </div>
                    <div class="event-meta">
                        <div class="event-date">
                            <i class="fas fa-calendar-alt"></i>
                            <span>15 SEP 2024</span>
                        </div>
                        <div class="event-price">Gratis</div>
                    </div>
                    <p class="event-description">
                        Torneo open-weight en arena de arena natural. Incluye categoría especial de submission relámpago
                        y exhibición de luchas históricas.
                    </p>
                    <div class="event-footer">
                        <div class="event-difficulty">
                            <span class="difficulty-label">Nivel:</span>
                            <div class="difficulty-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                        <button class="event-details red-button">Más detalles</button>
                    </div>
                </div>
            </div>

            <!-- Evento 4 - Muay Thai -->
            <div class="event-card">
                <div class="event-badge">Muay Thai</div>
                <div class="event-image">
                    <img src="../assets/images/events/event4.jpg" alt="Gran Prix del Rey Naresuan">
                    <div class="event-overlay">
                        <button class="event-action red-button">¡Apúntate!</button>
                    </div>
                </div>
                <div class="event-content">
                    <div class="event-header">
                        <h3 class="event-title">Gran Prix del Rey Naresuan</h3>
                        <div class="event-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Estadio Rajadamnern, Tailandia</span>
                        </div>
                    </div>
                    <div class="event-meta">
                        <div class="event-date">
                            <i class="fas fa-calendar-alt"></i>
                            <span>6 DIC 2024</span>
                        </div>
                        <div class="event-price">50€</div>
                    </div>
                    <p class="event-description">
                        Evento con rituales tradicionales de ram muay. Combates con música en vivo y categoría especial
                        de codos y rodillas. Premio: Cinturón de oro macizo.
                    </p>
                    <div class="event-footer">
                        <div class="event-difficulty">
                            <span class="difficulty-label">Nivel:</span>
                            <div class="difficulty-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <button class="event-details red-button">Más detalles</button>
                    </div>
                </div>
            </div>

            <!-- Evento 5 - Judo -->
            <div class="event-card">
                <div class="event-badge">Judo</div>
                <div class="event-image">
                    <img src="../assets/images/events/event5.jpg" alt="Copa Kodokan 2024">
                    <div class="event-overlay">
                        <button class="event-action red-button">¡Apúntate!</button>
                    </div>
                </div>
                <div class="event-content">
                    <div class="event-header">
                        <h3 class="event-title">Copa Kodokan 2024</h3>
                        <div class="event-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Nippon Budokan, Japón</span>
                        </div>
                    </div>
                    <div class="event-meta">
                        <div class="event-date">
                            <i class="fas fa-calendar-alt"></i>
                            <span>3 NOV 2024</span>
                        </div>
                        <div class="event-price">40€</div>
                    </div>
                    <p class="event-description">
                        Competencia olímpica con sistema de eliminación directa. Incluye seminario con medallistas
                        olímpicos y exhibición de kata antiguos.
                    </p>
                    <div class="event-footer">
                        <div class="event-difficulty">
                            <span class="difficulty-label">Nivel:</span>
                            <div class="difficulty-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                        <button class="event-details red-button">Más detalles</button>
                    </div>
                </div>
            </div>

            <!-- Evento 6 - Kendo -->
            <div class="event-card">
                <div class="event-badge">Kendo</div>
                <div class="event-image">
                    <img src="../assets/images/events/event6.jpg" alt="Torneo Internacional de Kendo">
                    <div class="event-overlay">
                        <button class="event-action red-button">¡Apúntate!</button>
                    </div>
                </div>
                <div class="event-content">
                    <div class="event-header">
                        <h3 class="event-title">Torneo Internacional de Kendo</h3>
                        <div class="event-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Osaka Castle Hall, Japón</span>
                        </div>
                    </div>
                    <div class="event-meta">
                        <div class="event-date">
                            <i class="fas fa-calendar-alt"></i>
                            <span>12 OCT 2024</span>
                        </div>
                        <div class="event-price">30€</div>
                    </div>
                    <p class="event-description">
                        El mayor torneo de Kendo fuera de Tokio. Participación de maestros de 8º dan. Exhibición
                        especial de katas tradicionales y combates.
                    </p>
                    <div class="event-footer">
                        <div class="event-difficulty">
                            <span class="difficulty-label">Nivel:</span>
                            <div class="difficulty-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                        <button class="event-details red-button">Más detalles</button>
                    </div>
                </div>
            </div>

            <!-- Evento 7 - MMA -->
            <div class="event-card">
                <div class="event-badge">MMA</div>
                <div class="event-image">
                    <img src="../assets/images/events/event7.jpg" alt="Campeonato Europeo de MMA">
                    <div class="event-overlay">
                        <button class="event-action red-button">¡Apúntate!</button>
                    </div>
                </div>
                <div class="event-content">
                    <div class="event-header">
                        <h3 class="event-title">Campeonato Europeo de MMA</h3>
                        <div class="event-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Accor Arena, París</span>
                        </div>
                    </div>
                    <div class="event-meta">
                        <div class="event-date">
                            <i class="fas fa-calendar-alt"></i>
                            <span>15 MAR 2025</span>
                        </div>
                        <div class="event-price">45€</div>
                    </div>
                    <p class="event-description">
                        El torneo más importante de MMA en Europa con participantes de 15 países. Incluye categorías
                        amateur y profesional con reglas unificadas.
                    </p>
                    <div class="event-footer">
                        <div class="event-difficulty">
                            <span class="difficulty-label">Nivel:</span>
                            <div class="difficulty-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <button class="event-details red-button">Más detalles</button>
                    </div>
                </div>
            </div>

            <!-- Evento 8 - Boxeo -->
            <div class="event-card">
                <div class="event-badge">Boxeo</div>
                <div class="event-image">
                    <img src="../assets/images/events/event8.jpg" alt="Velada de Oro de Boxeo">
                    <div class="event-overlay">
                        <button class="event-action red-button">¡Apúntate!</button>
                    </div>
                </div>
                <div class="event-content">
                    <div class="event-header">
                        <h3 class="event-title">Velada de Oro de Boxeo</h3>
                        <div class="event-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Wizink Center, Madrid</span>
                        </div>
                    </div>
                    <div class="event-meta">
                        <div class="event-date">
                            <i class="fas fa-calendar-alt"></i>
                            <span>8 JUN 2025</span>
                        </div>
                        <div class="event-price">60€</div>
                    </div>
                    <p class="event-description">
                        Gran velada de boxeo internacional con 5 combates principales. Evento benéfico con parte de la
                        recaudación destinada a fundaciones deportivas.
                    </p>
                    <div class="event-footer">
                        <div class="event-difficulty">
                            <span class="difficulty-label">Nivel:</span>
                            <div class="difficulty-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                        <button class="event-details red-button">Más detalles</button>
                    </div>
                </div>
            </div>

            <!-- Evento 9 - Capoeira -->
            <div class="event-card">
                <div class="event-badge">Capoeira</div>
                <div class="event-image">
                    <img src="../assets/images/events/event9.jpg" alt="Encuentro Mundial de Capoeira">
                    <div class="event-overlay">
                        <button class="event-action red-button">¡Apúntate!</button>
                    </div>
                </div>
                <div class="event-content">
                    <div class="event-header">
                        <h3 class="event-title">Encuentro Mundial de Capoeira</h3>
                        <div class="event-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Pelourinho, Salvador de Bahía</span>
                        </div>
                    </div>
                    <div class="event-meta">
                        <div class="event-date">
                            <i class="fas fa-calendar-alt"></i>
                            <span>22 AGO 2025</span>
                        </div>
                        <div class="event-price">20€</div>
                    </div>
                    <p class="event-description">
                        Celebración anual que reúne a los mejores capoeiristas del mundo en la cuna de este arte
                        marcial. Incluye rodas, talleres y exhibiciones especiales.
                    </p>
                    <div class="event-footer">
                        <div class="event-difficulty">
                            <span class="difficulty-label">Nivel:</span>
                            <div class="difficulty-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                        <button class="event-details red-button">Más detalles</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <section class="events-cta">
        <div class="cta-container">
            <h2>¿Eres organizador de eventos?</h2>
            <p>Publica tu evento en DojoSearch y llega a miles de apasionados de las artes marciales</p>
            <button class="cta-button red-button">Publicar evento</button>
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
        // Navbar scroll effect
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

        // Simple filter functionality for demo purposes
        document.querySelectorAll('.filter-select').forEach(select => {
            select.addEventListener('change', function() {
                // In a real implementation, this would filter the events
                console.log(`Filter by ${this.id}: ${this.value}`);
            });
        });

        document.querySelector('.filter-reset').addEventListener('click', function() {
            document.querySelectorAll('.filter-select').forEach(select => {
                select.value = 'all';
            });
        });

        // Event card hover effects
        document.querySelectorAll('.event-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.querySelector('.event-overlay').style.opacity = '1';
            });

            card.addEventListener('mouseleave', function() {
                this.querySelector('.event-overlay').style.opacity = '0';
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>