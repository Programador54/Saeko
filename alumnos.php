<?php
include "barra_nav.php";
// Conexión a la base de datos (ajusta las credenciales)
$conexion = new mysqli("localhost", "root", "", "saeko");

// Verificar la conexión
if ($conexion->connect_error) {
    die("La conexión falló: " . $conexion->connect_error);
}

// Consulta para obtener los datos de la tabla alumnos2 y las calificaciones
$consulta_alumnos_calificaciones = "SELECT alumnos2.*, calificaciones.calificacion, materias.nombre AS nombre_materia
                                    FROM alumnos2
                                    LEFT JOIN calificaciones ON alumnos2.id = calificaciones.id_alumno
                                    LEFT JOIN materias ON calificaciones.id_materia = materias.id";

$resultado_alumnos_calificaciones = $conexion->query($consulta_alumnos_calificaciones);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Alumnos y Calificaciones</title>
    <link rel="stylesheet" type="text/css" href="estilo.css"> <!-- Ajusta la ruta según tu estructura de archivos -->
</head>

<body>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Matricula</th>
            <th>Materia</th>
            <th>Calificación</th>
        </tr>

        <?php
        // Mostrar los datos en la tabla
        while ($fila_alumno_calificacion = $resultado_alumnos_calificaciones->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila_alumno_calificacion['id'] . "</td>";
            echo "<td>" . $fila_alumno_calificacion['nombre'] . "</td>";
            echo "<td>" . $fila_alumno_calificacion['matricula'] . "</td>";
            echo "<td>" . $fila_alumno_calificacion['nombre_materia'] . "</td>";
            echo "<td>" . $fila_alumno_calificacion['calificacion'] . "</td>";
            echo "</tr>";
        }
        ?>

    </table>

</body>

</html>

<?php
// Cerrar la conexión después de utilizarla
$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Inicio de sesión</title>
</head>
<body class="backcolor2"></body>
</html>

