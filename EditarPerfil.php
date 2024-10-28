<?php  /*
$connection = new mysqli("localhost", "root", "", "clinicadb");

$id = $_GET['id'];
$user = $connection->query("SELECT * FROM medico WHERE id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $documento = $_POST['documento'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $contrasena = $_POST['contrasena'];

    $stmt = $connection->prepare("UPDATE medico SET nombre = ?, documento = ?, correo = ?, telefono = ?, contrasena = ? WHERE id = ?");
    $stmt->bind_param("ssi", $nombre, $documento, $correo, $telefono, $contrasena, $id);

    if ($stmt->execute()) {
        header("Location: Perfil.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

$connection->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
</head>
<body>
    <h1>Editar Usuario</h1>
    <form method="post" action="">
        <label for="name">Nombre:</label>
        <input type="text" name="name" value="<?php echo $user['nombre']; ?>" required>
        <br>
        <label for="document">Documento:</label>
        <input type="text" name="document" value="<?php echo $user['documento']; ?>" required>
        <br>
        <label for="email">Correo:</label>
        <input type="email" name="email" value="<?php echo $user['correo']; ?>" required>
        <br>
        <label for="phone">Teléfono:</label>
        <input type="tel" name="phone" value="<?php echo $user['telefono']; ?>" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" value="<?php echo $user['contrasena']; ?>" required>
        <br>
        <input type="submit" value="Guardar Cambios">
    </form>
</body>
</html>
*/


// Configuración de la conexión a la base de datos (reemplaza con tus credenciales)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinicadb";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener el ID del médico desde la URL
$id = $_GET['id_medico'];

// Preparar la consulta para evitar inyección SQL
$stmt = $conn->prepare("SELECT * FROM medico WHERE id_medico = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Obtener los datos del médico
    $row = $result->fetch_assoc();

    // Si se ha enviado el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sanitizar los datos para prevenir inyección SQL
        $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
        $documento = mysqli_real_escape_string($conn, $_POST['documento']);
        $correo = mysqli_real_escape_string($conn, $_POST['correo']);
        $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
        $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT); // Hashear la contraseña

        // Preparar la consulta de actualización
        $stmt = $conn->prepare("UPDATE medico SET nombre=?, documento=?, correo=?, telefono=?, contrasena=? WHERE id_medico=?");
        $stmt->bind_param("ssissi", $nombre, $documento, $correo, $telefono, $contrasena, $id);

        if ($stmt->execute()) {
            header("Location: Perfil.php");
            exit();
        } else {
            echo "Error al actualizar los datos: " . $stmt->error;
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
</head>
<body>
<?php
} else {
    echo "Médico no encontrado.";
}

$conn->close();
?>
    <h1>Editar Usuario</h1>
    <form method="post" action="">
        <label for="name">Nombre:</label>
        <input type="text" name="name" value="<?php echo isset($user['nombre']) ? $user['nombre'] : ''; ?>" required>
        <br>
        <label for="document">Documento:</label>
        <input type="text" name="document" value="<?php echo isset($user['documento']) ? $user['documento'] : ''; ?>" required>
        <br>
        <label for="email">Correo:</label>
        <input type="email" name="email" value="<?php echo isset($user['correo']) ? $user['correo'] : ''; ?>" required>
        <br>
        <label for="phone">Teléfono:</label>
        <input type="tel" name="phone" value="<?php echo isset($user['telefono']) ? $user['telefono'] : ''; ?>" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" value="<?php echo isset($user['contrasena']) ? $user['contrasena'] : ''; ?>" required>
        <br>
        <input type="submit" value="Guardar Cambios">
    </form>
</body>
</html>
