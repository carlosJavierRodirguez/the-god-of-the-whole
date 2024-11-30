<?php
// Incluir la clase Conexion
include('../conexion.php');

// Crear una instancia de la clase Conexion
$conexion = new Conexion();

// Obtener la conexión de la clase
$db = $conexion->conectar(); // Esto te devuelve el objeto PDO

// Verifica si la conexión fue exitosa
if (!$db) {
    die("Error en la conexión a la base de datos");
}

// Verifica si se ha cargado un archivo
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    // Obtener el contenido binario del archivo
    $imagen = file_get_contents($_FILES['imagen']['tmp_name']); // Cargar la imagen en binario
    $nombre_imagen = $_FILES['imagen']['name']; // Obtener el nombre del archivo

    // Verificar que el archivo sea una imagen válida
    $fileType = mime_content_type($_FILES['imagen']['tmp_name']);
    if (strpos($fileType, 'image') === false) {
        echo "El archivo no es una imagen válida.";
        exit;
    }

    // Preparar la consulta SQL para insertar la imagen en la base de datos
    $query = "INSERT INTO imagen_binarios (nombre, imagen_url) VALUES (:nombre, :imagen_url)";
    $stmt = $db->prepare($query);

    // Ejecutar la consulta con los valores
    try {
        // Usamos PDO::PARAM_LOB para asegurarnos de que los datos sean tratados como binariosss
        $stmt->bindParam(':nombre', $nombre_imagen, PDO::PARAM_STR);
        $stmt->bindParam(':imagen_url', $imagen, PDO::PARAM_LOB); // Especificamos que el campo es binario (LOB)

        // Ejecutar la consulta
        $stmt->execute();

        echo "Imagen cargada con éxito en la tabla 'imagen_url'.";
    } catch (PDOException $e) {
        // Mostrar el error si ocurre
        echo "Error al cargar la imagen: " . $e->getMessage();
    }
} else {
    // Si no hay archivo o ocurrió un error, mostrar un mensaje
    echo "Error al cargar la imagen. Por favor, intente de nuevo.";
}
?>