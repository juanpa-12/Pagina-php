<?php

include('conexion.php');
session_start(); 


if (isset($_POST['registro'])) {
    $nombre = $_POST['nombres'];
    $apellido = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];


    if ($contrasena === $confirmar_contrasena) {

        $contrasena_encriptada = password_hash($contrasena, PASSWORD_BCRYPT);

      
        $rol = 'cliente';  

     
        if (strpos($correo, '@empresa.com') !== false) {
            $rol = 'administrador';
        }


        $sql = "INSERT INTO usuarios (nombre, apellido, correo, contrasena, rol) VALUES ('$nombre', '$apellido', '$correo', '$contrasena_encriptada', '$rol')";

 
        if (mysqli_query($conn, $sql)) {
            $_SESSION['registro_exitoso'] = 'Registro exitoso. Bienvenido, ' . $rol . '!'; 
            header("Location: inicio_sesion.php"); 
            exit; 
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Las contraseñas no coinciden.');</script>";
    }
}
?>