<?php
session_start();
include('conexion.php');

// Obtener datos de la solicitud
$json = file_get_contents("php://input");
if (!$json) {
    echo json_encode(['success' => false, 'message' => 'No se recibió datos.']);
    exit();
}

$data = json_decode($json, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['success' => false, 'message' => 'Error en el formato JSON.']);
    exit();
}

// Obtener datos sin validación
$cliente_id = $data['cliente_id'] ?? null; 
$tipo = $data['tipo'] ?? null;
$descripcion = $data['descripcion'] ?? ''; // Permitir descripción vacía

// Validar que el cliente_id y tipo no sean nulos antes de insertar
if (is_null($cliente_id) || is_null($tipo)) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos requeridos.']);
    exit();
}

// Insertar la notificación en la base de datos
$sql = "INSERT INTO notificaciones (cliente_id, tipo, descripcion) VALUES ('$cliente_id', '$tipo', '$descripcion')";
if (mysqli_query($conn, $sql)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error en la base de datos.']);
}
?>
