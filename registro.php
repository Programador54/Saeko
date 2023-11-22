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
    // ...

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
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        #container {
            border: 2px solid #ccc;
            border-radius: 10px;
            padding: 30px;
            width: 30%;
            text-align: center;
            background-color: #DF3713;
        }

        input {
            margin-bottom: 10px;
            padding: 5px;
            width: 75%;
            border-radius: 10px;

        }

        button {
            width: 85%;
            padding: 10px;
            border-radius: 10px;
        }

        h2 {
            align-items: justify;
            padding: 5px;
            text-decoration: underline;

        }
    </style>
</head>

<body>
    <div id="container">
        <h2>Bienvenido!, registrate:</h2>
        <form action="registro.php" method="POST">
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="text" name="apellido" placeholder="Apellido" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="number" name="matricula" placeholder="Matricula" maxlength="18" required>
            <input type="text" name="correo" placeholder="Correo" required>
            <button type="submit">Registrarse</button><br>
            <h2>¿Ya tienes una cuenta?, <a href="inicio_sesion.php">Inicia sesión</a></h2>
        </form>
    </div>
</body>

</html>