<?php
session_start();
require_once('../conexion.php');

$conexion = new Conexion();

if (isset($_SESSION['usuarioID']) && isset($_POST['imagen_id'])) {
    $usuarioID = $_SESSION['usuarioID'];
    $imagenSeleccionada = $_POST['imagen_id'];

    // Prepara la consulta SQL para actualizar la imagen de perfil
    $sql = 'UPDATE usuario SET imagen_perfil = :imagen_id WHERE "usuarioID" = :usuarioID';
    $valores = [
        ':imagen_id' => $imagenSeleccionada,
        ':usuarioID' => $usuarioID,
    ];

    // se utiliza el método ejecutar para realizar la actualización
    $filasAfectadas = $conexion->ejecutar($sql, $valores);
    echo json_encode([
        'success' => true
    ]);
} else {
    // Devuelve una respuesta de error si no se recibió el valor necesario
    echo json_encode(['status' => 'error', 'message' => 'Datos insuficientes o sesión no iniciada.']);
}
