<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = ""; // Sin contraseña
$dbname = "clinicadb";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['name'];
$documento = $_POST['documento'];
$correo = $_POST['email'];
$telefono = $_POST['Teléfono'];
$contrasena = $_POST['password'];
$rol = $_POST['role'];

// Insertar en la tabla correspondiente
if ($rol === 'doctor') {
    $sql = "INSERT INTO medico (rol_medico, nombre, documento, correo, telefono, contrasena) VALUES ('doctor', '$nombre', '$documento', '$correo', '$telefono', '$contrasena')";
} else if ($rol === 'patient') {
    $sql = "INSERT INTO paciente (rol_paciente, nombre, documento, correo, telefono, contrasena) VALUES ('patient', '$nombre', '$documento', '$correo', '$telefono', '$contrasena')";
} else {
    die("Rol no válido.");
}

if ($conn->query($sql) === TRUE) {
    echo "Registro exitoso";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
