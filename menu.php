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

            main {
                align-items: center;
                display: flex;
                flex-direction: column;
            }
     
            .smenu-container {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 20px;
                width: 100%;
                max-width: 1200px;
                padding: 20px;
            }

            .smenu-product {
                background-position: center;
                background-size: cover;
                border-radius: 12px;
                color: white;
                height: 500px;
                overflow: hidden;
                position: relative;
                transition: transform 0.5s ease;
            }

            .smenu-product:hover {
                transform: scale(1.05);
            }

            .smenu-product::before {
                background: rgba(0, 0, 0, 0.8);
                bottom: 0;
                content: "";
                left: 0;
                opacity: 0;
                position: absolute;
                right: 0;
                top: 0;
                transition: opacity 0.5s ease, height 0.5s ease;
                z-index: 1;
            }

            .smenu-product .content {
                left: 50%;
                opacity: 0;
                position: absolute;
                text-align: center;
                top: 50%;
                transform: translate(-50%, -50%);
                transition: opacity 0.5s ease;
                z-index: 1;
            }

            .smenu-product .content .name {
                font-size: 24px;
                font-weight: bold;
                margin-bottom: 10px;
            }

            .smenu-product .content .price {
                font-size: 18px;
            }

            .smenu-product:hover::before,
            .smenu-product:hover .content {
                opacity: 1;
            }
            .search-container {
                position: relative;
                width: 700px;
                margin: 12px 10px;
                --accent-color: #a3e583;
            }

            .search-bar {
                border-radius: 25px;
                box-shadow: 0px 2px 5px rgb(35 35 35 / 30%);
                max-height: 36px;
                background-color: #e8e8e8;
                transition-timing-function: cubic-bezier(0.25, 0.8, 0.25, 1);
                transition-duration: 200ms;
                transition-property: background-color;
                color: #0f0f0f;
                font-size: 14px;
                font-weight: 500;
                padding: 14px;
                margin-top: 8px;
                width: 100%;
                border-left: none;
                border-bottom: none;
                border-right: none;
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
                    <a href="opiniones.html">Opiniones</a>
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
                    <img src="assets/iconlogin.png" alt="Logo" class="header-logo">
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

        document.getElementById('search-bar').addEventListener('input', function(e) {
        var searchValue = e.target.value.toLowerCase();
        var productElements = document.querySelectorAll('.smenu-product');

        productElements.forEach(function(product) {
            var productName = product.querySelector('.name').textContent.toLowerCase();
            if (productName.includes(searchValue)) {
                product.style.display = '';
            } else {
                product.style.display = 'none';
            }
            });
        });
    </script>
</html>