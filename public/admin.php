<?php
include("../includes/config.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo'] != 'admin') {
    header("Location: login.php"); exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $desc = $_POST['descripcion'];
    $ubicacion = $_POST['ubicacion'];
    $precio = $_POST['precio'];
    $imagen = $_POST['imagen'];

    $conn->query("INSERT INTO alojamientos (nombre, descripcion, ubicacion, precio, imagen) 
                  VALUES ('$nombre','$desc','$ubicacion',$precio,'$imagen')");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Panel de Administrador</h2>
        <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>

        <h3 class="mt-4">Agregar Alojamiento</h3>
        <form method="post" style="max-width: 500px;">
            <div class="mb-3">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Descripción</label>
                <textarea name="descripcion" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label>Ubicación</label>
                <input type="text" name="ubicacion" class="form-control">
            </div>
            <div class="mb-3">
                <label>Precio</label>
                <input type="number" step="0.01" name="precio" class="form-control">
            </div>
            <div class="mb-3">
                <label>Imagen (archivo en assets/img/)</label>
                <input type="text" name="imagen" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
    </div>
</body>

</html>