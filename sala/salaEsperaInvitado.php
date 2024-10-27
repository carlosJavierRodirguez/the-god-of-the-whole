<?php
session_start();

// Verificar si el invitado está en la sesión
if (!isset($_SESSION['nombreInvitado'])) {
    header('Location: ../unirse.php'); // Redirigir al inicio si no hay sesión activa
    exit();
}

// Obtener el nombre del invitado y el código de sala desde la sesión
$nombreInvitado = $_SESSION['nombreInvitado'];
$codigoSala = $_SESSION['codigoSala'];

// Mostrar el nombre del invitado de forma segura
echo "<h1>Bienvenido a la sala de espera, " . htmlspecialchars($nombreInvitado) . "</h1>";
echo "<p>Tu código de sala es: " . htmlspecialchars($codigoSala) . "</p>";
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
                <div>Nombre Sala: <?php echo htmlspecialchars("Carlos"); // Cambia esto dinámicamente si es necesario 
                                    ?></div>
                <!-- Mostrar el código de la sala desde la sesión -->
                <div>Codigo: <?php echo htmlspecialchars($codigoSala); ?>
                    <button class=" bg-transparent border-0">
                        <i class="fa-solid fa-copy"></i>
                    </button>
                </div>
            </div>

            <div class="text-white">Jugadores: 4/4 <i class="fa-solid fa-user"></i> </div>

            <div class="rueda col-9">
                <!-- Ejemplo de jugador (puedes hacer dinámico este contenido según los jugadores reales en la sala) -->
                <div class="user-profile col-12">
                    <img class="user-icon" src="../img/afrodita.png" alt="icono de usuario">
                    <span class="username"><?php echo htmlspecialchars($nombreInvitado); ?></span> <!-- Mostrar el nombre del invitado -->
                </div>

                <!-- Otros jugadores pueden ser mostrados aquí -->
                <div class="user-profile col-12">
                    <img class="user-icon" src="../img/afrodita.png" alt="icono de usuario">
                    <span class="username">Carlos Javier</span> <!-- Datos de ejemplo -->
                </div>

                <div class="user-profile col-12">
                    <img class="user-icon" src="../img/afrodita.png" alt="icono de usuario">
                    <span class="username">Carlos Javier</span>
                </div>

                <div class="user-profile col-12">
                    <img class="user-icon" src="../img/afrodita.png" alt="icono de usuario">
                    <span class="username">Carlos Javier</span>
                </div>

            </div>

        </div>
    </div>

</body>

</html>