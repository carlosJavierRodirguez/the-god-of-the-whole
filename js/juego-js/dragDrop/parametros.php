<?php
include('../../../libreria/conexion.php');
$conexion = new Conexion();

try {
    // 1. Consultar una pregunta aleatoria
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

    // 2. Determinar el rango de imágenes según el ID de la pregunta
    $rangoMap = [
        1 => [11, 20],
        2 => [1, 10],
        3 => [21, 30],
        4 => [11, 16],
        5 => [33, 42],
        6 => [1, 10],
    ];

    if (!isset($rangoMap[$preguntaId])) {
        die(json_encode(["error" => "ID de pregunta no válido."]));
    }

    [$rangoInicio, $rangoFin] = $rangoMap[$preguntaId];

    // 3. Consultar 6 imágenes principales del rango
    $queryPrincipales = "
        SELECT ib.imagen_id, ib.nombre, ib.imagen_url
        FROM imagen_binarios ib
        INNER JOIN imagen_pregunta ip ON ib.imagen_id = ip.imagen_id
        WHERE ip.pregunta_id = :pregunta_id
        AND ib.imagen_id BETWEEN :rango_inicio AND :rango_fin
        ORDER BY RANDOM()
        LIMIT 6
    ";
    $imagenesPrincipales = $conexion->consultaIniciarSesion($queryPrincipales, [
        ':pregunta_id' => $preguntaId,
        ':rango_inicio' => $rangoInicio,
        ':rango_fin' => $rangoFin
    ]);

    // Depuración: Verificar imágenes principales encontradas
    if (!$imagenesPrincipales || count($imagenesPrincipales) < 6) {
        die(json_encode([
            "error" => "No se encontraron suficientes imágenes principales en el rango especificado.",
            "encontradas" => count($imagenesPrincipales),
            "rango" => [$rangoInicio, $rangoFin],
            "pregunta_id" => $preguntaId,
            "consulta" => $queryPrincipales // Mostrar la consulta para depurar
        ]));
    }

    // 4. Consultar imágenes adicionales para completar 10
    $queryAdicionales = "
        SELECT ib.imagen_id, ib.nombre, ib.imagen_url
        FROM imagen_binarios ib
        WHERE ib.imagen_id NOT IN (
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

    // 5. Combinar imágenes principales y adicionales
    $imagenesFinales = array_merge($imagenesPrincipales, $imagenesAdicionales);

    // 6. Convertir imágenes de binario a base64
    foreach ($imagenesFinales as &$imagen) {
        $imagen['imagen_url'] = 'data:image/png;base64,' . base64_encode($imagen['imagen_url']);
    }

    // 7. Respuesta en formato JSON
    echo json_encode([
        "pregunta_id" => $preguntaId,
        "pregunta" => $pregunta['pregunta'],
        "imagenes" => $imagenesFinales
    ]);
} catch (PDOException $e) {
    die(json_encode(["error" => "Error al consultar la base de datos: " . $e->getMessage()]));
}