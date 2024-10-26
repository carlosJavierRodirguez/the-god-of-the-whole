<?php
session_start();

include('conexion.php');
include('classAcceso.php');

$encapsularAcceso = new Acceso();
$conexion = new Conexion();

$nombreInvitado = isset($_POST['txtNombreJugador']) ? htmlspecialchars(trim($_POST['txtNombreJugador'])) : null;
$codigoSala = isset($_POST['txtCodigoSala']) ? htmlspecialchars(trim($_POST['txtCodigoSala'])) : null;

if ($nombreInvitado && $codigoSala) {
    $encapsularAcceso->setCodigoSala($codigoSala);

    $query = "INSERT INTO public.invitado(\"nombreInvitado\") VALUES (?);";
    $values = [$nombreInvitado];

    $resultados = $conexion->insertarDatos($query, $values);

    if (!$resultados) {
        // Inserción exitosa, redirigir al invitado a la sala de espera
        header('Location: ../sala/salaEsperaInvitado.php');
        exit();
    } else {
        // Mostrar error si no se pudo insertar
        echo "Error al añadir el invitado.";
    }
} else {
    // En caso de que falten los datos necesarios
    echo "El nombre del invitado o el código de sala no están definidos.";
}
