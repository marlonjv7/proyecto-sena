<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: iniciosesion.html");
    exit();
}

// Obtener los datos del usuario de la sesión
$user_id = $_SESSION['user_id'];
$user_rol = $_SESSION['user_rol'];
$user_name = $_SESSION['user_name'];
$user_documento = $_SESSION['user_documento'];
$user_correo = $_SESSION['user_correo'];
$user_telefono = $_SESSION['user_telefono'];
$user_password = $_SESSION['user_password'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial Clínico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Mi Historial Clínico</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Cerrar sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sección de perfil -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <!-- Tarjeta de perfil -->
                <div class="card">
                    <img src="assets/img/medical-history.png" class="card-img-top" alt="Foto de perfil">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo htmlspecialchars($user_name); ?></h5>
                        <p class="card-text"><?php echo ucfirst($user_rol); ?></p>
                    </div>
                </div>
            </div>

            <!-- Información del usuario -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Información del usuario</h5>
                        <p><strong>Documento:</strong> <?php echo htmlspecialchars($user_documento); ?></p>
                        <p><strong>Correo Electrónico:</strong> <?php echo htmlspecialchars($user_correo); ?></p>
                        <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($user_telefono); ?></p>
                        <p><strong>Contraseña:</strong> <?php echo htmlspecialchars($user_password); ?></p>
                        <hr>

                        <!-- Botones de acciones -->
                        <div class="d-grid gap-3">
                            <!-- <button class="btn btn-primary" onclick="descargarHistorial()">Descargar Historial Clínico</button> -->
                            <!-- <button class="btn btn-secondary" onclick="verAtencion()">Visualizar Atención Recibida</button> -->
                            <button class="btn btn-secondary" onclick="location.href='editarPerfil.php'">Editar datos de perfil</button>
                            
                            <!-- Mostrar botón de Registrar Historial Clínico solo para médicos -->
                            <?php if ($user_rol === 'medico'): ?>
                                <button class="btn btn-warning" onclick="location.href='historial.php'">Registrar Historial Clínico</button>
                                <button class="btn btn-info" onclick="location.href='Perfil.php'">Ver Perfil</button>
                                <button class="btn btn-success" onclick="location.href='consultaHistorial.php'">Consulta Historial Clínico</button> <!-- Nuevo botón de consulta -->
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Funciones de descarga y visualización -->
    <script>
        function descargarHistorial() {
            alert("Descargando historial clínico...");
            window.location.href = 'ruta-al-historial-clinico.pdf';
        }

        function verAtencion() {
            alert("Redirigiendo a la página de atención recibida...");
            window.location.href = 'pagina-atencion-recibida.html';
        }
    </script>

</body>
</html>
