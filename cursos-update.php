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
<h2>Modificar Curso</h2>

<?php
if($_POST){
	// Se reciben datos y guardan en variables
	$nombre = ucwords(strtolower($_POST['nombre']));
	$duracion = $_POST['duracion'];
	$profesor = $_POST['profesor'];
	$idcurso = $_POST['id'];
	
	// consulta de actualizacion
	$consultaC = "UPDATE cursos ";
	$consultaC .= "SET nombre='$nombre', duracion='$duracion', profesor='$profesor' ";
	$consultaC .= "WHERE id='$idcurso' ";

	if ($conexion->query($consultaC)) {
		//mensaje de confirmacion
		echo "<p>El nuevo curso se ha modificado correctamente</p>";
	} else {
		die('Error de consulta '. $conexion->errno .': ' . $conexion->error );
	}

} else {
	
	// consulta que carga los datos iniciales
	$idcurso = $_GET['id'];
	$consultaA = "SELECT * FROM cursos WHERE id=$idcurso ";
	$resultadoA = $conexion->query($consultaA);
	//por variar, esta vez extraemos los datos como matriz asociativa
	$filaA = $resultadoA->fetch_assoc(); 
	
?>
<p>Todos los datos son obligatorios</p>

<p>ID: <?= $idcurso ?> </p>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return confirm('¿Seguro que quiere modificar este curso?');">

<input type="hidden" value="<?= $idcurso ?>" name="id" >

<p>Nombre<br>
<input type="text" name="nombre" size="50" maxlength="50" value="<?= $filaA['nombre'] ?>"required> </p>

<p>Duración<br>
<input type="number" name="duracion" value="<?= $filaA['duracion'] ?>" min="5" step="5" required> </p>

<p>Profesor<br>

<select name='profesor'>

<?php
	// consulta para obtener nombres de profesores
	$consultaB = "SELECT nombre, apellido, id ";
	$consultaB .= "FROM profesores ";
	$consultaB .= "ORDER BY nombre";
	$resultadoB = $conexion->query($consultaB);
	while( $filaB = $resultadoB->fetch_object() ){
		// se preselecciona el profesor asignado
		if ($filaB->id == $filaA['profesor']) {
			echo "<option value='$filaB->id' selected >";
		} else {
			echo "<option value='$filaB->id'  >";
		}
		echo "$filaB->nombre $filaB->apellido";
		echo "</option>";
	}
?>

</select>
</p>

<p><input type="submit" value="Modificar"></p>

</form>

<?php

}

$conexion->close();
include('includes/footer.php');
?>

</body>
</html>