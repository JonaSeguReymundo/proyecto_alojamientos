<?php
include("../includes/config.php");

// Verificar si usuario está logueado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id_alojamiento = intval($_GET['id']);
    $id_usuario = $_SESSION['id'];

    $sql = "DELETE FROM usuarios_alojamientos WHERE usuario_id=$id_usuario AND alojamiento_id=$id_alojamiento";
    if ($conn->query($sql)) {
        $_SESSION['mensaje'] = "Alojamiento eliminado correctamente.";
    } else {
        $_SESSION['error'] = "Error al eliminar alojamiento.";
    }
}

header("Location: dashboard.php");
exit;
?>