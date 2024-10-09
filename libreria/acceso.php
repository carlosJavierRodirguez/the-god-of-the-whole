<?php
session_start(); // Inicio de la sesión

include('conexion.php');
include('classAcceso.php'); // Incluir la clase para realizar el encapsulamiento

$encapsularAcceso = new Acceso(); // Crear el objeto
$conexion = new Conexion();

// Establecer email y clave desde el formulario
$encapsularAcceso->setEmail(trim($_POST['txtEmail'])); // Eliminar espacios
$encapsularAcceso->setClave(trim($_POST['txtClave'])); // Eliminar espacios

// Preparar los valores para la consulta
$values = array(
    ':email' => $encapsularAcceso->getEmail(),
    ':clave' => $encapsularAcceso->getClave() // Comparar directamente la clave en texto plano
);

$sqlLogin = "SELECT 
    \"nombreUsuario\",  -- Utiliza comillas dobles para los nombres de columnas si están en minúsculas
    email
FROM public.usuario  -- Asegúrate de especificar la tabla correctamente
WHERE email = :email
AND clave = :clave;";

// Ejecutar la consulta y obtener el resultado
$resultadoLogin = $conexion->consultaValor($sqlLogin, $values);

if (!empty($resultadoLogin)) {
    // Si hay un resultado, se considera que el usuario ha sido autenticado
    $usuario = $resultadoLogin[0]['nombreUsuario']; // Obtener el nombre de usuario
    $_SESSION['nombreUsuario'] = $usuario; // Guardar en la sesión
    header('Location: ../apartadoUsuario.php'); // Redirigir a la página deseada
    exit(); // Asegurarse de que el script no continúe ejecutándose después de la redirección
} else {
    // Si no se encuentra el usuario, redirigir a la página de inicio de sesión
    header('Location: ../iniciarSesion.php?error=1'); // Redirigir con un error
    exit(); // Asegurarse de que el script no continúe ejecutándose después de la redirección
}
