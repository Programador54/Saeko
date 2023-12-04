<?php
include "barra_nav.php";
if (isset($_GET['id_materia'])) {
    $id_materia = $_GET['id_materia'];

    $conexion = new mysqli("localhost", "root", "", "saeko");

    if ($conexion->connect_error) {
        die("La conexión falló: " . $conexion->connect_error);
    }

    $consulta_materia = "SELECT * FROM materias WHERE id = $id_materia";
    $resultado_materia = $conexion->query($consulta_materia);

    if ($resultado_materia) {
        $fila_materia = $resultado_materia->fetch_assoc();
        $nombre_materia = $fila_materia['nombre'];
        $grado_materia = $fila_materia['grado'];

        $consulta_alumnos_materia = "SELECT * FROM alumnos WHERE id_materia = $id_materia";
        $resultado_alumnos_materia = $conexion->query($consulta_alumnos_materia);

        if ($resultado_alumnos_materia && $resultado_alumnos_materia->num_rows > 0) {
            echo "<h1>Alumnos de la materia: $nombre_materia</h1>";
            echo "<p>Grado: $grado_materia</p>";

            echo "<form action='procesar_calificaciones.php' method='post'>";
            
            echo "<input type='hidden' name='id_materia' value='$id_materia'>";
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Nombre</th>";
            echo "<th>Matricula</th>";
            echo "<th>Calificación</th>";
            echo "</tr>";
            
            while ($fila_alumno = $resultado_alumnos_materia->fetch_assoc()) {
                $id_alumno = $fila_alumno['id'];
                echo "<tr>";
                echo "<td>" . $fila_alumno['id'] . "</td>";
                echo "<td>" . $fila_alumno['nombre'] . "</td>";
                echo "<td>" . $fila_alumno['matricula'] . "</td>";
                echo "<td><input type='text' name='calificacion[$id_alumno]' placeholder='Calificación'></td>";
                echo "</tr>";
            }

            echo "</table>";
            echo "<button type='submit'>Guardar Calificaciones</button>";
            echo "</form>";
        } else {
            echo "No hay alumnos en esta materia.";
        }
    } else {
        echo "Materia no encontrada.";
    }

    $conexion->close();
} else {
    echo "ID de materia no especificado.";
}
include "mostrar_cal.php";
?>

