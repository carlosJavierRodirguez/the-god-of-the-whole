<?php
session_start();
include('../conexion.php');
$conexion = new Conexion();

header('Content-Type: application/json'); // Asegura que la respuesta sea interpretada como JSON
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');

try {
    // Valida la sesión
    if (!isset($_SESSION['idInvitado']) || !isset($_SESSION['nombreInvitado'])) {
        echo json_encode(['error' => 'Sesión no válida o no inicializada']);
        exit;
    }

    $id_invitado = intval($_SESSION['idInvitado']);
    $nombreInvitado = $_SESSION['nombreInvitado'];

    if ($id_invitado <= 0) {
        echo json_encode(['error' => 'ID de invitado no válido']);
        exit;
    }

    // Consulta SQL para obtener la URL de la imagen
    $sqlImagenInvitado = '
    SELECT ip.url_imagen, ip.nombre_imagen
    FROM invitado i
    INNER JOIN "imagenPerfil" ip ON i.imagen_id = ip.id_url
    WHERE i.id_invitado = ?;
    ';
    $valoresImagenInvitado = [$id_invitado];
    $resultadoImagenInvitado = $conexion->consultaIniciarSesion($sqlImagenInvitado, $valoresImagenInvitado);

    // Verifica si se encontró una URL
    if ($resultadoImagenInvitado && count($resultadoImagenInvitado) > 0) {
        echo json_encode([
            'url_imagen' => $resultadoImagenInvitado[0]['url_imagen'],
            'nombre_imagen' => $resultadoImagenInvitado[0]['nombre_imagen'],
            'nombre_invitado' => $nombreInvitado
        ]);
    } else {
        echo json_encode(['error' => 'No se encontró el invitado o imagen']);
    }
} catch (PDOException $e) {
    error_log("Error en la base de datos: " . $e->getMessage());
    echo json_encode(['error' => 'Error en la base de datos.']);
}
