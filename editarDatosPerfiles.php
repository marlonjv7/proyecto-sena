<?php
// Conectar a la base de datos
$connection = new mysqli("localhost", "root", "", "clinicadb");

if ($connection->connect_error) {
    die("Error de conexión: " . $connection->connect_error);
}

// Obtener el ID del usuario desde la URL
$id = isset($_GET['id_medico']) ? intval($_GET['id_medico']) : null;

if (!$id) {
    echo "ID de usuario no proporcionado.";
    exit();
}

// Obtener los datos del usuario
$sql = "SELECT id_medico, nombre, documento, correo, telefono, contrasena FROM medico WHERE id_medico = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if (!$usuario) {
    echo "Usuario no encontrado.";
    exit();
}

// Procesar el formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $connection->real_escape_string($_POST['nombre']);
    $documento = $connection->real_escape_string($_POST['documento']);
    $correo = $connection->real_escape_string($_POST['correo']);
    $telefono = $connection->real_escape_string($_POST['telefono']);
    $contrasena = $connection->real_escape_string($_POST['contrasena']);

    // Actualizar los datos en la base de datos
    $sql_update = "UPDATE medico SET nombre = ?, documento = ?, correo = ?, telefono = ?, contrasena = ? WHERE id_medico = ?";
    $stmt_update = $connection->prepare($sql_update);
    $stmt_update->bind_param("sssssi", $nombre, $documento, $correo, $telefono, $contrasena, $id);

    if ($stmt_update->execute()) {
        header("Location: Perfil.php?mensaje=actualizado");
        exit();
    } else {
        echo "Error al actualizar los datos: " . $stmt_update->error;
    }
}

$connection->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Editar Perfil de Usuario</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="documento" class="form-label">Documento</label>
            <input type="text" class="form-control" name="documento" id="documento" value="<?php echo htmlspecialchars($usuario['documento']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" class="form-control" name="correo" id="correo" value="<?php echo htmlspecialchars($usuario['correo']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo htmlspecialchars($usuario['telefono']); ?>" required>
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
