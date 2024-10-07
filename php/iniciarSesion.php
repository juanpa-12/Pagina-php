<?php
session_start();
include 'conexion.php'; // Archivo de conexión a la base de datos

// Habilitar visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitización y validación
    $correo = filter_var(trim($_POST['correo']), FILTER_SANITIZE_EMAIL);
    $contrasena = trim($_POST['contrasena']);

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo electrónico no es válido.";
    }

    if (strlen($contrasena) < 6) {
        $errores[] = "La contraseña debe tener al menos 6 caracteres.";
    }

    if (empty($errores)) {
        // Consulta para verificar si el usuario existe
        $query = "SELECT * FROM usuarios WHERE correo = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();

            // Verificación de la contraseña
            if (password_verify($contrasena, $usuario['contrasena'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_tipo'] = $usuario['rol'];

                // Redirigir según el rol del usuario
                if ($usuario['rol'] === 'administrador') {
                    header("Location: ../pagina_admin.php");
                } else {
                    header("Location: ../inicio.php");
                }
                exit;
            } else {
                $errores[] = "La contraseña es incorrecta.";
            }
        } else {
            $errores[] = "El correo electrónico no está registrado.";
        }

        $stmt->close();
    }

    // Mostrar errores en caso de que existan
    if (!empty($errores)) {
        // Redirigir de vuelta a la página de inicio de sesión con el mensaje de error
        header("Location: iniciar_sesion.php?alert=" . urlencode(implode(", ", $errores)));
        exit();
    }
}
?>
