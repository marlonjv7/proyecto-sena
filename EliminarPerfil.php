<?php
// Conexión a la base de datos
$connection = new mysqli("localhost", "root", "", "clinicadb");

if ($connection->connect_error) {
    die("Error de conexión: " . $connection->connect_error);
}

// Verificar si se recibe el ID del médico a eliminar
if (isset($_GET['id_medico'])) {
    $id_medico = $_GET['id_medico'];

    // Confirmación de eliminación (usando un diálogo de confirmación en JavaScript)
    echo "<script>
        if (confirm('¿Estás seguro de que deseas eliminar este usuario y todos sus datos relacionados?')) {
            window.location.href = 'EliminarPerfil.php?id_medico=" . $id_medico . "&confirmado=true';
        } else {
            window.location.href = 'Perfil.php';
        }
    </script>";
    
    // Si se confirma la eliminación
    if (isset($_GET['confirmado']) && $_GET['confirmado'] == 'true') {
        // Preparar consulta para eliminar los registros relacionados en historial_clinico
        $stmt_historial = $connection->prepare("DELETE FROM historial_clinico WHERE id_medico = ?");
        $stmt_historial->bind_param("i", $id_medico);
        $stmt_historial->execute();
        $stmt_historial->close();

        // Preparar consulta para eliminar el registro del médico
        $stmt_medico = $connection->prepare("DELETE FROM medico WHERE id_medico = ?");
        $stmt_medico->bind_param("i", $id_medico);

        // Ejecutar la consulta
        if ($stmt_medico->execute()) {
            // Redirigir a Perfil.php con mensaje de éxito
            header("Location: Perfil.php?mensaje=eliminado");
            exit();
        } else {
            echo "Error al eliminar el usuario: " . $stmt_medico->error;
        }

        $stmt_medico->close();
    }
} else {
    echo "ID de médico no proporcionado.";
}

$connection->close();
?>