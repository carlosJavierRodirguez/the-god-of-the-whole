<?php
session_start();

include('../conexion.php');
include('../classAcceso.php');

// Configurar manejo de errores
error_reporting(E_ALL);
ini_set('display_errors', 0); // No mostrar errores directamente
$logFile = '../error_log.txt';

// Función para registrar errores
function registrarError($mensaje)
{
    global $logFile;
    file_put_contents($logFile, date('Y-m-d H:i:s') . ' - ' . $mensaje . PHP_EOL, FILE_APPEND);
}

try {
    $encapsularAcceso = new Acceso();
    $conexion = new Conexion();

    $nombreInvitado = isset($_POST['txtNombreJugador']) ? htmlspecialchars(trim($_POST['txtNombreJugador'])) : null;
    $codigoSala = isset($_POST['txtCodigoSala']) ? htmlspecialchars(trim($_POST['txtCodigoSala'])) : null;

    // Validar datos recibidos
    if (!$nombreInvitado || !$codigoSala) {
        echo json_encode(['status' => 'error', 'mensaje' => 'Datos incompletos.']);
        exit();
    }

    // Encapsular los datos
    $encapsularAcceso->setCodigoSala($codigoSala);
    $codigoEncapsulado = $encapsularAcceso->getCodigoSala();

    $encapsularAcceso->setNombre($nombreInvitado);
    $nombreInvitadoEncapsulado = $encapsularAcceso->getNombre();

    // Validar si la sala existe
    $sqlValidarSala = "SELECT nombre_sala, codigo_sala FROM public.sala WHERE codigo_sala = ?";
    $valoresValidarSala = [$codigoEncapsulado];
    $resultadoValidarSala = $conexion->consultaIniciarSesion($sqlValidarSala, $valoresValidarSala);


    if (!empty($resultadoValidarSala)) {

        // Si la sala existe, insertar el invitado
        $queryInsertarInvitado = "INSERT INTO public.invitado(\"nombreInvitado\", imagen_id) VALUES (?, 1)";
        $valoresInvitado = [$nombreInvitadoEncapsulado];
        $resultadoInsertar = $conexion->consultaIniciarSesion($queryInsertarInvitado, $valoresInvitado);

        if ($resultadoInsertar) {
            // Guardar los datos en la sesión
            $_SESSION['invitadoID'] = $resultadoInsertar[0]['invitadoID'];
            $_SESSION['nombreInvitado'] = $nombreInvitadoEncapsulado;
            $_SESSION['datosSala'] = $resultadoValidarSala[0];
            echo json_encode(['status' => 'success', 'mensaje' => 'Invitado registrado correctamente.']);
            exit();
        } else {
            echo json_encode(['status' => 'error', 'mensaje' => 'Error al guardar los datos del invitado.']);
            exit();
        }
    } else {
        echo json_encode(['status' => 'error', 'mensaje' => 'El código de sala no es válido.']);
        exit();
    }
} catch (Exception $e) {
    registrarError($e->getMessage());
    echo json_encode(['status' => 'error', 'mensaje' => 'Ocurrió un error interno.']);
    exit();
}
