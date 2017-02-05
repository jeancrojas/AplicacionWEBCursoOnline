<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="includes/estilo.css" rel="stylesheet">
<title>Aplicacion WEB: Formacion</title>

<script>
function confirmar(idcurso){
	if (confirm('¿Seguro que quiere eliminar este curso?')){
		window.location='cursos-delete.php?id='+idcurso ;
	}
}
</script>

</head>
<body>
<?php
	include('includes/header.php');
	include('includes/conexion.php');
	include('includes/login.php');
	include('includes/nav-admin.php');
	include('includes/aside.php');	
?>

<h1>Cursos</h1>
<h2>Administración</h2>
<p><a href="cursos-insert.php">Añadir curso</a></p>

<?php
//definicion de consulta
$consulta = "SELECT cursos.id, cursos.nombre, cursos.duracion, "; 
$consulta .= "CONCAT (profesores.nombre, ' ' , profesores.apellido) AS profesor ";
$consulta .= "FROM cursos JOIN profesores ";
$consulta .= "ON cursos.profesor = profesores.id ";

// ejecucion de consulta 
// comprobacion de que funciona
if ($resultados = $conexion->query($consulta)){	
	// contador de resultados
	echo "Hay " . $conexion->affected_rows . " cursos disponibles:";
	
	echo "<table>";
	// fila de encabezados
	echo "<tr>";
	echo "<th>Ref</th>";
	echo "<th>Nombre</th>";
	echo "<th>Horas</th>";
	echo "<th>Profesor</th>";
	echo "</tr>";	
	
	//Recorrer resultados
	while( $fila = $resultados->fetch_object() ) {
		echo "<tr>";
		
		foreach ($fila as $valor){
			echo "<td>$valor</td>";
		}
		
		// Icono para acceder a update
		echo "<td><a href='cursos-update.php?id=$fila->id'>";
		echo"<img src='imagenes/modificar.gif' title='Modificar'></a></td>";
		
		// Icono para acceder a delete
		echo "<td><a href='#' title='Eliminar' onclick='confirmar($fila->id)'>";
		echo "<img src='imagenes/eliminar.gif' title='Borrar'></a></td>";
		
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