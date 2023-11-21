<?php
//file that cointain the connection to the database
require "db/conexion.php";
// verify the connection
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// get the data of form
$username = $_POST['username'];
$apellido = $_POST['apellido'];
$password = $_POST['password'];
$matricula = $_POST['matricula'];
$correo = $_POST['correo'];

// check if user exists
$query = "SELECT * FROM usuarios WHERE username='$username'";
$result = $conn->query($query);

    // if user dont exist, register a new
    $insertQuery = "INSERT INTO usuarios (username, apellido, password, matricula, correo) VALUES ('$username', '$apellido', '$password', '$matricula', '$correo')";
    if ($conn->query($insertQuery) === TRUE) {
        header("location: index.html");
        exit();
    } else {
        echo "Error al registrar: " . $conn->error;
    }

// close the db connection
$conn->close();
?>
