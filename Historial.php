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
    $id_paciente = $_POST['id_paciente'];
    $id_medico = $_POST['id_medico'];
    $diagnostico = $_POST['diagnostico'];
    $tratamiento = $_POST['tratamiento'];
    $fecha = $_POST['fecha'];

    $sql = "INSERT INTO historial_clinico (id_paciente, id_medico, diagnostico, tratamiento, fecha) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisss", $id_paciente, $id_medico, $diagnostico, $tratamiento, $fecha);

    if ($stmt->execute()) {
        $_SESSION['mensaje'] = "Historial clínico registrado exitosamente.";
        header("Location: historialclinico.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
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
        // Aquí podrías implementar una redirección o cargar los datos en el formulario para edición.
        // Ejemplo de redirección: window.location.href = 'editar_historial.php?id=' + id;
    }
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
