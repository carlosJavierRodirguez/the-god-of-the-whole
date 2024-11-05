<?php
include_once('../libreria/conexion.php');

$conexion = new conexion();

$conexion->conectar();
$usuarioID = $_SESSION['usuarioID'];

$sqlQuery = "
SELECT id_url, url_imagen, nombre_imagen
FROM public.\"imagenPerfil\";";

$values = [$usuarioID];
$resultado = $conexion->consultaIniciarSesion($sqlQuery, []);