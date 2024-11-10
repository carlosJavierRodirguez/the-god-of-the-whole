<?php
$usuarioID = $_SESSION['usuarioID'];

$sqlQuery = '
SELECT id_url, url_imagen, nombre_imagen
FROM "imagenPerfil";';

$values = [$usuarioID];
$selectImagenes = $conexion->consultaIniciarSesion($sqlQuery, []);