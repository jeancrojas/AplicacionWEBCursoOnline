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
	include('includes/aside.php');	
	include('includes/conexion.php');
?>

<h1>Zona pública</h1>
<h2>Cursos</h2>

<?php
// se recuperan los datos de ordenacion de la consulta
$campo = (empty($_GET))? 'nombre' : $_GET['campo'];
$orden = (empty($_GET))? 'ASC' : $_GET['orden'];

//definicion de consulta
$consulta = "SELECT id, nombre, duracion FROM cursos ORDER BY $campo $orden";

// ejecucion de consulta 
// comprobacion de que funciona
if ($resultados = $conexion->query($consulta)){	
	// contador de resultados
	echo "Hay " . $conexion->affected_rows . " cursos disponibles:";
	
	echo "<table>";
	// fila de encabezados
	echo "<tr>";
	echo "<th>Ref</th>";
	echo "<th>Nombre";
	// mandamos el dato de ordenacion de la consulta
	echo "<a href='". $_SERVER['PHP_SELF']. "?campo=nombre&orden=ASC' class='icono'>▲</a> ";
	echo "<a href='". $_SERVER['PHP_SELF']. "?campo=nombre&orden=DESC' class='icono'>▼</a></th>";
	echo "<th>Horas";
	echo "<a href='". $_SERVER['PHP_SELF']. "?campo=duracion&orden=ASC' class='icono'>▲</a> ";
	echo "<a href='". $_SERVER['PHP_SELF']. "?campo=duracion&orden=DESC' class='icono'>▼</a></th>";
	echo "</tr>";	
	
	//Recorrer resultados
	while( $fila = $resultados->fetch_object() ) {
		echo "<tr>";
		
		foreach ($fila as $valor){
			echo "<td>$valor</td>";
		}
		
		echo "</tr>";
	}

	echo "</table>";
	
} else {
	die('Error de consulta '. $conexion->errno .': ' . $conexion->error );
}

echo "<p><a href='cursos-admin.php'>Administración</a></p>";

$conexion->close();
include('includes/footer.php');
?>

</body>
</html>