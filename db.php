<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'datos_dgsp';

// Crear conexión
$conn = new mysqli($host, $user, $pass, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
