<?php
require '../conexion.php'; // Ajusta la ruta según tu estructura

header('Content-Type: application/json');

// Leer los datos recibidos
$data = json_decode(file_get_contents('php://input'), true);

// Verificar si el código fue proporcionado
if (isset($data['codigo'])) {
    $codigo = $data['codigo'];

    // Crear una instancia de la clase Conexion
    $db = new Conexion();

    // Consulta para verificar si el código ya existe
    $query = "SELECT COUNT(*) AS total FROM sala WHERE codigo_sala = :codigo";
    $valores = [':codigo' => $codigo];

    // Ejecutar la consulta
    $resultado = $db->consultaIniciarSesion($query, $valores);

    if ($resultado !== false) {
        // Retornar el resultado en formato JSON
        echo json_encode(['existe' => $resultado[0]['total'] > 0]);
    } else {
        // Error al ejecutar la consulta
        echo json_encode(['error' => 'Error al verificar el código en la base de datos']);
    }
} else {
    echo json_encode(['error' => 'No se proporcionó el código']);
}
