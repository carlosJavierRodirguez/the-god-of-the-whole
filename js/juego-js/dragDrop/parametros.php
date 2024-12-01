<?php
// Verificar y ajustar la ruta de conexión
$conexionRuta = realpath('../../../libreria/conexion.php');
if (!$conexionRuta) {
    die(json_encode(["error" => "El archivo de conexión no se encontró en la ruta esperada."]));
}
include($conexionRuta);

// Verificar si la conexión está definida
if (!isset($conexion)) {
    die(json_encode(["error" => "No se pudo establecer una conexión con la base de datos."]));
}

try {
    // 1. Consultar una pregunta aleatoria
    $queryPregunta = "
        SELECT pregunta_id, pregunta 
        FROM preguntas
        ORDER BY RANDOM()
        LIMIT 1
    ";
    $stmtPregunta = $conexion->prepare($queryPregunta);
    $stmtPregunta->execute();
    $pregunta = $stmtPregunta->fetch(PDO::FETCH_ASSOC);

    if (!$pregunta) {
        die(json_encode(["error" => "No se encontraron preguntas en la base de datos."]));
    }

    // 2. Determinar el rango de imágenes según el ID de la pregunta
    $preguntaId = $pregunta['pregunta_id'];
    $rangoInicio = 0;
    $rangoFin = 0;

    // Asignar rangos según el pregunta_id
    switch ($preguntaId) {
        case 1:
            $rangoInicio = 11;
            $rangoFin = 20;
            break;
        case 2:
            $rangoInicio = 1;
            $rangoFin = 10;
            break;
        case 3:
            $rangoInicio = 21;
            $rangoFin = 30;
            break;
        case 4:
            $rangoInicio = 11;
            $rangoFin = 16;
            break;
        case 5:
            $rangoInicio = 33;
            $rangoFin = 42;
            break;
        case 6:
            $rangoInicio = 1;
            $rangoFin = 10;
            break;
        default:
            die(json_encode(["error" => "ID de pregunta no válido."]));
    }

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
    $stmtPrincipales = $conexion->prepare($queryPrincipales);
    $stmtPrincipales->bindParam(':pregunta_id', $preguntaId, PDO::PARAM_INT);
    $stmtPrincipales->bindParam(':rango_inicio', $rangoInicio, PDO::PARAM_INT);
    $stmtPrincipales->bindParam(':rango_fin', $rangoFin, PDO::PARAM_INT);
    $stmtPrincipales->execute();
    $imagenesPrincipales = $stmtPrincipales->fetchAll(PDO::FETCH_ASSOC);

    // Verificar si se encontraron las 6 imágenes principales
    if (count($imagenesPrincipales) < 6) {
        die(json_encode(["error" => "No se encontraron suficientes imágenes principales en el rango especificado."]));
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
    $stmtAdicionales = $conexion->prepare($queryAdicionales);
    $stmtAdicionales->bindParam(':pregunta_id', $preguntaId, PDO::PARAM_INT);
    $stmtAdicionales->bindParam(':faltantes', $faltantes, PDO::PARAM_INT, PDO::PARAM_INT);
    $stmtAdicionales->execute();
    $imagenesAdicionales = $stmtAdicionales->fetchAll(PDO::FETCH_ASSOC);

    // 5. Combinar imágenes principales y adicionales
    $imagenesFinales = array_merge($imagenesPrincipales, $imagenesAdicionales);

    // 6. Convertir imágenes de binario a base64
    foreach ($imagenesFinales as &$imagen) {
        $imagen['imagen_url'] = 'data:image/png;base64,' . base64_encode($imagen['imagen_url']);
    }

    // 7. Respuesta en formato JSON
    echo json_encode([
        "pregunta_id" => $pregunta['pregunta_id'],
        "pregunta" => $pregunta['pregunta'],
        "imagenes" => $imagenesFinales
    ]);
} catch (PDOException $e) {
    die(json_encode(["error" => "Error al consultar la base de datos: " . $e->getMessage()]));
}
?>