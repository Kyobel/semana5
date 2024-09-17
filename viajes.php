<?php
include("conexion.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $origen = $_POST["origen"];
    $destino = $_POST["destino"];
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];
    $precio = $_POST["precio"];
    $cupoDisponible = $_POST["cupoDisponible"];

    //consulta SQL para insertar el viaje con marcadores de posición
    $sql = "INSERT INTO Viajes (Origen, Destino, Fecha, Hora, Precio, CupoDisponible) VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssssdi", $origen, $destino, $fecha, $hora, $precio, $cupoDisponible);

    if ($stmt->execute()) {
        echo "Viaje creado con éxito";
    } else {
        echo "Error al crear el viaje: " . $stmt->error;
    }
    
    $conn->close();
}
?>