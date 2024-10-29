<?php // Crear conexión


$connection = new mysqli("localhost", "root", "", "clinicadb");

// Verificar conexión
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Obtener el ID del médico desde la URL
$id = $_GET['id_medico'] ?? null;

if($id) {
// Preparar la consulta para evitar inyección SQL
$stmt = $connection->prepare("SELECT * FROM medico WHERE id_medico = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$medico = $result->fetch_assoc();

if (!$medico) {
    echo "Médico no encontrado.";
    exit();
}
} else {
echo "ID de médico no proporcionado.";
exit();
}

// Si se ha enviado el formulario, se procesa la actualización
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $connection->real_escape_string($_POST['nombre']);
    $documento = $connection->real_escape_string($_POST['documento']);
    $correo = $connection->real_escape_string($_POST['correo']);
    $telefono = $connection->real_escape_string($_POST['telefono']);
    $contrasena = $connection->real_escape_string($_POST['contrasena']);

    // Consulta de actualización
    $stmt = $connection->prepare("UPDATE medico SET nombre = ?, documento = ?, correo = ?, telefono = ?, contrasena = ? WHERE id_medico = ?");
    $stmt->bind_param("sssssi", $nombre, $documento, $correo, $telefono, $contrasena, $id);

    if ($stmt->execute()) {
        header("Location: Perfil.php");
        exit();
    } else {
        echo "Error al actualizar los datos: " . $stmt->error;
    };
};
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div class="container mt-5">
        <h2 class="text-center mb-4">Editar Perfil de Médico</h2>
        
        <form method="post">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $medico['nombre']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="documento" class="form-label">Documento</label>
                <input type="text" class="form-control" name="documento" id="documento" value="<?php echo $medico['documento']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" class="form-control" name="correo" id="correo" value="<?php echo $medico['correo']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $medico['telefono']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Nueva Contraseña</label>
                <input type="password" class="form-control" name="contrasena" id="contrasena" required>
                <small>Si no deseas cambiar la contraseña, ingresa la misma.</small>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="Perfil.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $connection->close(); ?>