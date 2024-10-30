<?php
include 'conexion.php';

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
    header("Location: historialclinico.php");
} else {
    // Usuario no encontrado o credenciales incorrectas
    echo "Nombre de usuario o contraseña incorrectos."; // boton para devolver
    echo '<a href="iniciosesion.html" class="btn btn-primary btn-lg mt-3">Volver a intentar</a>'; // Botón estilizado
}
// Cerrar la declaración
$stmt->close();

};


