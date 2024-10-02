<?php
session_start(); // Esto debe estar en la primera línea del archivo
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('principal/head.php') ?>
    <link rel="stylesheet" href="./css/estilosUSer.css">
</head>

<body>

    <div class="contenedor">
        <a href="#" class="contenedor-item">
            <i class="fa-solid fa-circle-plus"></i>
            <p>Crear Sala</p>
        </a>
        <a href="unirse.php" class="contenedor-item">
            <i class="fa-solid fa-user-group"></i>
            <p>Unirse</p>
        </a>
        <a href="configuraciones.php" class="contenedor-item">
            <i class="fa-solid fa-gear"></i>
            <p>Configuraciones</p>
        </a>
        <div class="col-12 row fondo">
            <div class="col-6"></div>
            <div class="col-6"></div>
        </div>
    </div>

    <div class="user-profile">
        <img src="img/afrodita.png" alt="Icono de Usuario" class="user-icon">
        <span class="username"><?php echo  $_SESSION['nombreUsuario']; ?></span>
    </div>
</body>

</html>