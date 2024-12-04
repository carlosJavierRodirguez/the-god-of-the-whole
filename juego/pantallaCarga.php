<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('../principal/head.php'); ?>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/cargaJuego.css">
</head>

<body class="pantano">
    <div class="loading-screen">
        <!-- Logo en el centro -->
        <div class="logo">
            <img src="../img/basilis.png" alt="Logo"> <!-- Asegúrate de reemplazar con la ruta correcta de tu logo -->
        </div>

        <!-- GIF de carga -->
        <div class="loading-gif">
            <img src="../gif/espiral.gif" alt="Cargando..."> <!-- Asegúrate de poner la ruta correcta de tu GIF -->
        </div>

        <!-- Mensaje de carga -->
        <p class="loading-text"></p>
    </div>

    <!-- Contenido principal -->
    <div class="content">
        <!-- Aquí irá el contenido de tu página que se mostrará después de que se complete la carga -->
    </div>
    <script src="../js/juego-js/carga/cargaJuego.js"></script>
    <iframe id="musicaIframe" src="../musica/musicaJuego.html" allow="autoplay" style="display:none;"></iframe>
</body>

</html>