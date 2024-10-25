<!DOCTYPE html>
<html>
<head>
	<title>rol</title>
</head>
<body>
	<?php
		$conexion=mysqli_connect("localhost","root","","clinicadb") or die ("Problemas con la conexion a la BD");

		$registros= mysqli_query($conexion,"select * from paciente") or die ("Problemas con el select". mysqli_error($conexion));

		while ($reg = mysqli_fetch_array($registros)) {
			echo "Nombres: ". $reg['nombres']."<br>";
			echo "Numero_de_documento: ". $reg['Numero_de_documento']."<br>";
			echo "Correo_electronico: ". $reg['Correo_electronico']."<br>";
            echo "Contraseña: ". $reg['Contraseña']."<br>";
            echo "numero_de_telefono: ". $reg['numero_de_telefono']."<br>";
			echo "rol: ";
			switch ($reg['codrol']) {
			 	case 12345:
			 		echo "Paciente";
			 		break;
			 	case 54321:
			 		echo "Medico";
			 		break;
			 	
			}
			echo "<br>";
			echo "<hr>";
		}
		echo "no hay más datos";
		mysqli_close($conexion);
	?>
</body>
</html>