<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="includes/estilo.css" rel="stylesheet">
<title>Aplicacion WEB: Formacion</title>

<script>
function comprobar(){
	seleccion = document.forms[0].profesor.value
	if ( seleccion == 0){
		alert ('Por favor, seleccione un profesor');
		return false;
	} else {
		return confirm('¿Seguro que quiere añadir este curso?');
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
<h2>Nuevo Curso</h2>

<?php
if($_POST){
	// Se reciben datos y guardan en variables
	$nombre = ucwords(strtolower($_POST['nombre']));
	$duracion = $_POST['duracion'];
	$profesor = $_POST['profesor'];
	
	$consultaA = "INSERT INTO cursos (nombre, duracion, profesor) ";
	$consultaA .= "VALUES ('$nombre', '$duracion', '$profesor') ";

	if ($conexion->query($consultaA)) {
		//mensaje de confirmacion
		echo "<p>El nuevo curso se ha añadido correctamente</p>";
	} else {
		die('Error de consulta '. $conexion->errno .': ' . $conexion->error );
	}

} else {
?>
<p>Todos los datos son obligatorios</p>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return comprobar()">

<p>Nombre<br>
<input type="text" name="nombre" size="50" maxlength="50" required> </p>

<p>Duración<br>
<input type="number" name="duracion" value="30" min="5" step="5" required> </p>

<p>Profesor<br>

<select name='profesor'>
<option value="0">Seleccione...</option>

<?php
	// consulta para obtener nombres de profesores
	$consultaB = "SELECT nombre, apellido, id ";
	$consultaB .= "FROM profesores ";
	$consultaB .= "ORDER BY nombre";
	$resultadoB = $conexion->query($consultaB);
	while( $filaB = $resultadoB->fetch_object() ){
		echo "<option value='$filaB->id'  >";
		echo "$filaB->nombre $filaB->apellido";
		echo "</option>";
	}
?>

</select>
</p>




<p><input type="submit" value="Añadir"></p>


</form>


<?php

}

$conexion->close();
include('includes/footer.php');
?>

</body>
</html>