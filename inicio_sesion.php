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
  <link rel="stylesheet" href="styles.css">
  <title>Inicio de sesión</title>
</head>

<body class="backcolor">
<div id="sesion"> 
<div class="container">
    <div class="titulo">Ingresa tus datos:<br>
      <form action="inicio_sesion.php" method="POST">
        <input type="text" name="username" placeholder="Usuario" required class="input">
        <input type="password" name="password" placeholder="Contraseña" required class="input">
        <button type="submit" class="button">Iniciar sesión</button><br>
      </form>
    </div>
</div>
  </div>

</body>

</html>
