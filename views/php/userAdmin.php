<?php
require_once '../../controllers/UserController.php';
UserController::checkSession();

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Administrador - DojoSearch</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../assets/images/logoDS.png">
</head>

<body>
    <div id="navbar">
        <div class="logo-container">
            <a href="/DojoSearch/views/php/index.php" class="logo-link">
                <img src="../assets/images/logoDS.png" alt="Logo" class="logo" />
                <h2>DojoSearch</h2>
            </a>
        </div>

        <input type="checkbox" id="menu-toggle" class="menu-toggle" />
        <label for="menu-toggle" class="menu-toggle-label">&#9776;</label>

        <nav class="nav-menu">
            <a href="../php/events.php">EVENTOS</a>
            <?php if (!empty($_SESSION['user']) && is_array($_SESSION['user'])): ?>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="<?php echo !empty($_SESSION['user']['photo']) ? 'data:image/jpeg;base64,' . base64_encode($_SESSION['user']['photo']) : 'https://via.placeholder.com/30?text=Sin+Foto'; ?>" alt="Foto de perfil" class="profile-pic-nav" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 5px;">
                        PERFIL
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="/DojoSearch/views/php/<?php echo $_SESSION['user']['is_admin'] ? 'userAdmin.php' : 'userUser.php'; ?>">Configurar Perfil</a>
                        <a class="dropdown-item" href="/DojoSearch/controllers/UserController.php?action=logout">Cerrar Sesión</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="/DojoSearch/views/php/login.php" class="nav-link">PERFIL</a>
            <?php endif; ?>
        </nav>
    </div>

    <!-- Profile Section -->
    <section class="profile-section">
        <div class="profile-container">
            <div class="section-header">
                <span class="section-subtitle">CONFIGURACIÓN DE</span>
                <h2 class="section-title">MI PERFIL</h2>

        
                <div class="divider-red"></div>
                
            </div>




            <!-- Mensajes de error o éxito -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="error"><?php echo htmlspecialchars($_SESSION['error']); ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
            <?php if (isset($_SESSION['success'])): ?>
                <div class="success-message"><?php echo htmlspecialchars($_SESSION['success']); ?></div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <div class="profile-card">
                <div class="profile-sidebar">
                    <div class="profile-userpic">
                        <?php if (!empty($user['photo'])): ?>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($user['photo']); ?>" class="img-responsive" alt="Foto de perfil">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/150?text=Sin+Foto" class="img-responsive" alt="Foto de perfil">
                        <?php endif; ?>

                    </div>

                    <div class="profile-usertitle">
                        <div class="profile-usertitle-job">
                            ADMINISTRADOR
                        </div>
                    </div>

                    <div class="profile-usermenu">
                        <ul class="nav flex-column">
                            <li class="nav-item active">
                                <a class="nav-link" href="#account-general" data-toggle="tab">
                                    Información General
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#account-password" data-toggle="tab">
                                    Cambiar Contraseña
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#account-info" data-toggle="tab">
                                    Información Personal
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#account-social" data-toggle="tab">
                                    Redes Sociales
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#account-notifications" data-toggle="tab">
                                    Notificaciones
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#account-delete" data-toggle="tab">
                                    Borrar Cuenta
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="profile-content">
                    <div class="tab-content">
                        <!-- General Tab -->
                        <div class="tab-pane active" id="account-general">
                            <form action="/DojoSearch/controllers/UserController.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="updateGeneral">
                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Foto de perfil</label>
                                    <div class="col-lg-9">
                                        <div class="profile-avatar-container">
                                            <div class="avatar-actions">
                                                <label class="btn btn-upload" style="color: white; margin-top: 10px; text-align: left;">
                                                    <input type="file" name="photo" accept="image/*">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="profile-divider">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Nombre de usuario</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Nombre completo</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Correo electrónico</label>
                                    <div class="col-lg-9">
                                        <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                                    </div>
                                </div>
                                <div class="profile-actions">
                                    <button type="button" class="btn-cancel" onclick="window.location.href='/DojoSearch/views/php/userAdmin.php'">Cancelar</button>
                                    <button type="submit" class="btn-save">Guardar cambios</button>
                                </div>
                            </form>
                        </div>

                        <!-- Password Tab -->
                        <div class="tab-pane" id="account-password">
                            <form action="/DojoSearch/controllers/UserController.php" method="POST">
                                <input type="hidden" name="action" value="updatePassword">
                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Nueva contraseña</label>
                                    <div class="col-lg-9">
                                        <input type="password" class="form-control" name="password" placeholder="Dejar en blanco para no cambiar">
                                    </div>
                                </div>
                                <div class="profile-actions">
                                    <button type="button" class="btn-cancel" onclick="window.location.href='/DojoSearch/views/php/userAdmin.php'">Cancelar</button>
                                    <button type="submit" class="btn-save">Guardar cambios</button>
                                </div>
                            </form>
                        </div>

                        <!-- Personal Info Tab -->
                        <div class="tab-pane" id="account-info">
                            <form action="/DojoSearch/controllers/UserController.php" method="POST">
                                <input type="hidden" name="action" value="updateInfo">
                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Biografía</label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control" name="bio" rows="5"><?php echo htmlspecialchars($user['bio'] ?? ''); ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Fecha de nacimiento</label>
                                    <div class="col-lg-9">
                                        <input type="date" class="form-control" name="fecha_born" value="<?php echo htmlspecialchars($user['fecha_born'] ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Teléfono</label>
                                    <div class="col-lg-9">
                                        <input type="tel" class="form-control" name="phone" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="profile-actions">
                                    <button type="button" class="btn-cancel" onclick="window.location.href='/DojoSearch/views/php/userAdmin.php'">Cancelar</button>
                                    <button type="submit" class="btn-save">Guardar cambios</button>
                                </div>
                            </form>
                        </div>

                        <!-- Social Tab -->
                        <div class="tab-pane" id="account-social">
                            <form action="/DojoSearch/controllers/UserController.php" method="POST">
                                <input type="hidden" name="action" value="updateSocial">
                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Twitter</label>
                                    <div class="col-lg-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">@</span>
                                            </div>
                                            <input type="text" class="form-control" name="twitter" value="<?php echo htmlspecialchars($user['twitter'] ?? ''); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Instagram</label>
                                    <div class="col-lg-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">@</span>
                                            </div>
                                            <input type="text" class="form-control" name="instagram" value="<?php echo htmlspecialchars($user['instagram'] ?? ''); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Facebook</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="facebook" value="<?php echo htmlspecialchars($user['facebook'] ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">YouTube</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="youtube" value="<?php echo htmlspecialchars($user['youtube'] ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="profile-actions">
                                    <button type="button" class="btn-cancel" onclick="window.location.href='/DojoSearch/views/php/userAdmin.php'">Cancelar</button>
                                    <button type="submit" class="btn-save">Guardar cambios</button>
                                </div>
                            </form>
                        </div>

                        <!-- Notifications Tab -->
                        <div class="tab-pane" id="account-notifications">
                            <form action="/DojoSearch/controllers/UserController.php" method="POST">
                                <input type="hidden" name="action" value="updateNotifications">
                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                <h5 class="notification-section-title">Notificaciones por correo</h5>
                                <div class="form-group">
                                    <div class="notification-item">
                                        <label class="notification-switch">
                                            <input type="checkbox" name="email_messages" <?php echo (isset($user['email_messages']) && $user['email_messages']) ? 'checked' : ''; ?>>
                                            <span class="slider round"></span>
                                        </label>
                                        <span class="notification-label">Nuevos mensajes privados</span>
                                    </div>
                                    <div class="notification-item">
                                        <label class="notification-switch">
                                            <input type="checkbox" name="email_reminders" <?php echo (isset($user['email_reminders']) && $user['email_reminders']) ? 'checked' : ''; ?>>
                                            <span class="slider round"></span>
                                        </label>
                                        <span class="notification-label">Recordatorios de clases</span>
                                    </div>
                                    <div class="notification-item">
                                        <label class="notification-switch">
                                            <input type="checkbox" name="email_promotions" <?php echo (isset($user['email_promotions']) && $user['email_promotions']) ? 'checked' : ''; ?>>
                                            <span class="slider round"></span>
                                        </label>
                                        <span class="notification-label">Promociones especiales</span>
                                    </div>
                                </div>
                                <div class="profile-actions">
                                    <button type="button" class="btn-cancel" onclick="window.location.href='/DojoSearch/views/php/userAdmin.php'">Cancelar</button>
                                    <button type="submit" class="btn-save">Guardar cambios</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="account-delete">
                            <form action="/DojoSearch/controllers/UserController.php" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas borrar tu cuenta? Esta acción no se puede deshacer.');">
                                <input type="hidden" name="action" value="deleteAccount">
                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                <div class="form-group">
                                    <p>Al borrar tu cuenta, se eliminarán permanentemente todos tus datos, incluyendo tu perfil, preferencias y registros. Esta acción no se puede deshacer.</p>
                                    <label>
                                        <input type="checkbox" name="confirm_delete" required>
                                        Confirmo que deseo borrar mi cuenta.
                                    </label>
                                </div>
                                <div class="profile-actions">
                                    <button type="button" class="btn-cancel" onclick="window.location.href='/DojoSearch/views/php/userUser.php'">Cancelar</button>
                                    <button type="submit" class="btn btn-danger">Borrar Cuenta</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.profile-usermenu a').on('click', function(e) {
                e.preventDefault();
                $('.profile-usermenu a').removeClass('active');
                $(this).addClass('active');
                $('.tab-pane').removeClass('active');
                $($(this).attr('href')).addClass('active');
            });
        });
    </script>

    <footer class="martial-footer">
        <div class="footer-container">
            <div class="footer-grid">
                <div class="footer-column">
                    <div class="footer-brand">
                        <img src="/DojoSearch/assets/images/logoDS.png" alt="DojoSearch Logo" class="footer-logo">
                        <h3 class="footer-title">DojoSearch</h3>
                    </div>
                    <div class="social-links">
                        <a href="#" class="social-icon" aria-label="Instagram">
                            <img src="/DojoSearch/assets/images/social-media/instagram.png" alt="Instagram">
                        </a>
                        <a href="#" class="social-icon" aria-label="Facebook">
                            <img src="/DojoSearch/assets/images/social-media/facebook.png" alt="Facebook">
                        </a>
                        <a href="#" class="social-icon" aria-label="YouTube">
                            <img src="/DojoSearch/assets/images/social-media/youtube.png" alt="YouTube">
                        </a>
                        <a href="#" class="social-icon" aria-label="LinkedIn">
                            <img src="/DojoSearch/assets/images/social-media/linkedin.png" alt="LinkedIn">
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
                        <li><a href="/DojoSearch/views/php/events.php">Eventos</a></li>
                        <li><a href="/DojoSearch/views/php/userAdmin.php">Mi Perfil</a></li>
                        <li><a href="#">Galería</a></li>
                        <li><a href="#">Blog Marcial</a></li>
                        <li><a href="#">Tienda</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h4 class="footer-heading">Contacto</h4>
                    <ul class="contact-info">
                        <li>
                            <img src="/DojoSearch/assets/images/icons/pin.png" alt="Ubicación">
                            <span>500 Terry Francine St<br>San Francisco, CA 94158</span>
                        </li>
                        <li>
                            <img src="/DojoSearch/assets/images/icons/phone.png" alt="Teléfono">
                            <span>123-456-7890</span>
                        </li>
                        <li>
                            <img src="/DojoSearch/assets/images/icons/email.png" alt="Email">
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
                <p class="copyright">&copy; 2025 DojoSearch. Todos los derechos reservados</p>
            </div>
        </div>
    </footer>
</body>

</html>