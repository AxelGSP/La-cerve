<?php
session_start();
?>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>La Cerve</title>
        <link rel="icon" href="assets/logo.png" type="image/x-icon">
        <style>
            .header-icon {
                margin-right: 10px;
                width: 150px;
                cursor: pointer;
            }
            .header{
                cursor: pointer;
            }

            .cta-button {
                background-color: #6b1e1e;
            }

            .cta-button:hover {
                background-color: #541111;
            }
        </style>
    </head>
    <body>
        <header>
            <div class="header-left">
                <img src="assets/logo.png" alt="Logo" class="header-logo">
                <h2 class="header-name"> La Cerve </h2>
            </div>
            <nav class="header-right">
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                    <a href="menu.php">Menú</a>
                    <a href="opiniones.php">Opiniones</a>
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <a href="admin.php">Admin</a>
                    <?php endif; ?>
                <?php else: ?>
                    <a class="header denied">Menú</a>
                    <a class="header denied">Opiniones</a>
                <?php endif; ?>
                <a href="https://www.google.com/maps/place/La+Cerve/@20.0626885,-98.3657316,17z/data=!3m1!4b1!4m6!3m5!1s0x85d056e7dd938b1b:0x72bee47af4020cbb!8m2!3d20.0626885!4d-98.3631567!16s%2Fg%2F11c58h7l2l?entry=ttu"> Maps </a>
            </nav>
            <div>
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                    <img src="assets/iconlogin.png" alt="Logo" class="header-logo" id="iconMenu">
                    <div class="options-menu" id="optionsMenu">
                        <a href="logout.php" class="option">Logout</a>
                <?php else: ?>
                    <img src="assets/icon.png" alt="Logo" class="header-icon" id="iconMenu">
                    <div class="options-menu" id="optionsMenu">
                        <div class="option" id="loginOption">Login</div>
                        <div class="option" id="registerOption">Register</div>
                <?php endif; ?>
            </div>
        </div>
        <script src="scriptindex.js"></script>
        </header>
        <main>
            <div class="container1">
                <section class="container">
                    <h1>Bienvenido a La Cerve</h1>
                    <p>Descubre el lugar perfecto para disfrutar de una noche especial con amigos o familia!!!. Ofrecemos los mejores snacks y micheladas en un ambiente único.</p>
                    <img src="assets/Escena.png" alt="Ambiente de La Cerve" class="promo-image">
                </section>
            </div>
            <section class="menu-section">
                <h2>Lo Que Tenemos por Ofrecerte !!!</h2>
                <div class="menu-grid">
                    <?php include 'randomDisplay.php'; ?>
                </div>
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                    <a href="menu.php" class="cta-button">Explorar nuestro menú</a>
                <?php else: ?>
                    <a class="cta-button denied">Explorar nuestro menú</a>
                <?php endif; ?>
            </section>
        </main>  
        <footer>
            <div class="footer-container">
                <div class="footer-left">
                    <img src="assets/logo.png" alt="Logo" class="footer-logo">
                </div>
                <div class="footer-center">
                    <a href="https://www.facebook.com/profile.php?id=245958332276626&_rdr" target="_blank" class="footer-social"> Facebook </a>
                </div>
                <div class="footer-right">
                    <p class="footer-info"> 43696, Av. Gilberto Gómez Carbajal 25, Tollancingo, Tulancingo, Hgo. </p>
                    <p class="footer-info"> Phone: +527757719579 </p>
                </div>
            </div>
        </footer>
    </body>
    <script>
        document.querySelectorAll('.denied').forEach(element => {
            element.onclick = function() {
                alert("Lo sentimos, no puede acceder a esta opcion sin un registro previo, lo invitamos a crear una cuenta personal");
            };
        });
    </script>
</html>