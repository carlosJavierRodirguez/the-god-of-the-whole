<?php
include('conexion.php');
include('classAcceso.php');

session_start();
$clave = new Acceso();
$conexion = new Conexion();

$clave->setClave($_POST['txtClaveNueva']);
$clave->setClaveConfirmada($_POST['txtConfirmarClave']);
$clave->setEmail($_SESSION['email_recuperacion']);

if ($clave->getClave() === $clave->getClaveConfirmada()) {
    $hashedClave = password_hash($clave->getClave(), PASSWORD_DEFAULT);
    $_SESSION['clave'] = $clave->getClave();

    // Obtiene el ID del usuario basado en el email
    $sql = "SELECT \"usuarioID\" FROM usuario WHERE email = :email"; 
    $values = [':email' => $clave->getEmail()];
    $resultado = $conexion->consultaIniciarSesion($sql, $values);

    // Verificar que se haya obtenido un ID
    if (!empty($resultado)) {
        $usuarioID = $resultado[0]['usuarioID']; 

        // Actualiza la contraseña
        $sql = "UPDATE usuario SET clave = :clave WHERE \"usuarioID\" = :id"; 
        $values = [
            ':clave' => $hashedClave,
            ':id' => $usuarioID // Usar el ID obtenido
        ];
        $cambioClave = $conexion->ejecutar($sql, $values);

        if ($cambioClave > 0) {
            echo "Clave guardada correctamente";
            header('Location: ../login/iniciarSesion.php');
            exit();
        } else {
            echo "Error al guardar la clave";
        }
    } else {
    }
} else {
    echo "Las contraseñas no coinciden. Intenta nuevamente.";
    header('Location: ../login/nuevaClave.php');
}
