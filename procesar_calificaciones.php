<?php
// Conexión a la base de datos (ajusta las credenciales)
$conexion = new mysqli("localhost", "root", "", "saeko");

// Verificar la conexión
if ($conexion->connect_error) {
    die("La conexión falló: " . $conexion->connect_error);
}

// Verificar si se recibió el formulario de calificaciones
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener el ID de la materia y las calificaciones del formulario
    $id_materia = $_POST['id_materia'];
    $calificaciones = $_POST['calificacion'];

    // Eliminar las calificaciones existentes para la materia
    $eliminar_calificaciones = "DELETE FROM calificaciones WHERE id_materia = $id_materia";
    if (!$conexion->query($eliminar_calificaciones)) {
        die("Error al eliminar calificaciones existentes: " . $conexion->error);
    }

    // Insertar las nuevas calificaciones en la base de datos
    foreach ($calificaciones as $id_alumno => $calificacion) {
        $insertar_calificacion = "INSERT INTO calificaciones (id_materia, id_alumno, calificacion) VALUES ($id_materia, $id_alumno, '$calificacion')";
        if (!$conexion->query($insertar_calificacion)) {
            die("Error al insertar calificación: " . $conexion->error);
        }
    }

    echo "Calificaciones guardadas exitosamente.";
} else {
    echo "Error: No se recibió el formulario de calificaciones.";
}

// Cerrar la conexión
$conexion->close();
?>
