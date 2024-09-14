<?php
include('conexion2.php');

$conexion = new conexion();

$values = array(
    ':txtNombreUsuario' => $_POST['txtNombreUsuario'],
    ':txtEmailRegistro' => $_POST['txtEmailRegistro'],
    ':txtClaveRegistro' => $_POST['txtClaveRegistro']
);

$sqlInsertPersona = "INSERT INTO `juego`.`usuario`
(
`nombreUsuario`,
`email`,
`clave`)
VALUES
(
    :txtNombreUsuario,
    :txtEmailRegistro,
    :txtClaveRegistro);";

try {
    // Ejecutar la consulta
    $resultado = $conexion->ejecutar($sqlInsertPersona, $values);

    // Incluye SweetAlert2 y tu archivo JS personalizado
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script src='../js/animaciones.js'></script>";

    // Asegúrate de que las funciones sean llamadas después de cargar los scripts
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            if (" . ($resultado ? 'true' : 'false') . ") {
                mostrarAlertaError();
            } else {
               
             mostrarAlertaExito();
            }
        });
    </script>";
} catch (Exception $e) {
    // Si hay un error en la consulta o en la ejecución
    echo "Error: " . $e->getMessage();
}
