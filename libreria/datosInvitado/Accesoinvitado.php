<?php
session_start();  // Inicia la sesión

include('../conexion.php');
include('../classAcceso.php');

$encapsularAcceso = new Acceso();
$conexion = new Conexion();

$nombreInvitado = isset($_POST['txtNombreJugador']) ? htmlspecialchars(trim($_POST['txtNombreJugador'])) : null;
$codigoSala = isset($_POST['txtCodigoSala']) ? htmlspecialchars(trim($_POST['txtCodigoSala'])) : null;

$response = [];

if ($nombreInvitado && $codigoSala) {
    // Se establece el código de sala
    $encapsularAcceso->setCodigoSala($codigoSala);

    // Insertar el jugador en la base de datos
    $query = "INSERT INTO public.invitado(\"nombreInvitado\") VALUES (?);";
    $values = [$nombreInvitado];

    $resultados = $conexion->insertarDatos($query, $values);

    if ($resultados) {
        // Guardar el nombre del invitado en la sesión
        $_SESSION['nombreInvitado'] = $nombreInvitado;  // Guardamos en sesión

        // Respuesta exitosa, enviar al cliente
        $response['status'] = 'success';
        echo json_encode($response);  // Enviar respuesta JSON
        exit();  // Terminar el script aquí
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
