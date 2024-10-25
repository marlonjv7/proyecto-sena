<documenttype html>
	<!DOCTYPE html>
	<html>
	<head>
		<title>cambio</title>
	</head>
	<body>
		<?php
			$conexion=mysqli_connect("localhost","root","","clinicabd") or die ("Problemas con la conexion a la BD");

			$registros=mysqli_query($conexion,"update paciente set paciente='$_REQUEST[paciente]' where id='$_REQUEST[idold]'")
				or die("Problemas al actualizar". myslqli_error($conexion));

			echo "el paciente se actualizo con exito";

		?>
	</body>
	</html>