<?php
session_start();
require '../conexion.php';
$conexion = new Conexion();
// Manejar la actualización del nombre del usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'actualizarNombre') {
    $nuevoNombre = trim($_POST['nuevoNombre']);
    $usuarioID = $_SESSION['usuarioID']; // Obtener usuarioID de la sesión

    // Validar que el usuario está autenticado
    if (isset($usuarioID)) {
        try {
            // Preparar la consulta de actualización
            $sqlActualizar = "UPDATE public.usuario SET \"nombreUsuario\" = :nuevoNombre WHERE \"usuarioID\" = :usuarioID";

            // Ejecutar la consulta
            $resultado = $conexion->ejecutar($sqlActualizar, ['nuevoNombre' => $nuevoNombre, 'usuarioID' => $usuarioID]);

            // Verificar si la actualización fue exitosa
            if ($resultado) {
                // Actualizar el nombre en la sesión
                $_SESSION['nombreUsuario'] = $nuevoNombre;

                // Retornar respuesta JSON
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'No se pudo actualizar el nombre']);
            }
        } catch (\PDOException $e) {
            // Verificar si el error es de llave duplicada
            if ($e->getCode() == '23505') {
                echo json_encode(['success' => false, 'message' => 'El nombre de usuario ya existe.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
            }
        }
    } else {
        // Usuario no autenticado
        echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
    }
} else {
    // Respuesta para solicitudes que no cumplan las condiciones
    echo json_encode(['success' => false, 'message' => 'Acción no permitida']);
}
