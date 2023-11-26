<?php
//file that contains db connection
require "db/conexion.php";
session_start();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//get data form
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
        echo "Usuario o contraseña incorrectos";
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .form {
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

<body class="backcolor">

    <div class="titulo"><li> iBienvenido Registrate!    </li></div>   
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