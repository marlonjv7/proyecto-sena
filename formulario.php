<?php
// // Conectar a la base de datos
// $servername = "localhost";
// $username = "root";
// $password = ""; // Sin contraseña
// $dbname = "clinicadb";

// // Crear conexión
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Comprobar conexión
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// // Obtener datos del formulario
// $nombre = $_POST['name'];
// $documento = $_POST['documento'];
// $correo = $_POST['email'];
// $telefono = $_POST['Teléfono'];
// $contrasena = $_POST['password'];
// $rol = $_POST['role'];

// // Insertar en la tabla correspondiente
// if ($rol === 'doctor') {
//     $sql = "INSERT INTO medico (rol_medico, nombre, documento, correo, telefono, contrasena) VALUES ('doctor', '$nombre', '$documento', '$correo', '$telefono', '$contrasena')";
// } else if ($rol === 'patient') {
//     $sql = "INSERT INTO paciente (rol_paciente, nombre, documento, correo, telefono, contrasena) VALUES ('patient', '$nombre', '$documento', '$correo', '$telefono', '$contrasena')";
// } else {
//     die("Rol no válido.");
// }

// if ($conn->query($sql) === TRUE) {
//     echo "Registro exitoso";
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }

// // Cerrar conexión
// $conn->close();

//--------------------------------------------------------------------------------------------------------

<?php
// Mostrar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conectar a la base de datos
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "clinicadb";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST['role'];
    
    // Validar que el rol sea "paciente"
    if ($role == 'paciente') {
        // Verificar que los datos de los pacientes se están recibiendo
        if (isset($_POST['name'], $_POST['document'], $_POST['email'], $_POST['password'], $_POST['phone'])) {
            $name = $conn->real_escape_string($_POST['name']);
            $document = $conn->real_escape_string($_POST['document']);
            $email = $conn->real_escape_string($_POST['email']);
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $phone = $conn->real_escape_string($_POST['phone']);

            // Consulta para insertar datos del paciente
            $sql = "INSERT INTO paciente (rol_paciente, nombre, documento, correo, contrasena, telefono) 
                    VALUES ('$role', '$name', '$document', '$email', '$password', '$phone')";

            // Ejecutar la consulta y verificar el resultado
            if ($conn->query($sql) === TRUE) {
                echo "Registro de paciente exitoso!";
            } else {
                echo "Error en el registro del paciente: " . $conn->error;
            }
        } else {
            echo "Faltan algunos datos del paciente.";
        }
    } else if ($role == 'doctor') {
        // Verificar que los datos del doctor se están recibiendo
        if (isset($_POST['name1'], $_POST['document1'], $_POST['email1'], $_POST['password1'], $_POST['phone1'])) {
            $name1 = $conn->real_escape_string($_POST['name1']);
            $document1 = $conn->real_escape_string($_POST['document1']);
            $email1 = $conn->real_escape_string($_POST['email1']);
            $password1 = password_hash($_POST['password1'], PASSWORD_BCRYPT);
            $phone1 = $conn->real_escape_string($_POST['phone1']);

            // Consulta para insertar datos del médico
            $sql = "INSERT INTO medico (rol_medico, nombre, documento, correo, telefono, contrasena) 
                    VALUES ('$role', '$name1', '$document1', '$email1', '$phone1', '$password1')";

            // Ejecutar la consulta y verificar el resultado
            if ($conn->query($sql) === TRUE) {
                echo "Registro de doctor exitoso!";
            } else {
                echo "Error en el registro del doctor: " . $conn->error;
            }
        } else {
            echo "Faltan algunos datos del doctor.";
        }
    }
}

$conn->close();
?>


?>
