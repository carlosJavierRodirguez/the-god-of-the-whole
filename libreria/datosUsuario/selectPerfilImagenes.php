<?php
require_once('../libreria/conexion.php');
$conexion = new Conexion();
$sqlQuery = '
SELECT id_url, url_imagen, nombre_imagen
FROM "imagenPerfil";';

$selectImagenes = $conexion->consultaIniciarSesion($sqlQuery, []);
