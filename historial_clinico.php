<?php
session_start(); // Iniciar sesión para gestionar información de sesión

include 'conexion.php'; // Incluir el archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger datos del formulario
    $id_paciente = $_POST['id_paciente'];
    $id_medico = $_POST['id_medico'];
    $diagnostico = $_POST['diagnostico'];
    $tratamiento = $_POST['tratamiento'];
    $fecha = $_POST['fecha'];

    // Preparar y ejecutar la consulta
    $sql = "INSERT INTO historial_clinico (id_paciente, id_medico, diagnostico, tratamiento, fecha) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisss", $id_paciente, $id_medico, $diagnostico, $tratamiento, $fecha);

    if ($stmt->execute()) {
        echo "Registro de historial clínico exitoso.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close(); // Cerrar la declaración
}

$conn->close(); // Cerrar la conexión
?>

