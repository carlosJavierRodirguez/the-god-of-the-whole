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
            echo "    <script src='../node_modules/sweetalert2/dist/sweetalert2.all.min.js'></script>
        <script src='../js/alertas/mostrarAlertas.js'></script>
          <script>
                window.addEventListener('DOMContentLoaded', function() {
                    mostrarAlerta('success','Exito','Clave guardada correctamente','../login/iniciarSesion.php');
                });
            </script>";

            exit();
        } else {
            echo "
             <script src='../node_modules/sweetalert2/dist/sweetalert2.all.min.js'></script>
        <script src='../js/alertas/mostrarAlertas.js'></script>
          <script>
                window.addEventListener('DOMContentLoaded', function() {
                    mostrarAlerta('error','Error','Error al guardar la clave');
                });
            </script>
            ";
        }
    } else {
    }
} else {
    echo "   <script src='../node_modules/sweetalert2/dist/sweetalert2.all.min.js'></script>
        <script src='../js/alertas/mostrarAlertas.js'></script>
          <script>
                window.addEventListener('DOMContentLoaded', function() {
                    mostrarAlerta('error','Error','Error las claves no coinciden');
                });
            </script>";
}
