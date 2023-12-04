<?php
require "db/conexion.php"; // Conexión a la base de datos "usuarios"

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Conexión a la base de datos "alumnos"
$connAlumnos = new mysqli("localhost", "root", "", "saeko");

if ($connAlumnos->connect_error) {
    die("Conexión fallida con la base de datos 'alumnos': " . $connAlumnos->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $matricula = $_POST['matricula'];
    $correo = $_POST['correo'];
    $grado = $_POST['grado']; // Asegúrate de incluir este campo en tu formulario HTML

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
        // Security: use a secure hashing algorithm
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Inserción en la base de datos "alumnos2"
        $insertQueryUsuarios = "INSERT INTO alumnos2 (nombre, matricula, grado, correo) VALUES (?, ?, ?, ?)";
        $insertStatementUsuarios = $conn->prepare($insertQueryUsuarios);
        $insertStatementUsuarios->bind_param("ssss", $username, $matricula, $grado, $correo);

        // Inserción en la base de datos "alumnos"
        $insertQueryAlumnos = "INSERT INTO alumnos (nombre, matricula, grado, id_materia) VALUES (?, ?, ?, ?)";
        $insertStatementAlumnos = $connAlumnos->prepare($insertQueryAlumnos);
        $insertStatementAlumnos->bind_param("ssss", $username, $matricula, $grado, $id_materia);

        if ($insertStatementUsuarios->execute()) {
            echo "Usuario registrado correctamente";

            // Registra al mismo alumno con id_materia del 1 al 7
            for ($id_materia = 1; $id_materia <= 7; $id_materia++) {
                $insertStatementAlumnos->bind_param("ssss", $username, $matricula, $grado, $id_materia);
                if (!$insertStatementAlumnos->execute()) {
                    echo "Error al registrar en la tabla 'alumnos': " . $insertStatementAlumnos->error;
                }
            }

            header("location: inicio_sesion.php");
            exit();
        } else {
            echo "Error al registrar en la tabla 'alumnos2': " . $insertStatementUsuarios->error;
        }
    }
}

$conn->close();
$connAlumnos->close();
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuarios</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Agrega tus estilos adicionales aquí -->
</head>

<body class="backcolor">
    <!-- Resto de tu código HTML -->
    <div class="titulo"><li> ¡Bienvenido! </li></div>    
    <div id="sesion">
        <div class="container">
            <form action="registro.php" method="POST">
                <li><input type="text" name="username" placeholder="Nombre completo" required></li>
                <li><input type="password" name="password" placeholder="Contraseña" required></li>
                <li><input type="number" name="matricula" placeholder="Matricula" maxlength="18" required></li>
                <li><input type="text" name="grado" placeholder="grado" required></li>
                <li><input type="text" name="correo" placeholder="Correo" required></li>
                <li><button type="submit">Registrarse</button><br></li>
                <h2>¿Ya tienes una cuenta?</h2> <h3><a href="inicio_sesion.php">Inicia sesión</a></h3>
            </form>
        </div>
    </div>
</body>

</html>
