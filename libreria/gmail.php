<?php

function numerosRandom()
{
    return rand(1, 9);
}

// Hace un arreglo de 4 números random utilizando la función de arriba
function numerosRecuperacion()
{
    $numeros = [];
    for ($iteracion = 0; $iteracion < 4; $iteracion++) {
        $numeros[] = numerosRandom();  // Almacena cada número en el array
    }
    return $numeros;
}

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpMailer/Exception.php';
require '../phpMailer/PHPMailer.php';
require '../phpMailer/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'thegoodofthewhole@gmail.com';
    $mail->Password   = 'uzgprvmqagqiriib';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;
    $mail->CharSet    = 'UTF-8';

    $mail->setFrom('thegoodofthewhole@gmail.com', 'ADMINISTRADOR');
    $mail->addAddress($_POST['txtEmailRecuperar']);

    $mail->isHTML(true);
    $mail->Subject = 'Recuperación de Contraseña';

    $numeros = numerosRecuperacion();

    $cuerpoCorreo = '
<html>
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

    // Agregamos los números al cuerpo del correo
    foreach ($numeros as $numero) {
        $cuerpoCorreo .= $numero . ' ';
    }

    $cuerpoCorreo .= '
                    </div>
                </p>
                <p style="color: #000;">Si no solicitaste este cambio, simplemente ignora este correo. Otra persona puede haber escrito tu dirección de correo electrónico por error.</p>
                <p style="color: #000;">Saludos,<br>El equipo de soporte de The God of the Whole</p>
            </div>
            <div style="text-align: center; padding-top: 20px;">
                <img src="cid:logo" class="logo" alt="Logo" style="max-width: 100%; height: auto;" />
            </div>
        </div>
    </div>
</body>
</html>
';


    $mail->Body = $cuerpoCorreo;

    // Adjunta la imagen para usarla con CID
    $mail->addEmbeddedImage('../img/logo.png', 'logo');

    $mail->send();

    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script src='../js/animaciones.js'></script>";
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            AlertaExitoCodigo().then(() => {
                window.location.href = '../codigoClave.php';
            });
        });
    </script>";
} catch (Exception $e) {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script src='../js/animaciones.js'></script>";
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            AlertaErrorCodigo().then(() => {
                window.location.href = '../recuperarClave.php';
            });
        });
    </script>";
    echo "Error de envío: {$mail->ErrorInfo}";
}
