<?php
// Conexión a la base de datos
$connection = new mysqli("localhost", "root", "", "clinicadb");

if ($connection->connect_error) {
    die("Error de conexión: " . $connection->connect_error);
}

// Consulta para obtener los registros de médicos y pacientes
$sql = "SELECT id_medico AS id, nombre, documento, correo, telefono, contrasena, 'Medico' AS rol FROM medico 
        UNION 
        SELECT id_paciente AS id, nombre, documento, correo, telefono, contrasena, 'Paciente' AS rol FROM paciente";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestión de Usuario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand mr-auto" href="#">Gestión de Usuario</a>
      <a href="historialclinico.php" class="btn btn-secondary ml-auto">Regresar</a>
    </div>
  </nav>

  <!-- Contenido Principal -->
  <div class="container mt-5">
    <h2 class="text-center mb-4">Listado de Usuarios</h2>
    
    <!-- Imagen debajo del título -->
    <div class="text-center mb-4">
      <img src="assets/img/medical-history.png" alt="Imagen de Gestión de Usuario" class="img-fluid">
    </div>

    <!-- Tabla de visualización de usuario -->
    <table class="table table-bordered">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Documento</th>
          <th>Correo</th>
          <th>Teléfono</th>
          <th>Contraseña</th>
          <th>Rol</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['nombre']; ?></td>
          <td><?php echo $row['documento']; ?></td>
          <td><?php echo $row['correo']; ?></td>
          <td><?php echo $row['telefono']; ?></td>
          <td><?php echo $row['contrasena']; ?></td>
          <td><?php echo $row['rol']; ?></td>
          <td class="d-flex gap-2">
            <a href="editarDatosPerfiles.php?id_medico=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Editar</a>
            <a href="EliminarPerfil.php?id_medico=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</a>
          </td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $connection->close(); ?>
