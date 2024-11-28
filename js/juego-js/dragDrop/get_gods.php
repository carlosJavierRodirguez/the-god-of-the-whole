<?php
// Incluir la conexión a la base de datos
include 'conexion.php';

// Consulta para obtener las imágenes
$query = "SELECT id, titanes_url FROM imagenes_titanes";
$result = $conexion->query($query);

if ($result->num_rows > 0) {
    $gods = [];

    while ($row = $result->fetch_assoc()) {
        $gods[] = [
            "id" => $row['id'],
            "image" => $row['titanes_url'] // Enviamos el bytea como está
        ];
    }

    echo json_encode($gods); // Convertimos los datos a JSON
} else {
    echo json_encode([]);
}
?>