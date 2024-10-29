<?php
// Conexión a la base de datos
$connection = new mysqli("localhost", "root", "", "clinicadb");

if ($connection->connect_error) {
    die("Error de conexión: " . $connection->connect_error);
}

// Verificar si se recibe el ID del médico a eliminar
if (isset($_GET['id_medico'])) {
    $id_medico = $_GET['id_medico'];

    // Preparar la consulta para eliminar el registro
    $stmt = $connection->prepare("DELETE FROM medico WHERE id_medico = ?");
    $stmt->bind_param("i", $id_medico);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Redirigir a Perfil.php con mensaje de éxito
        header("Location: Perfil.php?mensaje=eliminado");
        exit();
    } else {
        echo "Error al eliminar el usuario: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID de médico no proporcionado.";
}

$connection->close();
?>
