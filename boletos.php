<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUsuario = $_POST["idUsuario"];
    $idViaje = $_POST["idViaje"];
    $idAutobus = $_POST["idAutobus"];
    $numeroAsiento = $_POST["numeroAsiento"];
    $fechaCompra = $_POST["fechaCompra"];
    $estadoBoleto = $_POST["estadoBoleto"];
    $idDescuento = $_POST["idDescuento"];

    // Obtener el porcentaje de descuento del descuento seleccionado
    $queryPorcentaje = "SELECT PorcentajeDescuento FROM Descuento WHERE Id_Descuento = $idDescuento";
    $resultPorcentaje = $conn->query($queryPorcentaje);

    if ($resultPorcentaje->num_rows > 0) {
        $rowPorcentaje = $resultPorcentaje->fetch_assoc();
        $porcentajeDescuento = $rowPorcentaje['PorcentajeDescuento'];

        // Obtener el precio del viaje seleccionado
        $queryPrecioViaje = "SELECT Precio FROM Viajes WHERE ID_Viaje = $idViaje";
        $resultPrecioViaje = $conn->query($queryPrecioViaje);

        if ($resultPrecioViaje->num_rows > 0) {
            $rowPrecioViaje = $resultPrecioViaje->fetch_assoc();
            $precioViaje = $rowPrecioViaje['Precio'];

            // Calcular el MontoTotal con descuento
            $montoTotal = $precioViaje - ($precioViaje * ($porcentajeDescuento / 100));

            // consulta SQL para insertar el boleto
            $sql = "INSERT INTO Boletos (ID_Usuario, ID_Viaje, ID_Autobus, NumeroAsiento, FechaCompra, EstadoBoleto, MontoTotal, PorcentajeDescuento) 
                    VALUES ('$idUsuario', '$idViaje', '$idAutobus', '$numeroAsiento', '$fechaCompra', '$estadoBoleto', '$montoTotal', '$porcentajeDescuento')";

            // Ejecuta la consulta
            if ($conn->query($sql) === TRUE) {
                echo "<h2>Boleto creado con éxito</h2>";
            } else {
                echo "<h2>Error al crear el boleto :C verifica bien!. " . $conn->error . "</h2>";
            }
        } else {
            echo "<h2>Error: No se pudo obtener el precio del viaje, algo sucedio!. </h2>";
        }
    } else {
        echo "<h2>Error: No se pudo obtener el porcentaje de descuento, insertaste mal algun dato!.</h2>";
    }

    // Cierra la conexión
    $conn->close();
} else {
    echo "<h2>Error: Solicitud incorrecta</h2>";
}
?>