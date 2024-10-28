<?php

$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "clinicadb";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Verifica si la conexión es correcta
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Aquí puedes manejar el proceso de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['loginDocument'];
    $password = $_POST['loginPassword'];

    // Preparar la consulta
    $stmt = $conn->prepare("SELECT * FROM medico WHERE documento = ? AND contrasena = ?");

    if ($stmt === false) {
        die("Error en la consulta SQL: " . $conn->error); // Muestra el error si la consulta falla
    }

    // Asociar los parámetros (s = string)
    $stmt->bind_param("ss", $username, $password);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener los resultados
    $registros = $stmt->get_result();

if ($registros->num_rows > 0) {
    // Usuario encontrado, hacer algo
    echo "Inicio de sesión exitoso.";
    header("Location: Perfil.html");
} else {
    // Usuario no encontrado o credenciales incorrectas
    echo "Nombre de usuario o contraseña incorrectos."; // boton para devolver
<<<<<<< HEAD
    sleep(3); // Pausa la ejecución durante 3 segundos
    header("Location: iniciosesion.html"); // redireciona al inicio de sesion
=======
    echo '<a href="iniciosesion.html" class="btn btn-primary btn-lg mt-3">Volver a intentar</a>'; // Botón estilizado
>>>>>>> 9ca643acea00adc78bb82e00627c268a9da9c23b
}

// Cerrar la declaración
$stmt->close();

// Cerrar la conexión
$conn->close();
};
?>