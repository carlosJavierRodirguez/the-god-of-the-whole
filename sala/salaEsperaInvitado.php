<?php
session_start();  // Inicia la sesión

// Verificar si el nombre del invitado está en la sesión
if (!isset($_SESSION['nombreInvitado']) || !isset($_SESSION['datosSala'])) {
    // Si cualquiera de las dos variables de sesión no está definida, redirige
    header("Location: ../invitado/unirse.php");
    exit();
}

// Nombre del invitado desde la sesión
$nombreInvitado = $_SESSION['nombreInvitado'];

//Datos de la sala
$nombreSala = $_SESSION['datosSala']['nombre_sala'] ?? 'No disponible';
$codigoSala = $_SESSION['datosSala']['codigo_sala'] ?? 'No disponible';

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
                <div>Nombre Sala: <?php echo $nombreSala; ?></div>
                <div>Codigo: <?php echo $codigoSala; ?>
                    <button class=" bg-transparent border-0">
                        <i class="fa-solid fa-copy"></i>
                    </button>
                </div>
            </div>

            <div class="text-white">Jugadores: <i class="fa-solid fa-user"></i> </div>

            <div class="rueda col-9">
                <ul id="lista-usuarios"></ul>
                <!-- <div class="user-profile form-group mt-2 rounded ">
                    <img class="user-icon" src="../img/diosesVerdaderos/afrodita.png" alt="">
                    <span class="username"><?php echo $nombreInvitado; ?></span>
                </div> -->
            </div>

        </div>
    </div>

    <script src="../js/socket/usuarioOnline.js"></script>
</body>

</html>