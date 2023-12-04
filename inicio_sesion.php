<?php
// Archivo que contiene la conexión a la base de datos
require "db/conexion.php";
session_start();

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Consultar la contraseña de la base de datos
    $sql = "SELECT password FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($savedPassword);
    $stmt->fetch();
    $stmt->close();

    // Verificar si la contraseña es correcta
    if ($password == $savedPassword) {
        $_SESSION["username"] = $username;
        header("Location: interfaz_alum.php");
        exit();
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body class="backcolor">

    <div class="titulo"><li>¡Bienvenido! Inicia Sesión</li></div>   
    <div id="sesion">
    <div class="container">
    
        <form action="inicio_sesion.php" method="POST">
            <li><input type="text" name="username" placeholder="Nombre completo" required></li>
            <li><input type="password" name="password" placeholder="Contraseña" required></li>
            <li><button type="submit">Iniciar sesión</button><br></li>
            <h2>¿No tienes una cuenta?</h2> <h3><a href="inicio_ses_prof.php">¿Eres Maestro?</a></h3> <h3><a href="registro.php">Regístrate</a></h3> 
      </form>
    </div>
    </div>

</body>

</html>
