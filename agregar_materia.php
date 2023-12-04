<?php
// Conexión a la base de datos (ajusta las credenciales)
$conexion = new mysqli("localhost", "root", "", "saeko");

// Verificar la conexión
if ($conexion->connect_error) {
    die("La conexión falló: " . $conexion->connect_error);
}

// Verificar si se recibió una nueva materia desde el formulario
if (isset($_POST['nueva_materia'])) {
    // Obtener la nueva materia del formulario
    $nueva_materia = $_POST['nueva_materia'];

    // Preparar la consulta SQL para insertar la nueva materia
    $consulta = "INSERT INTO materias (nombre) VALUES ('$nueva_materia')";

    // Ejecutar la consulta
    if ($conexion->query($consulta) === TRUE) {
        header("Location: interfaz_prof.php", true, 301);
exit();
    } else {
        echo "Error al agregar la materia: " . $conexion->error;
    }
} else {
    echo "Error: No se recibió una nueva materia.";
}

// Cerrar la conexión
$conexion->close();
?>
