<?php
session_start();
require_once('../conexion.php');


$data = json_decode(file_get_contents("php://input"));

if (isset($_SESSION['usuarioID']) && isset($_POST['imagen_id'])) {
    $usuarioID = $_SESSION['usuarioID'];
    $imagenSeleccionada = $_POST['imagen_' . $idUrl];
    // Prepara la consulta SQL para actualizar la imagen de perfil
    $sql = 'UPDATE usuario SET imagen_perfil = ' . $imagenSeleccionada . 'WHERE "usuarioID" = ' . $usuarioID;

    $resultado = $conexion->$conn->prepare($sql); // Asegúrate de que $conexion->pdo sea tu conexión PDO

    // Ejecuta la consulta con los parámetros
    if ($resultado->execute()) {
        // Devuelve una respuesta JSON para indicar éxito
        echo json_encode(['status' => 'success', 'message' => 'Imagen de perfil actualizada con éxito.']);
    } else {
        // Devuelve una respuesta de error
        echo json_encode(['status' => 'error', 'message' => 'Error al actualizar la imagen de perfil.']);
    }
} else {
    // Devuelve una respuesta de error si no se recibió el valor necesario
    echo json_encode(['status' => 'error', 'message' => 'Datos insuficientes o sesión no iniciada.']);
}
