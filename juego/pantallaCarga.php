<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pantalla de Carga</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/cargaJuego.css">
</head>
<body>
    <!-- Pantalla de carga -->
    <div id="loadingScreen" class="loading-screen">
        <div class="scroll-container">
            <!-- Imagen/logo centrado -->
            <div class=""></div>
            <!-- Barra de carga -->
            <div class="loading-bar">
                <div class="progress"></div>
            </div>
        </div>
    </div>

    <!-- Contenido principal de la página -->
    <div id="mainContent" style="display: none;">
        <h1>Contenido de la página</h1>
        <p>Este es el contenido de la página que se mostrará después de la pantalla de carga.</p>
    </div>

    <script src="../js/cargaJuego.js"></script>
</body>
</html>