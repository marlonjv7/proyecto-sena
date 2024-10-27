<!-- <?php
// Conectar a la base de datos
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
// ?> -->

<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["correo"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
    
  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>