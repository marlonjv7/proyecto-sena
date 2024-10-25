<?php
session_start(); // Iniciar sesión para gestionar información de sesión

include 'conexion.php'; // Incluir el archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger datos del formulario
    $nombre = $_POST['nombre'];
    $documento = $_POST['documento'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $contrasena = password_hash($_POST['contraseña'], PASSWORD_DEFAULT); // Hash de la contraseña

    // Preparar y ejecutar la consulta
    $sql = "INSERT INTO medico (nombre, documento, correo, telefono, contrasena) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nombre, $documento, $correo, $telefono, $contrasena);

    if ($stmt->execute()) {
        echo "Registro exitoso.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close(); // Cerrar la declaración
}

$conn->close(); // Cerrar la conexión
?>






