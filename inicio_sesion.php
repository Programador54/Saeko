<?php
require "db/conexion.php";

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $apellido = $_POST['apellido'];
    $password = $_POST['password'];
    $matricula = $_POST['matricula'];
    $correo = $_POST['correo'];

    // Validación de datos del formulario

    $query = "SELECT * FROM usuarios WHERE username=?";
    $statement = $conn->prepare($query);
    $statement->bind_param("s", $username);
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows > 0) {
        echo "El usuario ya existe";
    } else {
        // security: use a secure hashing algorithm
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insertQuery = "INSERT INTO usuarios (username, apellido, password, matricula, correo) VALUES (?, ?, ?, ?, ?)";
        $insertStatement = $conn->prepare($insertQuery);
        $insertStatement->bind_param("sssss", $username, $apellido, $hashedPassword, $matricula, $correo);

        if ($insertStatement->execute()) {
            echo "Usuario registrado correctamente";
            header("location: inicio_sesion.php");
            exit();
        } else {
            echo "Error al registrar: " . $insertStatement->error;
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuarios</title>
    <link rel="stylesheet" href="styles.css">
    <style>

    </style>
</head>

<body class="backcolor">

    <div class="titulo"><li> iBienvenido Inicia Sesion!    </li></div>   
    <div id="sesion">
    <div class="container">
    
        <form action="registro.php" method="POST">
            <li><input type="text" name="username" placeholder="Usuario" required></li>
            <li><input type="text" name="apellido" placeholder="Apellido" required></li>
            <li><input type="password" name="password" placeholder="Contraseña" required></li>
            <li><input type="number" name="matricula" placeholder="Matricula" maxlength="18" required></li>
            <li><input type="text" name="correo" placeholder="Correo" required></li>
            <li><button type="submit">Registrarse</button><br></li>
            <h2>¿Ya tienes una cuenta?</h2> <h3><a href="inicio_sesion.php">Inicia sesión</a></h3>
      </form>
    </div>
    </div>


</body>

</html>
