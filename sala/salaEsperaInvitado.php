<?php
session_start();  // Inicia la sesión

// Verificar si el nombre del invitado está en la sesión
if (!isset($_SESSION['nombreInvitado'])) {
    // Si no está en la sesión, redirige a la página de inicio o a una página de error
    header("Location: ../invitado/unirse.php");  
    exit();
}

// Si el nombre está en la sesión, lo mostramos o procesamos
$nombreInvitado = $_SESSION['nombreInvitado'];  // Nombre del invitado desde la sesión
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('../principal/head.php') ?>
    <link rel="stylesheet" href="../css/salaEsp.css">
</head>

<body>

    <div class="pergaminoCu-Container">
        <div class="pergaminoCu">

            <div class="infoSala col-9 text-white">
                <!-- Asignar dinámicamente el nombre de la sala (puedes ajustar de dónde viene este valor) -->
                <div>Nombre Sala: <?php   ?></div>
                <!-- Mostrar el código de la sala desde la sesión -->
                <div>Codigo: <?php ?>
                    <button class=" bg-transparent border-0">
                        <i class="fa-solid fa-copy"></i>
                    </button>
                </div>
            </div>

            <div class="text-white">Jugadores: / <i class="fa-solid fa-user"></i> </div>

            <div class="rueda col-9">
                <div class="user-profile form-group mt-2 rounded ">
                    <img class="user-icon" src="../img/diosesVerdaderos/afrodita.png" alt="">
                    <span class="username"><?php echo $nombreInvitado; ?></span>
                </div>
            </div>

        </div>
    </div>

</body>

</html>