<?php
// Conectar a la base de datos
$conn = new mysqli('localhost', 'root', '', 'clinicadb');
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener pacientes
$sql_pacientes = "SELECT id_paciente, nombre, documento FROM paciente";
$result_pacientes = $conn->query($sql_pacientes);

// Obtener médicos
$sql_medicos = "SELECT id_medico, nombre FROM medico";
$result_medicos = $conn->query($sql_medicos);

// Verificar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_paciente = $_POST['id_paciente'];
    $id_medico = $_POST['id_medico'];
    $diagnostico = $_POST['diagnostico'];
    $tratamiento = $_POST['tratamiento'];
    $fecha = $_POST['fecha'];

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO historial_clinico (id_paciente, id_medico, diagnostico, tratamiento, fecha) 
            VALUES (?, ?, ?, ?, ?)";

    // Preparar la declaración
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisss", $id_paciente, $id_medico, $diagnostico, $tratamiento, $fecha);

    // Ejecutar la declaración
    if ($stmt->execute()) {
        $_SESSION['mensaje'] = "Historial clínico registrado exitosamente.";
        header("Location: historialclinico.php");
        exit(); // Asegúrate de salir después de la redirección
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
} else {
    echo "No se han enviado datos.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserción de Historial Clínico</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Barra de navegación con botón de regresar a la derecha -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Historial Clínico</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <button class="btn btn-warning" onclick="regresar()">Regresar</button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center">
            <h2>Registro de Historial Clínico</h2>
        </div>
        <div class="card-body">
            <form action="historialclinico.php" method="POST">
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="id_paciente">Paciente</label>
                        <select class="form-control" id="id_paciente" name="id_paciente" required>
                            <option value="">Seleccione un paciente</option>
                            <?php
                            if ($result_pacientes->num_rows > 0) {
                                while($row = $result_pacientes->fetch_assoc()) {
                                    echo "<option value='" . $row['id_paciente'] . "'>" . htmlspecialchars($row['nombre']) . " (" . htmlspecialchars($row['documento']) . ")</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="id_medico">Médico</label>
                        <select class="form-control" id="id_medico" name="id_medico" required>
                            <option value="">Seleccione un médico</option>
                            <?php
                            if ($result_medicos->num_rows > 0) {
                                while($row = $result_medicos->fetch_assoc()) {
                                    echo "<option value='" . $row['id_medico'] . "'>" . htmlspecialchars($row['nombre']) . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="diagnostico">Diagnóstico</label>
                    <textarea class="form-control" id="diagnostico" name="diagnostico" rows="3" placeholder="Ingrese el diagnóstico del paciente" required></textarea>
                </div>

                <div class="form-group">
                    <label for="tratamiento">Tratamiento</label>
                    <textarea class="form-control" id="tratamiento" name="tratamiento" rows="3" placeholder="Describa el tratamiento recomendado" required></textarea>
                </div>

                <div class="form-group">
                    <label for="fecha">Fecha de atención</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" required>
                </div>

                <!-- Botones para Guardar y Modificar -->
                <div class="form-group text-center mt-4">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" onclick="editarHistorial()">Modificar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function editarHistorial() {
        alert("Función para modificar el historial en desarrollo...");
    }

    function regresar() {
        window.history.back(); // Regresar a la página anterior
    }
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
