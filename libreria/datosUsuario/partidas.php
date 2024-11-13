<?php
session_start();
require_once('../libreria/conexion.php');
$conexion = new Conexion();
$usuarioID = $_SESSION['usuarioID'];

$sqlQuery = ' 
SELECT p."partidasGanadas",p."partidasPerdidas"
FROM usuario u
INNER JOIN partidas p ON p."usuarioId" = u."usuarioID"
WHERE p."usuarioId" = ?;  
';

$values = [$usuarioID];
$partidas = $conexion->consultaIniciarSesion($sqlQuery, $values);

$partidasGanadas = $partidas[0]['partidasGanadas'] ?? 0;
$partidasPerdidas = $partidas[0]['partidasPerdidas'] ?? 0;
$totalPartidas = $partidasGanadas +  $partidasPerdidas;

$mensaje = ' Juega para calcular tu porcentaje ';

if ($totalPartidas > 0) {
    $porcentajeDerrotas = round(($partidasPerdidas / $totalPartidas) * 100, 0);
    $porcentajeVictorias = round(($partidasGanadas / $totalPartidas) * 100, 0);
} else {
    $mensaje;
}
