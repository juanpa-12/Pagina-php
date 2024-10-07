<?php
$servername = "localhost";
$username = "root"; 
$password = "";     
$dbname = "prueba";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

register_shutdown_function(function() use ($conn) {
    if ($conn) {
        $conn->close();
    }
});
?>
