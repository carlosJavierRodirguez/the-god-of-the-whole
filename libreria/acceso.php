<?php
session_start(); // Inicio de la sesión

include('conexion.php');
include('classAcceso.php'); // Incluir la clase para realizar el encapsulamiento

$encapsularAcceso = new Acceso(); // Crear el objeto
$conexion = new Conexion();

// Establecer email y clave
$encapsularAcceso->setEmail($_POST['txtEmail']); // Establecer email
$encapsularAcceso->setClave($_POST['txtClave']); // Establecer clave

// Preparar los valores para la consulta
$values = array(
    ':email' => $encapsularAcceso->getEmail(),
    ':clave' => $encapsularAcceso->getClave()
);

$sqlLogin = "SELECT 
    \"nombreUsuario\",
    email,
    clave
    FROM usuario
    WHERE email = :email
    AND clave = :clave;";

// Ejecutar la consulta y obtener el resultado
$resultadoLogin = $conexion->consultaIniciarSesion($sqlLogin, $values);

if ($resultadoLogin) {
    // Si hay un resultado, se considera que el usuario ha sido autenticado
    $usuario = $resultadoLogin['nombreUsuario']; // Obtener el nombre de usuario
    $_SESSION['nombreUsuario'] = $usuario; // Guardar en la sesión
    header('Location: ../apartadoUsuario.php'); // Redirigir a la página deseada
    exit(); // Asegurarse de que el script no continúe ejecutándose después de la redirección
} else {
    // Si no se encuentra el usuario, redirigir a la página de inicio de sesión
    header('Location: ../iniciarSesion.php');
    exit(); // Asegurarse de que el script no continúe ejecutándose después de la redirección
}
