<?php
session_start();
require_once('../libreria/conexion.php');
include('../libreria/classSala.php');
$conexion = new conexion();
$sala= new Sala();

// Obtener el ID del usuario
$usuarioID = $_SESSION['usuarioID'];

// Consulta para obtener la información de la sala
$query = "SELECT nombre_sala, codigo_sala FROM sala WHERE creador_sala = ? ";
$values = [$usuarioID];
$datosSala = $conexion->consultaIniciarSesion($query, $values);

$nombreSala = $datosSala[0]['nombre_sala'];
$codigoSala = $datosSala[0]['codigo_sala'];

$sala->setCodigoSala($codigoSala);
$sala->setNombreSala($nombreSala);

