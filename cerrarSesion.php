<?php
session_start(); // Iniciar la sesión
session_unset(); // Liberar todas las variables de sesión
session_destroy(); // Destruir la sesión

header('Location: iniciarSesion.php'); // Redirigir a la página de inicio de sesión
exit(); // Asegurarse de que el script no continúe ejecutándose después de la redirección
?>
