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
<h2>Eliminar profesor</h2>


<?php

$idprofesor = $_GET['id'];

// consulta para conocer foto
$consultaA = "SELECT foto FROM profesores WHERE id=$idprofesor ";
$resultadoA = $conexion->query($consultaA);
$filaA = $resultadoA->fetch_object();
$foto= $filaA->foto;

//definicion de consulta
$consultaB = "DELETE FROM profesores WHERE id=$idprofesor";

// ejecucion de consulta 
// comprobacion de que funciona
echo"<p>";
if ($conexion->query($consultaB)){	
	echo "El profesor se ha eliminado definitivamente.";
	if($foto != 'fotos/profesor.jpg') unlink($foto);		
} else {
	echo('NO se puede eliminar el profesor');
	if ($conexion->errno  == '1451'){
		echo", porque <strong>tiene cursos asignados.</strong>";
	}
}
echo"</p>";

$conexion->close();

include('includes/footer.php');
?>

</body>
</html>