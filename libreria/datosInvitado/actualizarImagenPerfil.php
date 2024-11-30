<?php
session_start();
require '../conexion.php';

$conexion = new Conexion();

if (isset($_SESSION['usuarioID']) && isset($_POST['imagen_id'])) {
    $usuarioID = $_SESSION['usuarioID'];
    $imagenSeleccionada = $_POST['imagen_id'];

    // Prepara la consulta SQL para actualizar la imagen de perfil
    $sqlUpdate = 'UPDATE usuario SET imagen_perfil = :imagen_id WHERE "usuarioID" = :usuarioID';
    $valoresUpdate = [
        ':imagen_id' => $imagenSeleccionada,
        ':usuarioID' => $usuarioID,
    ];

    // Se utiliza el método ejecutar para realizar la actualización
    $filasAfectadas = $conexion->ejecutar($sqlUpdate, $valoresUpdate);

    // Si la actualización fue exitosa, obtenemos la nueva URL de la imagen
    if ($filasAfectadas > 0) {
        // Consulta para obtener la URL de la nueva imagen
        $sqlQuery = ' 
            SELECT ip.url_imagen 
            FROM usuario u
            INNER JOIN "imagenPerfil" ip ON u.imagen_perfil = ip.id_url
            WHERE u."usuarioID" = :usuarioID;
        ';
        $values = [':usuarioID' => $usuarioID];
        $nuevaImagen = $conexion->consultaIniciarSesion($sqlQuery, $values);

        if ($nuevaImagen && count($nuevaImagen) > 0) {
            $urlNuevaImagen = $nuevaImagen[0]['url_imagen'];
            echo json_encode([
                'success' => true,
                'urlNuevaImagen' => $urlNuevaImagen
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No se pudo obtener la URL de la nueva imagen.'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'No se pudo actualizar la imagen de perfil.'
        ]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos insuficientes o sesión no iniciada.']);
}
