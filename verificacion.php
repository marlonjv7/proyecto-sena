<?php
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "clinicadb";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);
// Aquí puedes manejar el proceso de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$username = $_POST['loginDocument'];
	$password = $_POST['loginPassword'];

	// Verifica si la conexión es correcta
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Preparar la consulta
$stmt = $conn->prepare("SELECT * FROM medico WHERE documento = ? AND contrasena = ?");

if ($stmt === false) {
    die("Error en la consulta SQL: " . $conn->error); // Muestra el error si la consulta falla
}

// Asociar los parámetros (s = string)
$stmt->bind_param("ss", $username, $password);

// Ejecutar la consulta
$stmt->execute();

// Obtener los resultados
$registros = $stmt->get_result();

if ($registros->num_rows > 0) {
    // Usuario encontrado, hacer algo
    echo "Inicio de sesión exitoso.";
} else {
    // Usuario no encontrado o credenciales incorrectas
    echo "Nombre de usuario o contraseña incorrectos.";
}

// Cerrar la declaración
$stmt->close();


}
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
</head>

<body>
	<!-- El contenido HTML incrustado aquí -->
</body>

</html>