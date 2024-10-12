<?php
include('conexion.php');

$conexion = new Conexion();

// Encriptar la contraseña
$hashedPassword = password_hash($_POST['txtClaveRegistro'], PASSWORD_DEFAULT);

$values = array(
    ':txtNombreUsuario' => $_POST['txtNombreUsuario'],
    ':txtEmailRegistro' => $_POST['txtEmailRegistro'],
    ':txtClaveRegistro' => $hashedPassword  // Usar la contraseña encriptada
);

$sqlInsertPersona = "
    INSERT INTO public.usuario
    (  
        \"nombreUsuario\",
        email,
        clave
    )
    VALUES
    (  
        :txtNombreUsuario,
        :txtEmailRegistro,
        :txtClaveRegistro
    );
";

try {
    // Ejecutar la consulta
    $resultado = $conexion->insertarDatos($sqlInsertPersona, $values);

    // Incluye SweetAlert2 y tu archivo JS personalizado
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script src='../js/animaciones.js'></script>";

    // Asegúrate de que las funciones sean llamadas después de cargar los scripts
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            if (" . ($resultado ? 'true' : 'false') . ") {
                mostrarAlertaError();  // Mostrar alerta de error y redirigir a crear cuenta
            } else {
                mostrarAlertaExito();  // Mostrar alerta de éxito y redirigir a iniciar sesión
            }
        });
    </script>";
} catch (Exception $e) {
    // Si hay un error en la consulta o en la ejecución
    echo "Error: " . $e->getMessage();
}
