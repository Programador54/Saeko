<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>

    <h2>Iniciar Sesión</h2>
    
    <form action="inicio_ses_prof.php" method="post">
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="contrasena">Clave:</label>
        <input type="password" id="contrasena" name="contrasena" required><br>

        <input type="submit" value="Iniciar Sesión">
    </form>
    <h3>¿No tienes cuenta?</h3>
    <h3><a href="registro_prof.php">Registrate</a></h3>
</body>
</html>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];

    $conexion = new mysqli("localhost", "root", "", "saeko");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $stmt = $conexion->prepare("SELECT id, nombre, contrasena FROM maestros WHERE email = ?");
    
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $nombre, $contrasena_db);

    if ($stmt->fetch()) {
        if ($contrasena == $contrasena_db) {
            $_SESSION["usuario_id"] = $id;
            $_SESSION["usuario_nombre"] = $nombre;
            echo "Inicio de sesión exitoso.";
            header("Location: interfaz_prof.php", true, 301);
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }

    $stmt->close();
    $conexion->close();
}
?>
