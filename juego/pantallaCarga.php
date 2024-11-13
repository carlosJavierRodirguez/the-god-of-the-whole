<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pantalla de carga</title>
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
        <p class="loading-text">Cargando...</p>
    </div>

    <!-- Contenido principal -->
    <div class="content">
        <!-- Aquí irá el contenido de tu página que se mostrará después de que se complete la carga -->
    </div>
    <script src="../js/cargaJuego.js"></script>
</body>
</html>