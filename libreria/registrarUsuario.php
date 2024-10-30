<?php
set_time_limit(60);

//cargar archivos
include('excepcionesPhpMailer/phpmailer.lang-es.php');


session_start();

// Importar las clases de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



// Función para generar código de verificación
function generarCodigo()
{
    return rand(1000, 9999);
}



// Función para enviar correo de verificación
function enviarCorreoVerificacion($email, $codigo)
{
    include('classAcceso.php');
    require '../phpMailer/Exception.php';
    require '../phpMailer/PHPMailer.php';
    require '../phpMailer/SMTP.php';

    // crear objetos
    $encapsularEmail = new Acceso();
    
    // establecer datos
    $encapsularEmail->setEmail('thegoodofthewhole@gmail.com');
    $encapsularEmail->setClave('uzgprvmqagqiriib');

    // obtener los datos
    $correo_admin = $encapsularEmail->getEmail();
    $correo_password = $encapsularEmail->getClave();
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $correo_admin;
        $mail->Password   = $correo_password;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        $mail->CharSet    = 'UTF-8';

        $mail->setFrom($correo_admin, 'ADMINISTRADOR');
        $mail->addAddress($email);
        $mail->Subject = 'Código de Verificación de Registro';
        $mail->isHTML(true);
        $mail->Body = '
        <html>
        <body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f0f0f0;">
            <div style="max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background-color: #ffffff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                <h2 style="text-align: left; color: #333;">Código de Verificación</h2>
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <div>
                        <p style="color: #333;">Hola,</p>
                        <p style="color: #555;">Gracias por registrarte en <strong>The God of the Whole</strong>. Para completar tu registro, por favor utiliza el siguiente código de verificación:</p>
                        <p style="text-align: center;">
                            <div style="text-align: center; font-size: 40px; line-height: 1.5; word-wrap: break-word; width: 100%;" id="numeros">
                                ' . $codigo . '
                            </div>
                        </p>
                        <p style="color: #555;">Si no solicitaste este registro, puedes ignorar este correo.</p>
                        <p style="color: #555;">Saludos,<br>El equipo de soporte de <strong>The God of the Whole</strong></p>
                    </div>
                    <div style="text-align: center; padding-top: 20px;">
                        <img src="cid:logo" class="logo" alt="Logo" style="max-width: 100%; height: auto;" />
                    </div>
                </div>
            </div>
        </body>
        </html>
        ';

        $mail->addEmbeddedImage('../img/logo.png', 'logo');
        return $mail->send();
    } catch (Exception $e) {
        // Manejar error al enviar el correo
        echo 'Error al enviar el correo: ' . $mail->ErrorInfo;
        return false;
    }
}

// Proceso de registro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['txtNombreUsuario'], $_POST['txtEmailRegistro'], $_POST['txtClaveRegistro'])) {
        $nombre = htmlspecialchars(trim($_POST['txtNombreUsuario']));
        $email = filter_var(trim($_POST['txtEmailRegistro']), FILTER_VALIDATE_EMAIL);
        $password = password_hash($_POST['txtClaveRegistro'], PASSWORD_DEFAULT);

        if (!$email) {
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
            window.onload = function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Dirección de correo electrónico no válida.'
                });
            };
            </script>";
            exit;
        }

        $codigo = generarCodigo();

        // Guardar temporalmente los datos y el código
        $_SESSION['temp_user'] = [
            'nombre' => $nombre,
            'email' => $email,
            'password' => $password,
            'codigo' => $codigo
        ];

        if (enviarCorreoVerificacion($email, $codigo)) {
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
            window.onload = function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Código de Verificación Enviado',
                    text: 'Se ha enviado un código de verificación a tu correo electrónico.'
                }).then(() => {
                    window.location = '../login/validarCodigo.php';
                });
            };
            </script>";
            exit;
        } else {
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
            window.onload = function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un error al enviar el correo de verificación.'
                });
            };
            </script>";
            exit;
        }
    } else {
    }
}
