<?php
include("../includes/config.php");
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$id_usuario = $_SESSION['id'];

// Añadir alojamiento
if (isset($_GET['add'])) {
    $id_alojamiento = intval($_GET['add']);
    $conn->query("INSERT INTO usuarios_alojamientos (usuario_id, alojamiento_id) VALUES ($id_usuario, $id_alojamiento)");
    $_SESSION['mensaje'] = "Alojamiento agregado correctamente.";
    header("Location: dashboard.php");
    exit;
}

// Mostrar mensajes de alerta
$mensaje = $_SESSION['mensaje'] ?? '';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['mensaje'], $_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mi Cuenta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Bienvenido Usuario</h2>
        <a href="logout.php" class="btn btn-danger mb-3">Cerrar Sesión</a>

        <?php if ($mensaje): ?>
        <div class="alert alert-success"><?php echo $mensaje; ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-6">
                <h3>Mis Alojamientos</h3>
                <ul class="list-group">
                    <?php
                $sql = "SELECT a.* FROM alojamientos a 
                        JOIN usuarios_alojamientos ua ON a.id=ua.alojamiento_id 
                        WHERE ua.usuario_id=$id_usuario";
                $res = $conn->query($sql);
                while($row = $res->fetch_assoc()):
                ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo $row['nombre']; ?>
                        <a href="eliminar.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger">Eliminar</a>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </div>

            <div class="col-md-6">
                <h3>Todos los Alojamientos</h3>
                <ul class="list-group">
                    <?php
                $res = $conn->query("SELECT * FROM alojamientos");
                while($row = $res->fetch_assoc()):
                ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo $row['nombre']; ?>
                        <a href="?add=<?php echo $row['id']; ?>" class="btn btn-sm btn-success">Añadir</a>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>