<?php
session_start(); // Inicio de la sesión

include('conexion.php');
include('classAcceso.php'); // Incluir la clase para realizar el encapsulamiento

$encapsularAcceso = new Acceso(); // Crear el objeto
$conexion = new Conexion();

// Verificar si se está intentando iniciar sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['txtEmail']) && isset($_POST['txtClave'])) {
    // Establecer email y clave desde el formulario
    $encapsularAcceso->setEmail(trim($_POST['txtEmail'])); // Eliminar espacios
    $encapsularAcceso->setClave(trim($_POST['txtClave'])); // Eliminar espacios

    // Preparar los valores para la consulta
    $values = array(
        ':email' => $encapsularAcceso->getEmail(),
        ':clave' => $encapsularAcceso->getClave() // Comparar directamente la clave en texto plano
    );

    $sqlLogin = "SELECT 
        \"usuarioID\", 
        \"nombreUsuario\"  -- Incluye usuarioID para usarlo después
    FROM public.usuario  -- Asegúrate de especificar la tabla correctamente
    WHERE email = :email
    AND clave = :clave;";

    // Ejecutar la consulta y obtener el resultado
    $resultadoLogin = $conexion->consultaValor($sqlLogin, $values);

    if (!empty($resultadoLogin)) {
        // Si hay un resultado, se considera que el usuario ha sido autenticado
        $usuario = $resultadoLogin[0]['nombreUsuario']; // Obtener el nombre de usuario
        $usuarioID = $resultadoLogin[0]['usuarioID']; // Obtener el ID del usuario
        $_SESSION['nombreUsuario'] = $usuario; // Guardar en la sesión
        $_SESSION['usuarioID'] = $usuarioID; // Guardar el ID del usuario en la sesión
        header('Location: ../apartadoUsuario.php'); // Redirigir a la página deseada
        exit(); // Asegurarse de que el script no continúe ejecutándose después de la redirección
    } else {
        // Si no se encuentra el usuario, redirigir a la página de inicio de sesión
        header('Location: ../iniciarSesion.php?error=1'); // Redirigir con un error
        exit(); // Asegurarse de que el script no continúe ejecutándose después de la redirección
    }
}

// Manejar la actualización del nombre del usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'actualizarNombre') {
    $nuevoNombre = trim($_POST['nuevoNombre']);
    $usuarioID = $_SESSION['usuarioID']; // Obtener usuarioID de la sesión

    // Validar que el usuario está autenticado
    if (isset($usuarioID)) {
        // Preparar la consulta de actualización
        $sqlActualizar = "UPDATE public.usuario SET \"nombreUsuario\" = :nuevoNombre WHERE \"usuarioID\" = :usuarioID";
        
        // Ejecutar la consulta
        $resultado = $conexion->ejecutar($sqlActualizar, ['nuevoNombre' => $nuevoNombre, 'usuarioID' => $usuarioID]);

        // Verificar si la actualización fue exitosa
        if ($resultado) {
            // Actualizar el nombre en la sesión
            $_SESSION['nombreUsuario'] = $nuevoNombre;

            // Retornar respuesta JSON
            echo json_encode(['success' => true]);
        } else {
            // Retornar error si no se actualizó
            echo json_encode(['success' => false, 'message' => 'No se pudo actualizar el nombre']);
        }
        exit();
    } else {
        // Usuario no autenticado
        echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
        exit();
    }
}


