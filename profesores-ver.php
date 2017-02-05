<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="includes/estilo.css" rel="stylesheet">
<title>Aplicacion WEB: Formacion</title>

<script>
function confirmar(idprofesor){
	if (confirm('¿Seguro que quiere eliminar este profesor?')){
		window.location='profesores-delete.php?id='+idprofesor ;
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

<h1>Profesores</h1>


<?php

$idprofesor = $_GET['id'];

echo "<p><a href='profesores-update.php?id=$idprofesor' title='Modificar' >";
echo "<img src='imagenes/modificar.gif'> Modificar</a>";
echo "&nbsp &nbsp ";
echo "<a href='#' title='Eliminar' onclick='confirmar($idprofesor)' >";
echo "<img src='imagenes/eliminar.gif'> Eliminar</a></p>";


//definicion de consulta
$consultaA = "SELECT * "; 
$consultaA .= "FROM profesores ";
$consultaA .= "WHERE id=$idprofesor";

// ejecucion de consulta 
// comprobacion de que funciona
if ($resultadosA = $conexion->query($consultaA)){	
	
	//Recorrer resultado
	$filaA = $resultadosA->fetch_object() ;
		echo "<h2>$filaA->nombre $filaA->apellido</h2>";
		
		// Capa de fotos
		echo "<div class='flotante'><img src='$filaA->foto' width='250' ></div>";
		echo "<div class='flotante'>";		
		
		foreach ($filaA as $clave => $valor){
			$clave = ucfirst($clave);         //1ª letra del campo en mayúscula
			echo "<p><strong>$clave:</strong> $valor</p>";
		}
		
		
		// consulta de los cursos que imparte
		$consultaB = "SELECT nombre, id "; 
		$consultaB .= "FROM cursos ";
		$consultaB .= "WHERE profesor=$idprofesor";

		// ejecucion de consulta 
		// comprobacion de que funciona
		if ($resultadosB = $conexion->query($consultaB)){	

			echo "<p><strong>Cursos que imparte:</strong></p>";
			
			// comprobar si tiene cursos
			if ($conexion->affected_rows >0 ){
				echo"<p><blockquote>";
				//Recorrer resultados
				while($filaB = $resultadosB->fetch_object()){
					echo"$filaB->nombre (Ref: $filaB->id)<br>";
				}
				echo"</blockquote></p>";
			} else {
				echo "<p>No tiene cursos asignados</p>";	
			}
		
		} else {
			die('Error de consulta '. $conexion->errno .': ' . $conexion->error );
		}
	
} else {
	die('Error de consulta '. $conexion->errno .': ' . $conexion->error );
}



$conexion->close();

echo "<p><a href=# onclick='history.back()' >Volver atrás</a></p>";


echo "</div>";
echo "<div style='clear:left'></div>";

include('includes/footer.php');
?>

</body>
</html>