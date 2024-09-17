<?php
include("conexion.php");

if ($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $correo = $_POST["correo"];
        $password = $_POST["password"];

        //hash para la contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        //consulta SQL para insertar el usuario con la contraseña hasheada
        $sql = "INSERT INTO Usuarios (Nombre, Apellido, CorreoElectronico, Contrasena) 
                VALUES ('$nombre', '$apellido', '$correo', '$hashedPassword')";

        // Ejecutamos la consulta
        if ($conn->query($sql) === TRUE) {
            echo "<h2>Usuario creado con éxito Felicidades!.</h2>";
        } else {
            echo "<h2>Error al crear el usuario revisa Bien que ingresaste mal!. " . $conn->error . "</h2>";
        }

        $conn->close();
    } else {
        echo "<h2>Error: solicitud incorrecta</h2>";
    }
} else {
    echo "<h2>Error de conexión: No se pudo conectar a la base de datos hay algo mal digitado :C </h2>";
}

?>

