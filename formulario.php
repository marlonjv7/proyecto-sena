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
        if (isset($_POST['namePatient'], $_POST['documentoPatient'], $_POST['emailPatient'], $_POST['passwordPatient'], $_POST['telefonoPatient'])) {
            $namePatient = $conn->real_escape_string($_POST['namePatient']);
            $documentoPatient = $conn->real_escape_string($_POST['documentoPatient']);
            $emailPatient = $conn->real_escape_string($_POST['emailPatient']);
            $passwordPatient = password_hash($_POST['passwordPatient'], PASSWORD_BCRYPT);
            $telefonoPatient = $conn->real_escape_string($_POST['telefonoPatient']);

            // Consulta para insertar datos del paciente
            $sql = "INSERT INTO paciente (rol_paciente, nombre, documento, correo, contrasena, telefono) 
                    VALUES ('$role', '$namePatient', '$documentoPatient', '$emailPatient', '$passwordPatient', '$telefonoPatient')";

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
        if (isset($_POST['nameDoctor'], $_POST['documentoDoctor'], $_POST['emailDoctor'], $_POST['passwordDoctor'], $_POST['telefonoDoctor'])) {
            $nameDoctor = $conn->real_escape_string($_POST['nameDoctor']);
            $documentoDoctor = $conn->real_escape_string($_POST['documentoDoctor']);
            $emailDoctor = $conn->real_escape_string($_POST['emailDoctor']);
            $passwordDoctor = password_hash($_POST['passwordDoctor'], PASSWORD_BCRYPT);
            $telefonoDoctor = $conn->real_escape_string($_POST['telefonoDoctor']);

            // Consulta para insertar datos del médico
            $sql = "INSERT INTO medico (rol_medico, nombre, documento, correo, telefono, contrasena) 
                    VALUES ('$role', '$nameDoctor', '$documentoDoctor', '$emailDoctor', '$telefonoDoctor', '$passwordDoctor')";

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
};

$conn->close();

?>