<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="includes/estilo.css" rel="stylesheet">
<title>Aplicacion WEB: Formacion</title>
</head>
<body>
<?php
	include('includes/header.php');
	include('includes/conexion.php');
	include('includes/login.php');
	include('includes/nav-admin.php');
	include('includes/aside.php');	
?>

<h1>Profesores</h1>
<h2>Administración</h2>

<p><a href="profesores-insert.php">Añadir profesor</a></p>


<?php


//definicion de consulta
$consulta = "SELECT id, nombre, apellido "; 
$consulta .= "FROM profesores ";
$consulta .= "ORDER BY nombre";

// ejecucion de consulta 
// comprobacion de que funciona
if ($resultados = $conexion->query($consulta)){	
	// contador de resultados
	echo "Se han encontrado " . $conexion->affected_rows . " profesores:";
	
	echo "<table>";
	// fila de encabezados
	echo "<tr>";
	echo "<th>Ref</th>";
	echo "<th>Nombre</th>";
	echo "<th>Apellido</th>";
	echo "</tr>";	
	
	//Recorrer resultados
	while( $fila = $resultados->fetch_object() ) {
		echo "<tr>";
		
		foreach ($fila as $valor){
			echo "<td>$valor</td>";
		}
		
		// Icono para ver datos de profesor
		echo "<td><a href='profesores-ver.php?id=$fila->id'>
		<img src='imagenes/ver.gif' title='Ver'>
		</a></td>";
		
		echo "</tr>";
	}

	echo "</table>";
	
} else {
	die('Error de consulta '. $conexion->errno .': ' . $conexion->error );
}



$conexion->close();
include('includes/footer.php');
?>

</body>
</html>