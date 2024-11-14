<?php
session_start();
require_once('../libreria/conexion.php');
$conexion = new Conexion();

if (!isset($_SESSION['preguntas_mostradas'])) {
    $_SESSION['preguntas_mostradas'] = [];
}

// Construir la consulta SQL para obtener una pregunta aleatoria que no esté en las preguntas ya mostradas
$placeholders = count($_SESSION['preguntas_mostradas']) > 0
    ? implode(',', array_fill(0, count($_SESSION['preguntas_mostradas']), '?'))
    : 'NULL';

$sqlQuery = "SELECT * FROM preguntas WHERE pregunta_id NOT IN ($placeholders) ORDER BY RANDOM() LIMIT 1";

// Preparar los valores para la consulta
$values = $_SESSION['preguntas_mostradas'];

// Ejecutar la consulta
$resultado = $conexion->consultaIniciarSesion($sqlQuery, $values);
