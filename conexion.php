<?php
$host = "localhost";
$usuario = "root";
$contrasena = ""; 
$base_datos = "sistemaventasboletos";

// Crear conexión
$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>
