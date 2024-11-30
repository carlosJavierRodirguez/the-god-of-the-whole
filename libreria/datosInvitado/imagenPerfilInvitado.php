<?php
session_start();
include('../libreria/conexion.php');

$conexion = new Conexion();

// Verificar si el invitadoID está definido en la sesión
if (!isset($_SESSION['invitadoID'])) {
    echo json_encode(['status' => 'error', 'mensaje' => 'ID del invitado no está definido.']);
    exit();
}

$invitadoID = $_SESSION['invitadoID'];

// Consulta para obtener la información de la imagen
$sqlQuery = ' 
SELECT i."invitadoID", i.imagen_id, ip.url_imagen, ip.nombre_imagen
FROM invitado i
INNER JOIN "imagenPerfil" ip ON i.imagen_id = ip.id_url
WHERE i."invitadoID" = ?; 
';

$values = [$invitadoID];

// Ejecutar la consulta
$resultadoImagenInvitado = $conexion->consultaIniciarSesion($sqlQuery, $values);

if (!empty($resultadoImagenInvitado)) {
    // Asignar los datos de la primera fila del resultado
    $usuarioID = $resultadoImagenInvitado[0]['invitadoID'];
    $urlImagen = $resultadoImagenInvitado[0]['url_imagen'];
    $nombreImagen = $resultadoImagenInvitado[0]['nombre_imagen'];
} else {
    // Si no hay resultados, establecer valores predeterminados
    $urlImagen = '/ruta/a/imagen/default.png';
    $nombreImagen = 'Imagen predeterminada';
}
