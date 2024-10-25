<docttype html>
	<!DOCTYPE html>
	<html>
	<head>
		<title>medico</title>
	</head>
	<body>
		<?php 

			$conexion=mysqli_connect("localhost:80","Camilo","C4milo1012","clinicadb") or die ("Problemas con la conexion a la BD");
			echo"hola estoy conectado a la base de datos clinicadb ";
			
			mysqli_query($conexion, "insert into medico(nombre,documento,correo,contrasena,telefono) values 
			 	('$_REQUEST[nombre]','$_REQUEST[documento]','$_REQUEST[correo]','$_REQUEST[contrasena]','$_REQUEST[telefono]')") or die
			    ("Problemas en el select". myslqli_error($conexion));
			
			mysqli_close($conexion);

			echo "medico ingresado con exito ";
		 ?>
	</body>
	</html>