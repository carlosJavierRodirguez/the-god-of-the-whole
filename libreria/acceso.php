<?php
session_start();

include('conexion.php');
include('classAcceso.php');

$encapsularAcceso = new Acceso(); // Crear el objeto
$conexion = new Conexion();

// Verificar si se está intentando iniciar sesión

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['txtEmail']) && isset($_POST['txtClave'])) {
    // Establecer email y clave desde el formulario
    $encapsularAcceso->setEmail(trim($_POST['txtEmail'])); // Eliminar espacios
    $encapsularAcceso->setClave(trim($_POST['txtClave'])); // Eliminar espacios

    // Preparar los valores para la consulta
    $values = array(
        ':email' => $encapsularAcceso->getEmail()
    );

    $sqlLogin = "SELECT 
        \"usuarioID\", 
        \"nombreUsuario\", 
        clave -- Obtener el hash de la clave almacenada
    FROM public.usuario  
    WHERE email = :email;";

    // Ejecutar la consulta y obtener el resultado
    $resultadoLogin = $conexion->consultaIniciarSesion($sqlLogin, $values);

    if (!empty($resultadoLogin)) {
        $hashAlmacenado = $resultadoLogin[0]['clave']; // Obtener el hash almacenado en la BD
        $usuario = $resultadoLogin[0]['nombreUsuario']; // Obtener el nombre de usuario
        $usuarioID = $resultadoLogin[0]['usuarioID']; // Obtener el ID del usuario

        // Verificar la contraseña ingresada contra el hash almacenado
        if (password_verify($encapsularAcceso->getClave(), $hashAlmacenado)) {
            // Si la verificación es exitosa, autenticar al usuario
            $_SESSION['nombreUsuario'] = $usuario;
            $_SESSION['usuarioID'] = $usuarioID;
            header('Location: ../usuario/apartadoUsuario.php');
            exit();
        } else {
            // Contraseña incorrecta
            header('Location: ../login/iniciarSesion.php?error=1');
            exit();
        }
    } else {
        // No se encontró el email
        header('Location: ../login/iniciarSesion.php?error=1');
        exit();
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
