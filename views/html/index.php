<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DojoSearch - Inicio</title>
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link rel="icon" type="image/png" href="../assets/images/logoDS.png" />
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

  <section class="hero">
    <div class="hero-overlay"></div>
    <video class="hero-video" autoplay muted loop playsinline>
      <source src="../assets/videos/1.mp4" type="video/mp4">
      Tu navegador no soporta el elemento de video.
    </video>

    <div class="hero-container">
      <div class="hero-content">
        <p class="hero-subtitle">Bienvenido a</p>
        <h1 class="hero-title">DojoSearch</h1>
        <div class="hero-divider"></div>
        <p class="hero-tagline">La plataforma líder en eventos de artes marciales</p>
        <a href="../html/events.php" class="hero-cta">
          Descubre tu próximo evento
          <span class="cta-arrow">→</span>
        </a>
      </div>

      <div class="hero-stats">
        <div class="stat-card">
          <h3>250+</h3>
          <p>Eventos anuales</p>
        </div>
        <div class="stat-card">
          <h3>5K+</h3>
          <p>Artistas marciales</p>
        </div>
        <div class="stat-card">
          <h3>30+</h3>
          <p>Disciplinas diferentes</p>
        </div>
      </div>
    </div>
  </section>

  <section class="about-section">
    <div class="about-container">
      <div class="about-content">
        <div class="section-header">
          <span class="section-subtitle">Nuestra filosofía</span>
          <h2 class="section-title">Más que eventos, creamos <span>experiencias marciales</span></h2>
          <div class="divider-red"></div>
        </div>

        <div class="about-grid">
          <div class="about-text">
            <div class="about-item">
              <div class="icon-box">
                <img src="../assets/images/icons/karate.png" alt="Icono karate">
              </div>
              <h3>Diversidad de disciplinas</h3>
              <p>Desde artes tradicionales como el Karate y Judo hasta disciplinas modernas como MMA y Krav Maga.</p>
            </div>

            <div class="about-item">
              <div class="icon-box">
                <img src="../assets/images/icons/certificate.png" alt="Icono certificación">
              </div>
              <h3>Certificaciones internacionales</h3>
              <p>Todos nuestros instructores cuentan con certificaciones avaladas por las principales federaciones mundiales.</p>
            </div>

            <div class="about-item">
              <div class="icon-box">
                <img src="../assets/images/icons/global.png" alt="Icono global">
              </div>
              <h3>Alcance global</h3>
              <p>Eventos en 15 países con traducción simultánea y transmisión en vivo para todo el mundo.</p>
            </div>
          </div>

          <div class="about-media">
            <div class="image-container">
              <img src="../assets/images/sobre-nosotros.jpg" alt="Equipo DojoSearch" class="main-image">
              <div class="experience-badge">
                <span>15+</span>
                <p>Años de experiencia</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="team-section">
    <div class="team-container">
      <div class="section-header">
        <h2 class="section-title">Maestros del Arte Marcial</h2>
        <p class="section-subtitle">Instructores certificados con décadas de experiencia combinada</p>
        <div class="divider-red"></div>
      </div>

      <div class="team-grid">
        <div class="trainer-card">
          <div class="trainer-image">
            <img src="../assets/images/trainers/Jake.jpg" alt="Jake Silva">
            <div class="discipline-badge">Shotokan Karate</div>
          </div>
          <div class="trainer-info">
            <h3 class="trainer-name">Jake Silva</h3>
            <p class="trainer-title">Instructor Principal</p>
            <div class="trainer-divider"></div>
            <p class="trainer-bio">7º Dan de Karate especializado en katas tradicionales y defensa personal moderna. Campeón mundial WKF 2015-2018.</p>
            <div class="trainer-social">
              <a href="#" class="social-icon" aria-label="Perfil de Instagram">
                <img src="../assets/images/social-media/instagram.png" alt="Instagram">
              </a>
              <a href="#" class="social-icon" aria-label="Perfil de LinkedIn">
                <img src="../assets/images/social-media/linkedin.png" alt="LinkedIn">
              </a>
            </div>
          </div>
        </div>

        <div class="trainer-card">
          <div class="trainer-image">
            <img src="../assets/images/trainers/Terri.jpg" alt="Terri Garner">
            <div class="discipline-badge">MMA & Combate</div>
          </div>
          <div class="trainer-info">
            <h3 class="trainer-name">Terri Garner</h3>
            <p class="trainer-title">Entrenadora de Elite</p>
            <div class="trainer-divider"></div>
            <p class="trainer-bio">Pionera en MMA femenino con 12 victorias profesionales. Especialista en integración de técnicas múltiples.</p>
            <div class="trainer-social">
              <a href="#" class="social-icon" aria-label="Perfil de Instagram">
                <img src="../assets/images/social-media/instagram.png" alt="Instagram">
              </a>
              <a href="#" class="social-icon" aria-label="Perfil de LinkedIn">
                <img src="../assets/images/social-media/linkedin.png" alt="LinkedIn">
              </a>
            </div>
          </div>
        </div>

        <div class="trainer-card">
          <div class="trainer-image">
            <img src="../assets/images/trainers/sean.jpg" alt="Sean Walters">
            <div class="discipline-badge">Muay Thai</div>
          </div>
          <div class="trainer-info">
            <h3 class="trainer-name">Sean Walters</h3>
            <p class="trainer-title">Especialista en Striking</p>
            <div class="trainer-divider"></div>
            <p class="trainer-bio">Entrenador de campeones en estadios Lumpinee. Dominio de las 8 armas corporales.</p>
            <div class="trainer-social">
              <a href="#" class="social-icon" aria-label="Perfil de Instagram">
                <img src="../assets/images/social-media/instagram.png" alt="Instagram">
              </a>
              <a href="#" class="social-icon" aria-label="Perfil de LinkedIn">
                <img src="../assets/images/social-media/linkedin.png" alt="LinkedIn">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="app-section">
    <div class="app-container">
      <div class="app-content">
        <div class="section-header">
          <h2 class="section-title">Tu dojo en el bolsillo</h2>
          <div class="divider-red"></div>
        </div>

        <div class="app-grid">
          <div class="app-features">
            <div class="feature-card">
              <div class="feature-icon">
                <img src="../assets/images/icons/clock.png" alt="Icono calendario">
              </div>
              <h3>Eventos en tiempo real</h3>
              <p>Recibe notificaciones instantáneas y sincroniza con tu calendario</p>
            </div>

            <div class="feature-card">
              <div class="feature-icon">
                <img src="../assets/images/icons/ticket.png" alt="Icono tickets">
              </div>
              <h3>Gestor de entradas</h3>
              <p>Acceso digital, compartición fácil y recordatorios automáticos</p>
            </div>

            <div class="feature-card">
              <div class="feature-icon">
                <img src="../assets/images/icons/trophy.png" alt="Icono ranking">
              </div>
              <h3>Seguimiento de progreso</h3>
              <p>Analiza tu evolución marcial con estadísticas personalizadas</p>
            </div>
          </div>

          <div class="app-preview">
            <img src="../assets/images/preview.jpg" alt="Vista previa app" class="floating-mockup">
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="contact-section">
    <div class="contact-container">
      <div class="contact-grid">
        <div class="contact-info">
          <div class="section-header">
            <h2 class="section-title">Conecta con la comunidad</h2>
            <div class="divider-red"></div>
          </div>

          <div class="info-card">
            <div class="info-item">
              <img src="../assets/images/icons/pin.png" alt="Icono ubicación">
              <div>
                <h3>Dojo Central</h3>
                <p>500 Terry Francine St<br>San Francisco, CA 94158</p>
              </div>
            </div>

            <div class="info-item">
              <img src="../assets/images/icons/phone.png" alt="Icono teléfono">
              <div>
                <h3>Contacto Directo</h3>
                <p>123-456-7890<br>Lun-Vie: 9:00 - 18:00</p>
              </div>
            </div>

            <div class="info-item">
              <img src="../assets/images/icons/email.png" alt="Icono email">
              <div>
                <h3>Soporte 24/7</h3>
                <p>info@dojosearch.com<br>soporte@dojosearch.com</p>
              </div>
            </div>
          </div>
        </div>

        <div class="contact-form">
          <form class="martial-form">
            <div class="form-group">
              <input type="text" placeholder="Nombre" required>
              <input type="email" placeholder="Email" required>
            </div>
            <textarea placeholder="Tu mensaje..." rows="5" required></textarea>
            <button type="submit" class="form-btn">
              Enviar Mensaje
              <img src="../assets/images/icons/cursor.png" alt="Icono enviar">
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <section class="location-section">
    <div class="location-container">
      <div class="section-header">
        <h2 class="section-title">Nuestro Dojo Central</h2>
        <div class="divider-red"></div>
        <p class="section-subtitle">Visítanos o participa en nuestros eventos internacionales</p>
      </div>

      <div class="location-grid">
        <div class="map-container">
          <div id="map" class="interactive-map"></div>
          <div class="map-overlay">
            <button class="location-btn active" data-coords="41.3874,2.1686" data-name="Barcelona">Barcelona</button>
            <button class="location-btn" data-coords="40.4168,-3.7038" data-name="Madrid">Madrid</button>
            <button class="location-btn" data-coords="48.8566,2.3522" data-name="París">París</button>
          </div>
        </div>

        <div class="location-info">
          <div class="info-card">
            <h3 id="location-title"><img src="../assets/images/icons/pin.png" alt="Icono pin">Dojo Barcelona</h3>
            <div class="info-item">
              <img src="../assets/images/icons/clock.png" alt="Icono reloj">
              <div>
                <p class="info-label">Horario:</p>
                <p id="location-schedule">Lun-Vie: 6:00 - 22:00<br>Sab-Dom: 8:00 - 20:00</p>
              </div>
            </div>
            <div class="info-item">
              <img src="../assets/images/icons/star.png" alt="Icono estrella">
              <div>
                <p class="info-label">Instalaciones:</p>
                <p id="location-facilities">• 3 Dojos profesionales<br>• Sala de pesas<br>• Zona de recuperación<br>• Tienda oficial</p>
              </div>
            </div>
            <a href="#" class="directions-btn" id="directions-link">
              Obtener direcciones
              <img src="../assets/images/icons/cursor.png" alt="Icono flecha">
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script>
    var locations = {
      "Barcelona": {
        coords: [41.3874, 2.1686],
        schedule: "Lun-Vie: 6:00 - 22:00<br>Sab-Dom: 8:00 - 20:00",
        facilities: "• 3 Dojos profesionales<br>• Sala de pesas<br>• Zona de recuperación<br>• Tienda oficial",
        directions: "https://maps.google.com/?q=41.3874,2.1686"
      },
      "Madrid": {
        coords: [40.4168, -3.7038],
        schedule: "Lun-Vie: 7:00 - 23:00<br>Sab-Dom: 9:00 - 21:00",
        facilities: "• 2 Dojos profesionales<br>• Sala de musculación<br>• Spa y sauna",
        directions: "https://maps.google.com/?q=40.4168,-3.7038"
      },
      "París": {
        coords: [48.8566, 2.3522],
        schedule: "Lun-Vie: 5:30 - 22:30<br>Sab-Dom: 7:00 - 20:00",
        facilities: "• 4 Dojos de alta competición<br>• Gimnasio equipado<br>• Tienda de artes marciales",
        directions: "https://maps.google.com/?q=48.8566,2.3522"
      }
    };

    var map = L.map("map").setView(locations["Barcelona"].coords, 13);
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
      attribution: "© OpenStreetMap contributors",
    }).addTo(map);

    var marker = L.marker(locations["Barcelona"].coords).addTo(map).bindPopup("Barcelona, España").openPopup();

    document.querySelectorAll(".location-btn").forEach(button => {
      button.addEventListener("click", function() {
        document.querySelectorAll(".location-btn").forEach(btn => btn.classList.remove("active"));
        this.classList.add("active");

        var locationName = this.getAttribute("data-name");
        var locationData = locations[locationName];

        map.setView(locationData.coords, 13);
        marker.setLatLng(locationData.coords).bindPopup(locationName).openPopup();

        document.getElementById("location-title").innerHTML = `<img src="../assets/images/icons/pin.png" alt="Icono pin">Dojo ${locationName}`;
        document.getElementById("location-schedule").innerHTML = locationData.schedule;
        document.getElementById("location-facilities").innerHTML = locationData.facilities;
        document.getElementById("directions-link").href = locationData.directions;
      });
    });
  </script>

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
</body>

</html>