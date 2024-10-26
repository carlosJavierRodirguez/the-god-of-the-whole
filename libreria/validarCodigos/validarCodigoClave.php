<?php
session_start(); // Iniciar la sesión

// Validar el código ingresado por el usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el código original de la sesión
    $codigoOriginal = isset($_SESSION['codigo_original']) ? $_SESSION['codigo_original'] : '';

    // Unir el código ingresado en un solo string
    $codigoIngresado = trim(implode('', $_POST['codigo']));

    // Comparar el código ingresado con el original
    if ($codigoIngresado === $codigoOriginal) {
        // Código válido
        echo "
<script src='../../node_modules/sweetalert2/dist/sweetalert2.all.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Éxito',
            text: 'El código ha sido validado correctamente.',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            // Redirigir a otra página si es necesario
            window.location.href = '../../login/nuevaClave.php'; // Cambia esta URL según sea necesario
        });
    });
</script>";
    } else {
        // Código inválido
        // Código inválido
        echo "
<script src='../../node_modules/sweetalert2/dist/sweetalert2.all.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Error',
            text: 'El código ingresado es incorrecto. Por favor, intenta de nuevo.',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            // Redirigir a la misma página o a otra según sea necesario
            window.location.href = '../../login/validarCodigo.php';
        });
    });
</script>";
    }
}
