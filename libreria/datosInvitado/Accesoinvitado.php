<?php
session_start();
include('../conexion.php');

header('Content-Type: application/json');

try {
    $conexion = new Conexion();

    // Validar y sanitizar los datos recibidos
    $nombreInvitado = htmlspecialchars(trim($_POST['txtNombreJugador'] ?? ''));
    $codigoSala = htmlspecialchars(trim($_POST['txtCodigoSala'] ?? ''));

    if (empty($nombreInvitado) || empty($codigoSala)) {
        echo json_encode(['status' => 'error', 'mensaje' => 'Datos incompletos.']);
        exit;
    }

    // Validar si la sala existe
    $sqlValidarSala = "SELECT sala_id, nombre_sala FROM sala WHERE codigo_sala = ?";
    $resultado = $conexion->consultaIniciarSesion($sqlValidarSala, [$codigoSala]);

    if ($resultado) {
        // Configurar sesión del invitado
        $_SESSION['nombreInvitado'] = $nombreInvitado;
        $_SESSION['datosSala'] = [
            'nombre_sala' => $resultado[0]['nombre_sala'],
            'codigo_sala' => $codigoSala,
        ];

        echo json_encode(['status' => 'success', 'mensaje' => 'Validación completada.']);
    } else {
        echo json_encode(['status' => 'error', 'mensaje' => 'La sala no existe.']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'mensaje' => 'Error interno.']);
}
