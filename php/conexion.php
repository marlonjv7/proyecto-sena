<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "clinicadb";

$conn = new mysqli($server, $user, $pass, $db);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa";

