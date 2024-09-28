<?php include('principal/head.php') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tres divs centrados en el borde izquierdo</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/estilosUSer.css">
</head>
<body>

  <div class="contenedor">
        <a href="#" class="contenedor-item">
            <i class="bi bi-plus-circle"></i>
            <p>Crear Sala</p>
        </a>
        <a href="unirse.php" class="contenedor-item">
            <i class="bi bi-people"></i>
            <p>Unirse</p>
        </a>
        <a href="configuraciones.php" class="contenedor-item">
            <i class="bi bi-gear"></i>
            <p>Configuraciones</p>
        </a>
    </div>

    <div class="user-profile">
        <img src="img/afrodita.png" alt="Icono de Usuario" class="user-icon">
        <span class="username">ZZZZZZZ</span>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>