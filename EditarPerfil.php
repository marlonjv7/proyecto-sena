<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: iniciosesion.html");
    exit();
}

// Conectar a la base de datos
$connection = new mysqli("localhost", "root", "", "clinicadb");
if ($connection->connect_error) {
    die("Conexión fallida: " . $connection->connect_error);
}

// Obtener el rol del usuario de la sesión
$user_id = $_SESSION['user_id'];
$user_rol = $_SESSION['user_rol'];

// Seleccionar la tabla según el rol del usuario
if ($user_rol === 'medico') {
    $stmt = $connection->prepare("SELECT * FROM medico WHERE id_medico = ?");
} else {
    $stmt = $connection->prepare("SELECT * FROM paciente WHERE id_paciente = ?");
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if (!$usuario) {
    echo "Usuario no encontrado.";
    exit();
}

// Si se ha enviado el formulario, actualizar los datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $connection->real_escape_string($_POST['nombre']);
    $documento = $connection->real_escape_string($_POST['documento']);
    $correo = $connection->real_escape_string($_POST['correo']);
    $telefono = $connection->real_escape_string($_POST['telefono']);
    $contrasena = $connection->real_escape_string($_POST['contrasena']);

    // Preparar la consulta de actualización
    if ($user_rol === 'medico') {
        $stmt = $connection->prepare("UPDATE medico SET nombre = ?, documento = ?, correo = ?, telefono = ?, contrasena = ? WHERE id_medico = ?");
    } else {
        $stmt = $connection->prepare("UPDATE paciente SET nombre = ?, documento = ?, correo = ?, telefono = ?, contrasena = ? WHERE id_paciente = ?");
    }

    $stmt->bind_param("sssssi", $nombre, $documento, $correo, $telefono, $contrasena, $user_id);

    if ($stmt->execute()) {
        // Actualizar los datos en la sesión
        $_SESSION['user_name'] = $nombre;
        $_SESSION['user_documento'] = $documento;
        $_SESSION['user_correo'] = $correo;
        $_SESSION['user_telefono'] = $telefono;
        $_SESSION['user_password'] = $contrasena;

        header("Location: historialclinico.php");
        exit();
    } else {
        echo "Error al actualizar los datos: " . $stmt->error;
    }
}

$stmt->close();
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
        <h2 class="text-center mb-4">Editar Perfil</h2>
        <form method="post">
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
            <a href="historialclinico.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $connection->close(); ?>
