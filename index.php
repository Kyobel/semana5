<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Crear Usuario</h1>
        <form action="crearUsuario.php" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" placeholder="Apellido" required>

            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" placeholder="Correo Electrónico" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" placeholder="Contraseña" required>

            <button type="submit">Crear Usuario</button>
        </form>

    <h1>Crear Viaje</h1>
        <form action="viajes.php" method="post">
            <label for="origen">Origen:</label>
            <input type="text" id="origen" name="origen" placeholder="Origen" required>

            <label for="destino">Destino:</label>
            <input type="text" id="destino" name="destino" placeholder="Destino" required>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required>

            <label for="hora">Hora:</label>
            <input type="time" id="hora" name="hora" required>

            <label for="precio">Precio:</label>
            <input type="text" id="precio" name="precio" placeholder="Precio" required>

            <label for="cupoDisponible">Cupo Disponible:</label>
            <input type="text" id="cupoDisponible" name="cupoDisponible" placeholder="Cupo Disponible" required>

            <button type="submit">Crear Viaje</button>
        </form>

    <h1>Crear Autobús</h1>
        <form action="autobuses.php" method="post">>
            <input type="text" name="numeroAutobus" placeholder="Número de Autobús" required>
            <input type="text" name="capacidad" placeholder="Capacidad" required>

            <button type="submit">Crear Autobús</button>
        </form>


        <h1>Crear Boleto</h1>
            <form action="boletos.php" method="post">
                <label for="idUsuario">ID Usuario:</label>
                <select name="idUsuario" required>
                    <?php
                    $queryUsuarios = "SELECT ID_Usuario, Nombre FROM Usuarios";
                    $resultUsuarios = $conn->query($queryUsuarios);

                    while ($rowUsuario = $resultUsuarios->fetch_assoc()) {
                        echo "<option value='" . $rowUsuario['ID_Usuario'] . "'>" . $rowUsuario['Nombre'] . "</option>";
                    }
                    ?>
                </select>

                <label for="idAutobus">ID Autobús:</label>
                <select name="idAutobus" required>
                    <?php
                    $queryAutobuses = "SELECT ID_Autobus, NumeroAutobus FROM Autobuses";
                    $resultAutobuses = $conn->query($queryAutobuses);

                    while ($rowAutobus = $resultAutobuses->fetch_assoc()) {
                        echo "<option value='" . $rowAutobus['ID_Autobus'] . "'>" . $rowAutobus['NumeroAutobus'] . "</option>";
                    }
                    ?>
                </select>

                <label for="idViaje">ID Viaje:</label>
                <select name="idViaje" required onchange="calcularDescuento()">
                    <?php
                    $queryViajes = "SELECT ID_Viaje, Precio FROM Viajes";
                    $resultViajes = $conn->query($queryViajes);

                    while ($rowViaje = $resultViajes->fetch_assoc()) {
                        echo "<option value='" . $rowViaje['ID_Viaje'] . "' data-precio='" . $rowViaje['Precio'] . "'>" . $rowViaje['ID_Viaje'] . "</option>";
                    }
                    ?>
                </select>

                <label for="idDescuento">ID Descuento:</label>
                <select name="idDescuento" required onchange="calcularDescuento()">
                    <?php
                    $queryDescuentos = "SELECT Id_Descuento, PorcentajeDescuento FROM Descuento";
                    $resultDescuentos = $conn->query($queryDescuentos);

                    while ($rowDescuento = $resultDescuentos->fetch_assoc()) {
                        echo "<option value='" . $rowDescuento['Id_Descuento'] . "' data-porcentaje='" . $rowDescuento['PorcentajeDescuento'] . "'>" . $rowDescuento['Id_Descuento'] . "</option>";
                    }
                    ?>
                </select>

                <label for="numeroAsiento">Número de Asiento:</label>
                <input type="text" name="numeroAsiento" placeholder="Número de Asiento" required>

                <label for="fechaCompra">Fecha de Compra:</label>
                <input type="date" name="fechaCompra" placeholder="Fecha de Compra" required>

                <label for="estadoBoleto">Estado del Boleto:</label>
                <input type="text" name="estadoBoleto" placeholder="Estado del Boleto" required>

                <label for="montoTotal">Monto Total:</label>
                <input type="text" name="montoTotal" placeholder="Monto Total" readonly>

                <label for="porcentajeDescuento">Porcentaje Descuento:</label>
                <input type="text" name="porcentajeDescuento" placeholder="Porcentaje Descuento" readonly>

                <button type="submit">Crear Boleto</button>
            </form>

            <script>
                function calcularDescuento() {
                    var idViajeSelector = document.querySelector("[name='idViaje']");
                    var idDescuentoSelector = document.querySelector("[name='idDescuento']");
                    var montoTotalInput = document.querySelector("[name='montoTotal']");
                    var porcentajeDescuentoInput = document.querySelector("[name='porcentajeDescuento']");

                    // Obtener el precio y el porcentaje de descuento seleccionados
                    var precio = parseFloat(idViajeSelector.options[idViajeSelector.selectedIndex].getAttribute('data-precio')) || 0;
                    var porcentajeDescuento = parseFloat(idDescuentoSelector.options[idDescuentoSelector.selectedIndex].getAttribute('data-porcentaje')) || 0;

                    // Calcular el MontoTotal y el % Descuento
                    var montoTotal = precio - (precio * (porcentajeDescuento / 100));

                    // Actualizar los campos en el formulario
                    montoTotalInput.value = montoTotal.toFixed(2);
                    porcentajeDescuentoInput.value = porcentajeDescuento.toFixed(2);
                }
                calcularDescuento();
            </script>

    <h1>Añadir Descuento</h1>
        <form action="descuentos.php" method="post">
            <label for="idViaje">ID Viaje:</label>
            <select id="idViaje" name="idViaje" required>
                <?php
                $queryViajes = "SELECT ID_Viaje FROM Viajes";
                $resultViajes = $conn->query($queryViajes);

                while ($rowViaje = $resultViajes->fetch_assoc()) {
                    echo "<option value='" . $rowViaje['ID_Viaje'] . "'>" . $rowViaje['ID_Viaje'] . "</option>";
                }
                ?>
            </select>

            <label for="descripcionDescuento">Descripción del Descuento:</label>
            <input type="text" id="descripcionDescuento" name="descripcionDescuento" placeholder="Descripción del Descuento" required>

            <label for="porcentajeDescuento">% Descuento:</label>
            <input type="text" id="porcentajeDescuento" name="porcentajeDescuento" placeholder="% Descuento" required>

            <label for="totalCosto">Total Costo:</label>
            <input type="text" id="totalCosto" name="totalCosto" placeholder="Total Costo" required>

            <button type="submit">Añadir Descuento</button>
        </form>

</body>
</html>\
