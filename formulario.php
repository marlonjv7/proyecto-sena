<?php
// Conectar a la base de datos
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "clinicadb";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
	die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$role = $_POST['role'];
	$name = $_POST['name'];
	$document = $_POST['document'];
	$email = $_POST['email'];
	$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encriptar la contraseña
	$phone = $_POST['phone'];

	$name1 = $_POST['name1'];
	$document1 = $_POST['document1'];
	$email1 = $_POST['email1'];
	$password1 = password_hash($_POST['password1'], PASSWORD_BCRYPT); // Encriptar la contraseña
	$phone1 = $_POST['phone1'];

	if ($role == 'paciente') {
		$sql = "INSERT INTO paciente (rol_paciente, nombre, documento, correo, contrasena, telefono) VALUES ('$role', '$name', '$document', '$email', '$password', '$phone')";
	} else {
		$sql = "INSERT INTO medico (rol_medico, nombre, documento, correo,telefono, contrasena ) VALUES ('$role', '$name1', '$document1', '$email1','$phone1','$password1')";
	}    // Insertar datos en la base de datos


	if ($conn->query($sql) === TRUE) {
		echo "Registro exitoso!";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

$conn->close();
?>
<?