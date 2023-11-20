<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "saeko";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recuperar datos del formulario
$username = $_POST['username'];
$apellido = $_POST['apellido'];
$password = $_POST['password'];
$matricula = $_POST['matricula'];
$correo = $_POST['correo'];

// Verificar si el usuario ya existe en la base de datos
$query = "SELECT * FROM usuarios WHERE username='$username'";
$result = $conn->query($query);

    // El usuario no existe, registrar en la base de datos
    $insertQuery = "INSERT INTO usuarios (username, apellido, password, matricula, correo) VALUES ('$username', '$apellido', '$password', '$matricula', '$correo')";
    if ($conn->query($insertQuery) === TRUE) {
        header("location: index.html");
        exit();
    } else {
        echo "Error al registrar: " . $conn->error;
    }

// Cerrar la conexión a la base de datos
$conn->close();
?>
