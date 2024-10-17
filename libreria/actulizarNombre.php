<?php
session_start();
require 'conexion.php'; 

$data = json_decode(file_get_contents("php://input"));

if (isset($data->usuarioID) && isset($data->nuevoNombre)) {
    $usuarioID = $data->usuarioID;
    $nuevoNombre = $data->nuevoNombre;

    // Actualizar el nombre en la base de datos
    $stmt = $conn->prepare("UPDATE usuario SET nombreUsuario = :nuevoNombre WHERE usuarioID = :usuarioID");
    $stmt->bindParam(':nuevoNombre', $nuevoNombre);
    $stmt->bindParam(':usuarioID', $usuarioID);

    if ($stmt->execute()) {
        // Opcional: Actualizar la sesión si es necesario
        $_SESSION['nombreUsuario'] = $nuevoNombre;

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se pudo actualizar el nombre.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
}
