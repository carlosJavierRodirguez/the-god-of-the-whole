<?php
session_start();
include('../libreria/conexion.php');

$conexion = new Conexion();
$conexion->conectar();
$usuarioID = $_SESSION['usuarioID']; 

$sqlQuery = "
SELECT u.\"usuarioID\",u.imagen_perfil, ip.url_imagen, ip.nombre_imagen
FROM public.\"usuario\" u
INNER JOIN public.\"imagenPerfil\" ip ON u.imagen_perfil = ip.id_url
WHERE u.\"usuarioID\" = ?; 
";

$values = [$usuarioID];
$resultado = $conexion->consultaIniciarSesion($sqlQuery, $values);
