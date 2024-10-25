<?php
$host = 'localhost'; // Cambia esto si tu servidor es diferente
$usuario = 'Camilo';   // Cambia esto por tu usuario de MySQL
$contrasena = 'C4milo1012';    // Cambia esto por tu contraseña de MySQL
$nombre_bd = 'clinicadb'; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($host, $usuario, $contrasena, $nombre_bd);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
echo "Conexión realizada";
?>
<?