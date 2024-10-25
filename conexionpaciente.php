<?php
// Conectar a la base de datos
$servername = "localhost:81";
$username_db = "Camilo";
$password_db = "C4milo1012";
$dbname = "Clinicadb";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST['role'];
    $name = $_POST['name'];
    $document = $_POST['document'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encriptar la contraseña
    $phone = $_POST['phone'];

    // Insertar datos en la base de datos
    $sql = "INSERT INTO usuarios (rol, nombre, documento, email, contraseña, telefono) VALUES ('$role', '$name', '$document', '$email', '$password', '$phone')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>


<!-- <!DOCTYPE html>
<html>
<head>
    <title>Clinica</title>
</head>
<body>
<!-- ?php
$conexion = mysqli_connect("localhost", "Camilo", "C4milo1012", "clinicadb") or die ("Problemas con la conexión a la BD.");
echo "Hola, estoy conectado a la base de datos clínica."; -->

<!-- // Consulta para insertar el paciente
$consulta = "INSERT INTO paciente (nombre,documento,electronico, contrasena,telefono) 
            VALUES ('" . $_REQUEST['nombre'] . "', 
                    '" . $_REQUEST['documento'] . "', 
                    '" . $_REQUEST['correo'] . "', 
                    '" . $_REQUEST['contrasena'] . "', 
                    '" . $_REQUEST['telefono'] . "')";

// Ejecutar la consulta y verificar si hubo errores
if (!mysqli_query($conexion, $consulta)) {
    die("Problemas en el insert: " . mysqli_error($conexion));
}

mysqli_close($conexion);

echo "Paciente ingresado con éxito.";
?>
</body>
</html> --> -->

