<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>
<body>

    <h2>Registro de Usuario</h2>
    
    <form action="registro_prof.php" method="post">
        <label for="nombre">Nombre completo:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="contrasena">Clave:</label>
        <input type="password" id="contrasena" name="contrasena" required><br>

        <input type="submit" value="Registrar">
    </form>

</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];

    $conexion = new mysqli("localhost", "root", "", "saeko");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $stmt = $conexion->prepare("INSERT INTO maestros (nombre, email, contrasena) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $email, $contrasena);

    if ($stmt->execute()) {
        echo "Registro exitoso.";
        header("Location: inicio_ses_prof.php", true, 301);
        exit();
    } else {
        echo "Error al registrar: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
}
?>

