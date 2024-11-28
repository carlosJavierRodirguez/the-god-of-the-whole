<?php
session_start();  // Inicia la sesión

include('../conexion.php');
include('../classAcceso.php');

$encapsularAcceso = new Acceso();
$conexion = new Conexion();

$nombreInvitado = isset($_POST['txtNombreJugador']) ? htmlspecialchars(trim($_POST['txtNombreJugador'])) : null;
$codigoSala = isset($_POST['txtCodigoSala']) ? htmlspecialchars(trim($_POST['txtCodigoSala'])) : null;

// Se establece el código de sala
$encapsularAcceso->setCodigoSala($codigoSala);
$codigoEncapsulado = $encapsularAcceso->getCodigoSala();

//encapsular nombre de invitado
$encapsularAcceso->setNombre($nombreInvitado);
$nombreInvitadoEncapsulado = $encapsularAcceso->getNombre();

$response = [];

if ($nombreInvitadoEncapsulado && $codigoEncapsulado) {


    // Insertar el jugador en la base de datos
    $query = "INSERT INTO public.invitado(\"nombreInvitado\" ,imagen_id) VALUES (?,1);";
    $values = [$nombreInvitadoEncapsulado];

    $resultados = $conexion->insertarDatos($query, $values);

    if ($resultados) {
        $sqlDatosSala = "SELECT nombre_sala, codigo_sala FROM public.sala WHERE codigo_sala = ?";
        $valoresDatosSala = [$codigoEncapsulado];
        $resultadosSala = $conexion->consultaIniciarSesion($sqlDatosSala, $valoresDatosSala);

        if (!empty($resultadosSala)) {
            $_SESSION['datosSala'] = $resultadosSala[0];
            $_SESSION['nombreInvitado'] = $nombreInvitadoEncapsulado;

            $response['status'] = 'success';
            echo json_encode($response);
            exit();
        } else {
            $response['status'] = 'error';
            $response['mensaje'] = 'No se encontró la sala.';
            echo json_encode($response);
            exit();
        }
    } else {
        // Respuesta de error si no se pudo insertar
        $response['status'] = 'error';
        $response['mensaje'] = 'Error al añadir el invitado.';
        echo json_encode($response);  // Enviar respuesta JSON
        exit();
    }
} else {
    // En caso de que falten los datos necesarios
    $response['status'] = 'error';
    $response['mensaje'] = 'El nombre del invitado o el código de sala no están definidos.';
    echo json_encode($response);  // Enviar respuesta JSON
    exit();
}
