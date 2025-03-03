<?php
include('../../../libreria/conexion.php');
$conexion = new Conexion();

try {
    // Consultar una pregunta aleatoria
    $queryPregunta = "
        SELECT pregunta_id, pregunta 
        FROM preguntas
        ORDER BY RANDOM()
        LIMIT 1
    ";
    $preguntaResult = $conexion->consultaIniciarSesion($queryPregunta, []);

    if (!$preguntaResult || empty($preguntaResult)) {
        die(json_encode(["error" => "No se encontraron preguntas en la base de datos."]));
    }

    $pregunta = $preguntaResult[0];
    $preguntaId = $pregunta['pregunta_id'];

    // Determinar el rango de imágenes según el ID de la pregunta
    $rangoMap = [
        1 => [11, 20],
        2 => [1, 10],
        3 => [21, 30],
        4 => [11, 20],
        5 => [31, 40],
        6 => [1, 10],
    ];

    if (!isset($rangoMap[$preguntaId])) {
        die(json_encode(["error" => "ID de pregunta no válido."]));
    }

    [$rangoInicio, $rangoFin] = $rangoMap[$preguntaId];

    // Consultar 6 imágenes principales del rango
    $queryPrincipales = "
        SELECT iu.imagen_id, iu.nombre, iu.imagen_url
        FROM imagen_url iu
        INNER JOIN imagen_pregunta ip ON iu.imagen_id = ip.imagen_id
        WHERE ip.pregunta_id = :pregunta_id
        AND iu.imagen_id BETWEEN :rango_inicio AND :rango_fin
        ORDER BY RANDOM()
        LIMIT 6
    ";
    $imagenesPrincipales = $conexion->consultaIniciarSesion($queryPrincipales, [
        ':pregunta_id' => $preguntaId,
        ':rango_inicio' => $rangoInicio,
        ':rango_fin' => $rangoFin
    ]);

    if (!$imagenesPrincipales || count($imagenesPrincipales) < 6) {
        die(json_encode([
            "error" => "No se encontraron suficientes imágenes principales en el rango especificado.",
            "encontradas" => count($imagenesPrincipales),
            "rango" => [$rangoInicio, $rangoFin],
            "pregunta_id" => $preguntaId
        ]));
    }

    // Consultar imágenes adicionales para completar 10
    $queryAdicionales = "
        SELECT iu.imagen_id, iu.nombre, iu.imagen_url
        FROM imagen_url iu
        WHERE iu.imagen_id NOT IN (
            SELECT ip.imagen_id
            FROM imagen_pregunta ip
            WHERE ip.pregunta_id = :pregunta_id
        )
        ORDER BY RANDOM()
        LIMIT :faltantes
    ";
    $faltantes = 10 - count($imagenesPrincipales);
    $imagenesAdicionales = $conexion->consultaIniciarSesion($queryAdicionales, [
        ':pregunta_id' => $preguntaId,
        ':faltantes' => $faltantes
    ]);

    $imagenesFinales = array_merge($imagenesPrincipales, $imagenesAdicionales);

    // Respuesta en formato JSON
    echo json_encode([
        "pregunta_id" => $preguntaId,
        "pregunta" => $pregunta['pregunta'],
        "imagenes" => $imagenesFinales
    ]);
} catch (PDOException $e) {
    die(json_encode(["error" => "Error al consultar la base de datos: " . $e->getMessage()]));
}