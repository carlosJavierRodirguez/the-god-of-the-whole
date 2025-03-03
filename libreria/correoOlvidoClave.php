<?php
set_time_limit(60);
session_start();

include('excepciones/phpmailer.lang-es.php');
include('classAcceso.php');
require '../phpMailer/Exception.php';
require '../phpMailer/PHPMailer.php';
require '../phpMailer/SMTP.php';
include('numerosAleatorios.php');
require('conexion.php');


// Importar PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// crear objetos
$conexion = new Conexion();
$encapsularEmail = new Acceso();

// establecer datos
$encapsularEmail->setEmail('thegoodofthewhole@gmail.com');
$encapsularEmail->setClave('uzgprvmqagqiriib');

// obtener los datos
$correo_admin = $encapsularEmail->getEmail();
$correo_password = $encapsularEmail->getClave();

$mail = new PHPMailer(true);

try {

    $encapsularEmail->setEmail($_POST['txtEmailRecuperar']);
    // Verificar si el email existe en la base de datos
    $values = array(':email' => $encapsularEmail->getEmail());
    $query = "SELECT email FROM usuario WHERE email = :email;";
    $resultado = $conexion->consultaIniciarSesion($query, $values);

    // Si el email existe, procedemos a enviar el código de verificación
    if (!empty($resultado)) {

        // Guardar el email en una variable de sesión
        $_SESSION['email_recuperacion'] = $encapsularEmail->getEmail();
        // Configuración del correo electrónico
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $correo_admin;
        $mail->Password   = $correo_password;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        $mail->CharSet    = 'UTF-8';

        $mail->setFrom($correo_admin, 'ADMINISTRADOR');
        $mail->addAddress($encapsularEmail->getEmail());
        $mail->isHTML(true);
        $mail->Subject = 'Recuperación de Contraseña';

        $numeros = numerosRecuperacion(); // Generar números aleatorios para el código
        $_SESSION['codigo_original'] = implode('', $numeros);

        // Cuerpo del correo
        $cuerpoCorreo = ' <html>
        <body style="margin: 0; padding: 0; font-family: Arial, sans-serif;">
            <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;">
                <h2 style="text-align: left; color: #333;">Recuperación de Contraseña</h2>
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <div>
                        <p style="color: #000;">Hola,</p>
                        <p style="color: #000;">Hemos recibido una solicitud para restablecer la contraseña de tu cuenta.</p>
                        <p style="color: #000;">Tu código de restablecimiento de contraseña es:</p>
                        <p style="text-align: center;">
                            <div style="text-align: center; font-size: 40px; line-height: 1.5; word-wrap: break-word; width: 100%;" id="numeros">';

        foreach ($numeros as $numero) {
            $cuerpoCorreo .= $numero . ' ';
        }

        $cuerpoCorreo .= '
                            </div>
                        </p>
                        <p style="color: #000;">Si no solicitaste este cambio, simplemente ignora este correo.</p>
                        <p style="color: #000;">Saludos,<br>El equipo de soporte de The God of the Whole</p>
                    </div>
                    <div style="text-align: center; padding-top: 20px;">
                        <img src="cid:logo" class="logo" alt="Logo" style="max-width: 100%; height: auto;" />
                    </div>
                </div>
            </div>
        </body>
        </html>'; // El cuerpo del correo sigue igual

        $mail->Body = $cuerpoCorreo;
        $mail->addEmbeddedImage('../img/logo.png', 'logo');
        $mail->send();

        // Redireccionar después de mostrar el mensaje de éxito
        echo "
        <script src='../node_modules/sweetalert2/dist/sweetalert2.all.min.js'></script>
        <script src='../js/alertas/mostrarAlertas.js'></script>
          <script>
                window.addEventListener('DOMContentLoaded', function() {
                    mostrarAlerta('success','Éxito','El código de verificación ha sido enviado a tu correo.','../login/validarCodigoClave.php');
                });
            </script>";
    } else {
        // Si el correo no está registrado, mostrar error
        echo "
        <script src='../node_modules/sweetalert2/dist/sweetalert2.all.min.js'></script>
        <script src='../js/alertas/mostrarAlertas.js'></script>
          <script>
             window.addEventListener('DOMContentLoaded', function() {
                mostrarAlerta('error','Correo no registrado','El correo ingresado no está en nuestra base de datos.','../login/recuperarClave.php');
            });
            </script>";
    }
} catch (Exception $e) {
    // Mostrar error si ocurre algún problema con el correo o la conexión
    echo "
    <script src='../node_modules/sweetalert2/dist/sweetalert2.all.min.js'></script>
    <script src='../js/alertas/mostrarAlertas.js'></script>
     <script>
             window.addEventListener('DOMContentLoaded', function() {
                mostrarAlerta('error','Error en el envío','No se pudo enviar el correo: {$mail->ErrorInfo}','../login/recuperarClave.php');
            });
            </script>";
}
