<?php
session_start();


// Tu código restante aquí
require_once('../libreria/conexion.php');
$conexion = new Conexion();

// if (!isset($_SESSION['preguntas_mostradas'])) {
//     $_SESSION['preguntas_mostradas'] = [];
// }

// El resto del código sigue igual
// $placeholders = count($_SESSION['preguntas_mostradas']) > 0
//     ? implode(',', array_fill(0, count($_SESSION['preguntas_mostradas']), '?'))
//     : 'NULL';

$sqlQuery = "SELECT * FROM preguntas  ORDER BY RANDOM() LIMIT 1";

// $values = $_SESSION['preguntas_mostradas'];
$values=[];
$resultado = $conexion->consultaIniciarSesion($sqlQuery, $values);
