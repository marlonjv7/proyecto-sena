<?php
// Conectar a la base de datos
$connection = new mysqli("localhost", "root", "", "clinicadb");

if ($connection->connect_error) {
    die("Error de conexión: " . $connection->connect_error);
}

$historiales = [];

// Verificar si se ha enviado una consulta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $connection->real_escape_string($_POST['search']);

    // Consultar en la base de datos por id, nombre o documento
    $sql = "SELECT hc.id_historial, p.nombre AS paciente_nombre, p.documento AS paciente_documento, 
                   hc.diagnostico, hc.tratamiento, hc.fecha 
            FROM historial_clinico hc
            JOIN paciente p ON hc.id_paciente = p.id_paciente
            WHERE p.id_paciente LIKE '%$search%' 
               OR p.nombre LIKE '%$search%' 
               OR p.documento LIKE '%$search%'";

    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $historiales = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $mensaje = "No se encontraron historiales clínicos para la búsqueda realizada.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consulta Historiales Clínicos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5 d-flex flex-column">
    <h2 class="text-center mb-4">Consulta Historiales Clínicos</h2>
    <form method="POST" class="mb-4">
      <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Buscar por ID, Nombre o Cédula del paciente" required>
        <button class="btn btn-primary" type="submit">Buscar</button>
      </div>
    </form>

    <?php if (isset($mensaje)): ?>
      <div class="alert alert-warning"><?php echo $mensaje; ?></div>
    <?php endif; ?>

    <?php if (!empty($historiales)): ?>
      <table class="table table-bordered">
        <thead class="table-dark">
          <tr>
            <th>ID Historial</th>
            <th>Nombre del Paciente</th>
            <th>Cédula</th>
            <th>Diagnóstico</th>
            <th>Tratamiento</th>
            <th>Fecha</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($historiales as $historial): ?>
            <tr>
              <td><?php echo $historial['id_historial']; ?></td>
              <td><?php echo htmlspecialchars($historial['paciente_nombre']); ?></td>
              <td><?php echo htmlspecialchars($historial['paciente_documento']); ?></td>
              <td><?php echo htmlspecialchars($historial['diagnostico']); ?></td>
              <td><?php echo htmlspecialchars($historial['tratamiento']); ?></td>
              <td><?php echo htmlspecialchars($historial['fecha']); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
    
    <div class="mx-auto">
        <a href="historialclinico.php" class="btn btn-secondary ml-auto">Regresar</a>
    </div>
  </div>

  

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $connection->close(); ?>
