<?php
$connection = new mysqli("localhost", "root", "", "clinicadb");

if ($connection->connect_error) {
    die("Error de conexión: " . $connection->connect_error);
}

$result = $connection->query("SELECT * FROM medico");

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestión de Usuario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .notification {
      display: none;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Gestión de Usuario</a>
    </div>
  </nav>

  <!-- Contenido Principal -->
  <div class="container mt-5 d-flex flex-column">
    <h2 class="text-center mb-4"></h2>
    
    <!-- Imagen debajo del título -->
    <div class="text-center mb-4">
      <img src="assets/img/medical-history.png" alt="Imagen de Gestión de Usuario" class="img-fluid">
    </div>

    <!-- Notificaciones -->
    <div id="notification" class="alert alert-success notification" role="alert"></div>

    <!-- Tabla de visualización de usuario -->
    <table class="table table-bordered table-responsive d-flex flex-column w-100">
      <thead class="table-dark w-100">
        <tr class="w-100">
          <th>ID</th>
          <th>Nombre</th>
          <th>Documento</th>
          <th>Correo</th>
          <th>Teléfono</th>
          <th>Contraseña</th>
        </tr>
      </thead>
      <tbody class="w-100">
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td id="id-medico"><?php echo $row['id_medico']; ?></td>
          <td id="nombre"><?php echo $row['nombre']; ?></td>
          <td id="documento"><?php echo $row['documento']; ?></td>
          <td id="correo"><?php echo $row['correo']; ?></td>
          <td id="telefono"><?php echo $row['telefono']; ?></td>
          <td id="contrasena"><?php echo $row['contrasena']; ?></td>
          <td class="d-flex gap-5">
            <button class="btn btn-primary btn-sm" onclick="location.href='EditarPerfil.php?id_medico=<?php echo $row['id_medico']; ?>'">Editar</button>
            <button class="btn btn-secondary btn-sm" onclick="cancelarCambios()">Cancelar</button>
            <button class="btn btn-danger btn-sm" onclick="eliminarUsuario()">Eliminar</button>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

    <!-- Botones adicionales alineados a la derecha -->
    <div class="d-flex justify-content-end mt-3">
      <button class="btn btn-success me-2" onclick="location.href='historialclinico.php'">Guardar</button>
      <button class="btn btn-info" onclick="verDetalle()">Ver Detalle</button>
    </div>
  </div>

  <!-- Modal para editar usuario -->
  <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editUserModalLabel">Editar Usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editUserForm">
            <div class="mb-3">
              <label for="editNombre" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="editNombre" required>
            </div>
            <div class="mb-3">
              <label for="editDocumento" class="form-label">Documento</label>
              <input type="text" class="form-control" id="editDocumento" required>
            </div>
            <div class="mb-3">
              <label for="editCorreo" class="form-label">Correo</label>
              <input type="email" class="form-control" id="editCorreo" required>
            </div>
            <div class="mb-3">
              <label for="editTelefono" class="form-label">Teléfono</label>
              <input type="text" class="form-control" id="editTelefono" required>
            </div>
            <div class="mb-3">
              <label for="editContrasena" class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="editContrasena" required>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" onclick="guardarCambios()">Guardar Cambios</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS y JavaScript para las acciones -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function abrirModalEditar() {
      const modal = new bootstrap.Modal(document.getElementById('editUserModal'));
      modal.show();
    }

    function guardarCambios() {
      // Simulando guardado de cambios
      document.getElementById('notification').innerText = "Cambios guardados con éxito.";
      document.getElementById('notification').style.display = 'block';
      setTimeout(() => {
        document.getElementById('notification').style.display = 'none';
      }, 3000);
      cancelarCambios();
    }

    function cancelarCambios() {
      alert("Edición cancelada.");
      document.getElementById('editUserForm').reset();
      const modal = bootstrap.Modal.getInstance(document.getElementById('editUserModal'));
      if (modal) {
        modal.hide();
      }
    }

    function verDetalle() {
      alert("Detalles del usuario: \nNombre: John Doe\nDocumento: 12345678\nCorreo: john@example.com\nTeléfono: 123-456-7890");
    }

    function eliminarUsuario() {
      if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
        alert("Usuario eliminado.");
        document.querySelector('table tbody').innerHTML = '';
      }
    }

    function cerrarSesion() {
      alert("Has cerrado sesión.");
    }
  </script>
</body>
</html>

<?php $connection->close(); ?>