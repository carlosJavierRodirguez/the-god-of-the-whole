<?php
set_time_limit(60);

include('numerosAleatorios.php');
require('../libreria/conexion.php'); // Asegúrate de la ruta correcta

// Importar PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpMailer/Exception.php';
require '../phpMailer/PHPMailer.php';
require '../phpMailer/SMTP.php';

$mail = new PHPMailer(true);

try {
    // Crear conexión a la base de datos
    $db = new Conexion(); // Instancia de la clase de conexión
    $conn = $db->conectar(); // Obtener la conexión

    // Obtener el email ingresado por el usuario
    $email = $_POST['txtEmailRecuperar'];

    // Verificar si el email existe en la base de datos
    $stmt = $conn->prepare("SELECT email FROM usuario WHERE email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    // Si el email existe, procedemos a enviar el código de verificación
    if ($stmt->rowCount() > 0) {
        // Configuración del correo electrónico
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'thegoodofthewhole@gmail.com';
        $mail->Password   = 'uzgprvmqagqiriib';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        $mail->CharSet    = 'UTF-8';

        $mail->setFrom('thegoodofthewhole@gmail.com', 'ADMINISTRADOR');
        $mail->addAddress($email); // Dirección de correo del usuario

        $mail->isHTML(true);
        $mail->Subject = 'Recuperación de Contraseña';

        $numeros = numerosRecuperacion(); // Función que genera los números aleatorios para el código

        // Cuerpo del correo
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
                        <p style="color: #000;">Si no solicitaste este cambio, simplemente ignora este correo.</p>
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

        // Adjuntar la imagen del logo
        $mail->addEmbeddedImage('../img/logo.png', 'logo');

        // Enviar el correo
        $mail->send();

        // Mostrar mensaje de éxito
        echo "
    <script src='../node_modules/sweetalert2/dist/sweetalert2.all.min.js'></script>";

        echo "<script>
    function AlertaExitoCodigo() {
        return Swal.fire({
            title: 'Éxito',
            text: 'El código de verificación ha sido enviado a tu correo.',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        AlertaExitoCodigo().then(() => {
            window.location.href = '../login/validarCodigoClave.php';
        });
    });
</script>";
    } else {
        // Si el correo no está registrado, mostrar error
        echo "
        <script src='../node_modules/sweetalert2/dist/sweetalert2.all.min.js'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Correo no registrado',
                    text: 'El correo ingresado no está en nuestra base de datos.'
                }).then(() => {
                    window.location.href = '../login/recuperarClave.php';
                });
            });
        </script>
    ";
    }
} catch (Exception $e) {
    // Mostrar error si ocurre algún problema con el correo o la conexión
    echo "
    <script src='../node_modules/sweetalert2/dist/sweetalert2.all.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Correo no registrado',
                text: 'El correo ingresado no está en nuestra base de datos.'
            }).then(() => {
                window.location.href = '../login/recuperarClave.php';
            });
        });
    </script>
";
    echo "Error de envío: {$mail->ErrorInfo}";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Capturar el código del formulario
        $codigoIngresado = implode('', $_POST['codigo']); // Combina los 4 dígitos en un solo string

        // Código original guardado en la sesión
        if (isset($_SESSION['temp_user']) && isset($_SESSION['temp_user']['codigo'])) {
            $codigoOriginal = $_SESSION['temp_user']['codigo'];

            // Validar el código
            if ($codigoIngresado === $codigoOriginal) {
                // El código es correcto
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Código Correcto',
                        text: 'El código ingresado es correcto.'
                    }).then(() => {
                        window.location.href = '../login/nuevaClave.php'; // Redirige a una página para restablecer la contraseña
                    });
                </script>";
            } else {
                // El código es incorrecto
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Código Incorrecto',
                        text: 'El código ingresado no coincide.'
                    }).then(() => {
                        window.location.href = '../login/validarCodigoClave.php'; // Redirige de nuevo a la página de verificación de código
                    });
                </script>";
            }
        } else {
            // Manejar el caso donde no existe el código en la sesión
            echo "No se encontró el código original. Redirigiendo...";
            header('Location: ../login/recuperarClave.php'); // Redirigir si no hay código
            exit();
        }
    };
}
