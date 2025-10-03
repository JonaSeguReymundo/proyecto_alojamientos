<?php
include("../includes/config.php");
if (!isset($_SESSION['id'])) { header("Location: login.php"); exit; }

$id_usuario = $_SESSION['id'];

if (isset($_GET['add'])) {
    $id_alojamiento = intval($_GET['add']);
    $conn->query("INSERT INTO usuarios_alojamientos (usuario_id, alojamiento_id) VALUES ($id_usuario, $id_alojamiento)");
}

if (isset($_GET['del'])) {
    $id_alojamiento = intval($_GET['del']);
    $conn->query("DELETE FROM usuarios_alojamientos WHERE usuario_id=$id_usuario AND alojamiento_id=$id_alojamiento");
}
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
        <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>

        <h3 class="mt-4">Mis Alojamientos</h3>
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
                <a href="?del=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger">Eliminar</a>
            </li>
            <?php endwhile; ?>
        </ul>

        <h3 class="mt-4">Todos los Alojamientos</h3>
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
</body>

</html>