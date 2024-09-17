<?php
include("conexion.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numeroAutobus = $_POST["numeroAutobus"];
    $capacidad = $_POST["capacidad"];

    //consulta SQL para insertar el autobús
    $sql = "INSERT INTO Autobuses (NumeroAutobus, Capacidad) VALUES ('$numeroAutobus', '$capacidad')";

    // Ejecutar consulta
    if ($conn->query($sql) === TRUE) {
        echo "<h2>Autobús creado con éxito :D </h2>";
    } else {
        echo "<h2>Error al crear el autobús D: : " . $conn->error . "</h2>";
    }

    // Cerrar la conexión
    $conn->close();
} else {
    echo "<h2>Error: solicitud incorrecta</h2>";
}
?>