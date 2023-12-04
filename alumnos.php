<?php
include "layouts/barra_nav.php";

require "db/conexion.php";  // Asegúrate de ajustar la ruta según tu estructura de archivos

if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}

// Consulta para obtener los datos de la tabla alumnos2
$consulta_alumnos = "SELECT * FROM alumnos2";
$resultado_alumnos = $conn->query($consulta_alumnos);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Alumnos</title>
    <link rel="stylesheet" type="text/css" href="estilos.css"> <!-- Ajusta la ruta según tu estructura de archivos -->
</head>

<body>
    <main>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Calificación</th>
            </tr>

            <?php
            // Mostrar los datos en la tabla
            while ($fila_alumnos = $resultado_alumnos->fetch_assoc()) {
                $id_alumno = $fila_alumnos['id'];
                $nombre_alumno = $fila_alumnos['nombre'];

                // Consultar la calificación del alumno (ajusta la consulta según tu estructura)
                $consulta_calificacion = "SELECT calificacion FROM calificaciones WHERE id_alumno = $id_alumno";
                $resultado_calificacion = $conn->query($consulta_calificacion);

                $calificacion = ($resultado_calificacion && $fila_calificacion = $resultado_calificacion->fetch_assoc()) ?
                    $fila_calificacion['calificacion'] : "Sin calificación";

                echo "<tr>";
                echo "<td>" . $id_alumno . "</td>";
                echo "<td>" . $nombre_alumno . "</td>";
                echo "<td>" . $calificacion . "</td>";
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
// Cerrar la conexión después de utilizarla
$conn->close();
?>
