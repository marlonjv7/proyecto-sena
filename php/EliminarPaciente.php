<?php
include 'conexion.php';
// Conexión a la base de datos
$connection = new mysqli("localhost", "root", "", "clinicadb");

if ($connection->connect_error) {
    die("Error de conexión: " . $connection->connect_error);
}

// Verificar si se recibe el ID del médico a eliminar
if (isset($_GET['id_paciente'])) {
    $id_paciente = $_GET['id_paciente'];

    // Preparar la consulta para eliminar el registro
    $stmt = $connection->prepare("DELETE FROM paciente WHERE id_paciente = ?");
    $stmt->bind_param("i", $id_paciente);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Redirigir a Perfil.php con mensaje de éxito
        header("Location: Perfil.php?mensaje=eliminado");
        exit();
    } else {
        echo "Error al eliminar el paciente: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID del paciente no proporcionado.";
}

$connection->close();

