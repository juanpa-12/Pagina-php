<?php
session_start();
include('conexion.php');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'message' => 'No se ha iniciado sesión.']);
    exit();
}

// Obtener el ID del cliente desde la sesión
$cliente_id = $_SESSION['usuario_id'];

// Consulta para obtener las notificaciones del cliente
$sql = "SELECT tipo, descripcion, fecha FROM notificaciones WHERE cliente_id = '$cliente_id' ORDER BY fecha DESC";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo json_encode(['success' => false, 'message' => 'Error en la consulta: ' . mysqli_error($conn)]);
    exit();
}

$notificaciones = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $notificaciones[] = $row;
    }
}

echo json_encode(['success' => true, 'notificaciones' => $notificaciones]);
?>
