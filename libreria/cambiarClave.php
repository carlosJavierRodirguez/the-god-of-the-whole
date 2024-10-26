<?php
include('conexion.php');
include('classAcceso.php');

$clave = new Acceso(); // Crear el objeto
$conexion = new Conexion();

$clave->setClave($_POST['txtCalveNueva']); // Obtener la clave del formulario
$clave->setClaveConfirmada($_POST['txtConfirmarClave']); // Obtener la clave del formulario


?>