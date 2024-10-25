<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Formulario de Inicio de Sesión</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="row justify-content-center" style="margin-top: 100px;">
        <div class="col-md-6">
            <h2 class="text-center">Iniciar Sesión</h2>
            <form>
                <div class="form-group">
                    <label for="username">Nombre de Usuario</label>
                    <input type="text" class="form-control" id="username" placeholder="Ingrese su nombre de usuario" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" placeholder="Ingrese su contraseña" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
            </form>
            <div class="text-center" style="margin-top: 10px;">
                <a href="#">¿Olvidaste tu contraseña?</a>
            </div>
            <div class="text-center" style="margin-top: 10px;">
                <a href="#">¿No tienes una cuenta? Regístrate aquí</a>
            </div>
        </div>
    </div>
</div>

<!-- Enlace a Bootstrap JS y dependencias de jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
