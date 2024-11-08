<?php
$servername = "127.0.0.1";
$username = "root";
$password = ""; // Asegúrate de que la contraseña sea correcta.
$dbname = "login_system"; // Usa el nombre de la base de datos que importaste en phpMyAdmin
$port = 3306; // Puerto de conexión

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
