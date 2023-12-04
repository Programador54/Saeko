<?php
//file that contains db connection
require "db/conexion.php";
session_start();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//get data form
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    //get the hash
    $sql = "SELECT password FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hash);
    $stmt->fetch();

    //check if the user and password are corrects
    if (password_verify($password, $hash)) {
        $_SESSION["username"] = $username;
        header("Location: index.php");
        exit();
    } else {
<<<<<<< HEAD
        // security: use a secure hashing algorithm
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insertQuery = "INSERT INTO usuarios (username, apellido, password, matricula, correo) VALUES (?, ?, ?, ?, ?)";
        $insertStatement = $conn->prepare($insertQuery);
        $insertStatement->bind_param("sssss", $username, $apellido, $hashedPassword, $matricula, $correo);

        if ($insertStatement->execute()) {
            echo "Usuario registrado correctamente";
            header("location: .php");
            exit();
        } else {
            echo "Error al registrar: " . $insertStatement->error;
        }
=======
        echo "Usuario o contraseña incorrectos";
>>>>>>> a5f71f4b37bd241d9bca55d51e8be23f8e6c6a67
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
<<<<<<< HEAD
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body class="backcolor">
    <div class="titulo">
        <li> Ingresa tus datos:<br> </li>
    </div>
    <div id="sesion">
        <div class="container">
            <form action="inicio_sesion.php" method="POST">
                <li><input type="text" name="username" placeholder="Usuario" required></li>
                <li><input type="password" name="password" placeholder="Contraseña" required></li>
                <li><button type="submit">Iniciar sesión</button><br></li>
            </form>
        </div>
=======
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Inicio de sesión</title>
</head>

<body class="backcolor">
<<<<<<< HEAD

    <div class="titulo"><li> iBienvenido Inicia Sesion!    </li></div>   
    <div id="sesion">
    <div class="container">
    
        <form action="iniciar_sesion.php" method="POST">
            <li><input type="text" name="username" placeholder="Nombre completo" required></li>
            <li><input type="password" name="password" placeholder="Contraseña" required></li>
            <li><input type="number" name="matricula" placeholder="Matricula" maxlength="18" required></li>
            <li><input type="text" name="correo" placeholder="Correo" required></li>
            <li><button type="submit">Iniciar sesion</button><br></li>
            <h2>¿No tienes una cuenta?</h2> <h3><a href="inicio_ses_prof.php">¿Eres Maestro?</a></h3> <h3><a href="registro.php">Registrate</a></h3> 
      </form>
    </div>
    </div>

=======
<div id="sesion"> 
<div class="container">
    <div class="titulo">Ingresa tus datos:<br>
      <form action="inicio_sesion.php" method="POST">
        <input type="text" name="username" placeholder="Usuario" required class="input">
        <input type="password" name="password" placeholder="Contraseña" required class="input">
        <button type="submit" class="button">Iniciar sesión</button><br>
      </form>
>>>>>>> 77cc1045b6d105f0d27e40a0edcf61fbb9621f94
    </div>
</div>
  </div>
>>>>>>> a5f71f4b37bd241d9bca55d51e8be23f8e6c6a67

</body>

</html>
