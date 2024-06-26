<?php
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: index.php');
    exit;
}
?>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styleMenu.css">
        <title>La Cerve</title>
        <link rel="icon" href="assets/logo.png" type="image/x-icon">
        <style src="styleMenu.css"> </style>
    </head>
    <body>
        <header>
            <div class="header-left">
                <img src="assets/logo.png" alt="Logo" class="header-logo">
                <h2 class="header-name"> La Cerve </h2>
            </div>
            <nav class="header-right">
                <a href="index.php"> Inicio </a>
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
            <div class="search-container">
                <input type="text" id="search-bar" placeholder="Buscar productos..." class="search-bar">
            </div>
            <div class="smenu-container">
                <?php include 'getProducts.php'; ?>
            </div>
            <div class="tcart-container">
                <p class="tcart-text"> Le' Carrito </p>
                <div class="tcart-box"></div>
                <div class="total-amount">Total: $0.00</div>
                <button class="purchase-button">Descargar Ticket</button>
            </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="scriptMenu.js"> </script>
</html>