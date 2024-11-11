<?php
session_start();

include('conexion.php');
include('classAcceso.php');

// Crear el objeto
$encapsularAcceso = new Acceso();
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
        $hashAlmacenado = $resultadoLogin[0]['clave']; // Obtener el hash almacenado en la base de datos
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
} else {
}


