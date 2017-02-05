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
<h2>Modificar Profesor</h2>

<?php
if($_POST){
	// Se reciben datos y guardan en variables
	$idprofesor = $_POST['id'];
	$nombre = ucwords(strtolower($_POST['nombre']));
	$apellido = ucwords(strtolower($_POST['apellido']));
	$calle = ucfirst(strtolower($_POST['calle']));
	$cp = $_POST['cp'];
	$poblacion = ucwords(strtolower($_POST['poblacion']));
	$dia = $_POST['dia'];
	$mes = $_POST['mes'];
	$anio = $_POST['anio'];
	$nacimiento = sprintf('%04d-%02d-%02d', $anio, $mes, $dia);	
	$sexo = $_POST['sexo'];
	$sueldo = $_POST['sueldo'];
	// recepcion y nombre de foto
	if($_FILES['foto']['size'] == 0){
		$consultaB = "UPDATE profesores ";
		$consultaB .= "SET nombre='$nombre', apellido='$apellido', calle='$calle', cp='$cp', poblacion='$poblacion', nacimiento='$nacimiento', sexo='$sexo', sueldo='$sueldo' ";
		$consultaB .= "WHERE id='$idprofesor' ";
	} else {	
		$extension_archivo = substr($_FILES['foto']['name'], -4);
		$foto = "fotos/". $nombre . "-" . $apellido . $extension_archivo;
		$foto = strtolower($foto);    //convertir a minúsculas
		$foto = str_replace(' ', '-', $foto);  // quitar espacios
		move_uploaded_file($_FILES['foto']['tmp_name'], $foto );	
		$consultaB = "UPDATE profesores ";
		$consultaB .= "SET nombre='$nombre', apellido='$apellido', calle='$calle', cp='$cp', poblacion='$poblacion', nacimiento='$nacimiento', sexo='$sexo', sueldo='$sueldo', foto='$foto' ";
		$consultaB .= "WHERE id='$idprofesor' ";	
	}
	
	
	
	
	if ($conexion->query($consultaB)) {
		//mensaje de confirmacion
		echo "<p>El nuevo profesor se ha modificado correctamente</p>";
		echo "<p><a href='profesores-ver.php?id=$idprofesor'>Ver $nombre $apellido </a></p>";
		
	} else {
		die('Error de consulta '. $conexion->errno .': ' . $conexion->error );
	}

} else {
	
	// consulta que carga los datos iniciales
	$idprofesor = $_GET['id'];
	$consultaA = "SELECT *, YEAR(nacimiento) AS anio, MONTH(nacimiento) AS mes, DAY(nacimiento) AS dia ";
	$consultaA .= "FROM profesores  WHERE id=$idprofesor ";
	$resultadoA = $conexion->query($consultaA);
	$filaA = $resultadoA->fetch_object();
	
?>
<p>Todos los datos son obligatorios</p>

<!-- Capa de fotos  -->
<div class='flotante'><img src='<?= $filaA->foto ?>' width='250' ></div>
<div class='flotante'>

<p>ID: <?= $idprofesor ?> </p>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" onsubmit="return confirm('¿Seguro que quiere modificar este profesor')">

<input type="hidden" value="<?= $idprofesor ?>" name="id" >

<p>Nombre<br>
<input type="text" name="nombre" size="50" maxlength="50"  value="<?= $filaA->nombre ?>" required> </p>

<p>Apellidos<br>
<input type="text" name="apellido" size="50" maxlength="50" value="<?= $filaA->apellido ?>" required> </p>

<p>Calle<br>
<input type="text" name="calle" size="50" maxlength="100" value="<?= $filaA->calle ?>" required> </p>

<p>Cod. Postal<br>
<input type="text" name="cp" size="5" maxlength="5" value="<?= $filaA->cp ?>" required> </p>

<p>Población<br>
<input type="text" name="poblacion" size="50" maxlength="50"  value="<?= $filaA->poblacion ?>" required> </p>

<p>Nacimiento<br>
<input type="number" name="dia" value="<?= $filaA->dia ?>"  min="1" max="31" required > 
<input type="number" name="mes" value="<?= $filaA->mes ?>"  min="1" max="12" required > 
<input type="number" name="anio" value="<?= $filaA->anio ?>"   required > 
</p>

<p>Sexo<br>

<?php
	if ($filaA->sexo == 'mujer'){
		echo "<label><input type='radio' name='sexo' value='mujer' checked> Mujer </label><br>";
		echo "<label><input type='radio' name='sexo' value='hombre'> Hombre </label>";
	} else {
		echo "<label><input type='radio' name='sexo' value='mujer' > Mujer </label><br>";
		echo "<label><input type='radio' name='sexo' value='hombre' checked> Hombre </label>";
	}
?>

</p>

<p>Sueldo<br>
<input type="number" name="sueldo" value="<?= $filaA->sueldo ?>" min="0" step="100" required > </p>

<p>Fotografía<br>
<input type="file" name="foto" accept="image/*" > </p>

<p><input type="submit" value="Modificar"></p>


</form>


<?php

}

$conexion->close();

echo "</div>";
echo "<div style='clear:left'></div>";
include('includes/footer.php');
?>

</body>
</html>