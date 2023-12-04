<?php
require "db/conexion.php";
session_start();

// Obtén la lista de materias y profesores
$consulta_materias = "SELECT * FROM materias";
$resultado_materias = $conn->query($consulta_materias);

// Verifica si la sesión está iniciada y si existe el nombre de usuario
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // Si no hay una sesión iniciada, redirige a la página de inicio de sesión
    header("Location: inicio_sesion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Calificaciones de Alumnos</title>
    <link rel="stylesheet" type="text/css" href="estilo_interfaz_prof.css">
</head>

<body>
    <header>
        <h1>Bienvenido <?php echo $username; ?></h1>
    </header>

    <?php
    // Iterar sobre las materias y mostrar las calificaciones de los alumnos
    while ($fila_materia = $resultado_materias->fetch_assoc()) {
        $id_materia = $fila_materia['id'];
        $nombre_materia = $fila_materia['nombre'];

        // Consultar las calificaciones para la materia actual
        $consulta_calificaciones = "SELECT alumnos.id AS id_alumno, alumnos.nombre AS nombre_alumno, calificaciones.calificacion
                                    FROM calificaciones
                                    LEFT JOIN alumnos ON calificaciones.id_alumno = alumnos.id
                                    WHERE calificaciones.id_materia = $id_materia";

        $resultado_calificaciones = $conn->query($consulta_calificaciones);

        // Mostrar la tabla de calificaciones para la materia actual
        echo "<h2>$nombre_materia</h2>";
        echo "<table>";
        echo "<tr><th>ID Alumno</th><th>Nombre Alumno</th><th>Calificación</th></tr>";

        while ($fila_calificacion = $resultado_calificaciones->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila_calificacion['id_alumno'] . "</td>";
            echo "<td>" . $fila_calificacion['nombre_alumno'] . "</td>";
            echo "<td>" . $fila_calificacion['calificacion'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
    ?>

</body>

</html>

<?php
// Cerrar la conexión después de utilizarla
$conn->close();
?>
    