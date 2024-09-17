<?php
include("conexion.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idViaje = $_POST["idViaje"];
    $descripcionDescuento = $_POST["descripcionDescuento"];
    $porcentajeDescuento = $_POST["porcentajeDescuento"];
    $totalCosto = $_POST["totalCosto"];

    //consulta SQL para insertar el descuento
    $sql = "INSERT INTO Descuento (Id_Viaje, DescripcionDescuento, PorcentajeDescuento, TotalCosto) 
            VALUES ('$idViaje', '$descripcionDescuento', '$porcentajeDescuento', '$totalCosto')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "<h2>Descuento añadido con éxito Felicidades!.</h2>";
    } else {
        echo "<h2>Error al añadir el descuento, ingresa valores validos!. " . $conn->error . "</h2>";
    }

    $conn->close();
} else {
    echo "<h2>Error: solicitud incorrecta</h2>";
}
?>