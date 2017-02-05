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

<h1>Cursos</h1>
<h2>Eliminar curso</h2>


<?php

$idcurso = $_GET['id'];

//definicion de consulta
$consulta = "DELETE FROM cursos WHERE id=$idcurso";

// ejecucion de consulta 
// comprobacion de que funciona
echo"<p>";
if ($conexion->query($consulta)){	
	echo "El curso se ha eliminado definitivamente.";	
} else {
	echo('NO se puede eliminar el curso.');
}
echo"</p>";

$conexion->close();

include('includes/footer.php');
?>

</body>
</html>