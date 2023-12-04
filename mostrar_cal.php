<?php
// Función para obtener el nombre de la materia
function obtenerNombreMateria($id_materia)
{
    // Conexión a la base de datos (ajusta las credenciales)
    $conexion = new mysqli("localhost", "root", "", "saeko");

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("La conexión falló: " . $conexion->connect_error);
    }

    // Consulta para obtener el nombre de la materia
    $consulta_nombre_materia = "SELECT nombre FROM materias WHERE id = $id_materia";
    $resultado_nombre_materia = $conexion->query($consulta_nombre_materia);

    // Verificar si se encontró el nombre de la materia
    if ($resultado_nombre_materia && $resultado_nombre_materia->num_rows > 0) {
        $fila_nombre_materia = $resultado_nombre_materia->fetch_assoc();
        return $fila_nombre_materia['nombre'];
    } else {
        return "Materia Desconocida"; // Puedes cambiar esto por un mensaje personalizado o manejarlo de la manera que prefieras.
    }

    // Cerrar la conexión
    $conexion->close();
}

// Verificar si se recibió el ID de la materia en la URL
if (isset($_GET['id_materia'])) {
    $id_materia = $_GET['id_materia'];

    // Conexión a la base de datos (ajusta las credenciales)
    $conexion = new mysqli("localhost", "root", "", "saeko");

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("La conexión falló: " . $conexion->connect_error);
    }

    // Consulta para obtener los datos de calificaciones
    $consulta_calificaciones = "SELECT * FROM calificaciones WHERE id_materia = $id_materia";
    $resultado_calificaciones = $conexion->query($consulta_calificaciones);

    // Verificar si hay calificaciones para la materia
    if ($resultado_calificaciones) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calificaciones de <?php echo obtenerNombreMateria($id_materia); ?></title>
    <link rel="stylesheet" type="text/css" href="estilo_calificaciones.css">
</head>
<body>
    <header>
        <h1>Calificaciones de <?php echo obtenerNombreMateria($id_materia); ?></h1>
    </header>
    <main>
        <table>
            <tr>
                <th>ID Alumno</th>
                <th>Calificación</th>
            </tr>

            <?php
                while ($fila_calificacion = $resultado_calificaciones->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $fila_calificacion['id_alumno'] . "</td>";
                    echo "<td>" . $fila_calificacion['calificacion'] . "</td>";
                    echo "</tr>";
                }
            ?>

        </table>
    </main>
    <footer>
        <p>Copyright &copy; 2023</p>
    </footer>
</body>
</html>

<?php
    } else {
        echo "No hay calificaciones para esta materia.";
    }

    // Cerrar la conexión
    $conexion->close();
} else {
    echo "ID de materia no especificado.";
}
?>
