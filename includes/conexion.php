<?php

// datos de servidor local
$direccion = 'localhost';
$usuario = 'root';
$clave = '';
$datos = 'formacion';

$conexion = new mysqli($direccion, $usuario, $clave, $datos );

if ($conexion->connect_errno){
	die('Error de conexion '. $conexion->connect_errno .': ' . $conexion->connect_error );
}

$conexion->set_charset('utf8');

?>