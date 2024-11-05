<?php
session_start(); // Iniciar la sesión

$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "clinicadb";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $documento = $_POST['loginDocument'];
    $password = $_POST['loginPassword'];

    if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    // Verificar si es un médico
    $stmt = $conn->prepare("SELECT id_medico AS id, nombre, documento, correo, telefono, contrasena, 'medico' AS rol FROM medico WHERE documento = ? AND contrasena = ?");
    $stmt->bind_param("ss", $documento, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();

    if (!$usuario) {
        // Si no es un médico, verificar si es un paciente
        $stmt = $conn->prepare("SELECT id_paciente AS id, nombre, documento, correo, telefono, contrasena, 'paciente' AS rol FROM paciente WHERE documento = ? AND contrasena = ?");
        $stmt->bind_param("ss", $documento, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();
    }

    if ($usuario) {
        // Guardar datos del usuario en la sesión
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['user_rol'] = $usuario['rol'];
        $_SESSION['user_name'] = $usuario['nombre'];
        $_SESSION['user_documento'] = $usuario['documento'];
        $_SESSION['user_correo'] = $usuario['correo'];
        $_SESSION['user_telefono'] = $usuario['telefono'];
        $_SESSION['user_password'] = $usuario['contrasena'];
        
        // Redirigir a historialclinico.php
        header("Location: historialclinico.php");
        exit();
    } else {
        // Usuario no encontrado o credenciales incorrectas
        echo "Nombre de usuario o contraseña incorrectos.";
        echo '<a href="iniciosesion.html" class="btn btn-primary btn-lg mt-3">Volver a intentar</a>';
    }

    $stmt->close();
    $conn->close();
}
?>
