<?php
session_start();
include('../conexion.php');

$conexion = new Conexion();

if (isset($_POST['codigo']) && isset($_POST['codigo_original'])) {
    // Unir el código ingresado en un solo string
    $codigoIngresado = trim(implode('', $_POST['codigo']));
    $codigoOriginal = $_POST['codigo_original'];

    // Validar el código
    if ($codigoIngresado === $codigoOriginal) {
        // Insertar el usuario y obtener el usuarioID generado
        $queryUsuario = "INSERT INTO public.usuario (\"nombreUsuario\", email, clave, imagen_perfil) VALUES (?, ?, ?,1)";
        $usuarioID = $conexion->insertarObtenerId($queryUsuario, [
            $_SESSION['temp_user']['nombre'],
            $_SESSION['temp_user']['email'],
            $_SESSION['temp_user']['password']
        ]);

        // Verifica si se obtuvo un usuarioID válido
        if ($usuarioID) {
            // Insertar datos en la tabla 'partidas' utilizando el usuarioID
            $queryPartidas = "INSERT INTO public.partidas(\"partidasGanadas\", \"partidasPerdidas\", \"usuarioId\") VALUES (0, 0, ?)";
            $conexion->insertarObtenerId($queryPartidas, [$usuarioID]);

            // Limpiar la sesión temporal
            unset($_SESSION['temp_user']);

            // Mostrar la alerta de éxito
            echo "
            <script src='../../node_modules/sweetalert2/dist/sweetalert2.all.min.js'></script>
            <script>
            window.onload = function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Registro Verificado',
                    text: 'Tu cuenta ha sido verificada exitosamente.'
                }).then(() => {
                    window.location = '../../login/iniciarSesion.php';
                });
            };
            </script>";
            exit;
        } else {
            echo "
     <script src='../../node_modules/sweetalert2/dist/sweetalert2.all.min.js'></script>
        <script>
        window.onload = function() {
            Swal.fire({
                icon: 'error',
                title: 'Código incorrecto',
                text: 'El código de verificación ingresado es incorrecto.'
            }).then(() => {
                window.location = '../../login/validarCodigo.php';
            });
        };
        </script>";
            exit;
        }
    }
}
