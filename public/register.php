<?php
include("../includes/config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "INSERT INTO usuarios (nombre, email, password, tipo) VALUES ('$nombre', '$email', '$password', 'usuario')";
    if ($conn->query($sql)) {
        header("Location: login.php");
        exit;
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Crear Cuenta</h2>
        <?php if(!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post" class="mx-auto" style="max-width: 400px;">
            <div class="mb-3">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Registrarse</button>
            <p class="mt-2 text-center">¿Ya tienes cuenta? <a href="login.php">Iniciar Sesión</a></p>
        </form>
    </div>
</body>

</html>