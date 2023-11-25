<?php
// Conectarse a la base de datos
$conn = new mysqli("localhost", "root", "", "saeko");

// Obtener la lista de alumnos y sus calificaciones
$sql = "SELECT alumnos.nombre, alumnos.matricula, alumnos.grado, calificaciones.materia, calificaciones.calificacion 
        FROM alumnos 
        LEFT JOIN calificaciones ON alumnos.id = calificaciones.alumno_id";
$result = $conn->query($sql);

// Imprimir la lista de alumnos y calificaciones con estilos CSS
echo "<!DOCTYPE html>";
echo "<html lang='es'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<title>Alumnos y Calificaciones</title>";
echo "<style>";
echo "body { font-family: Arial, sans-serif; margin: 0; padding: 0; display: flex; flex-direction: column; align-items: center; }";
echo "table { border-collapse: collapse; width: 80%; margin-top: 20px; }";
echo "th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }";
echo "th { background-color: #4CAF50; color: white; }";
echo "tbody tr:nth-child(even) { background-color: #f2f2f2; }";
echo "</style>";
echo "</head>";
echo "<body>";

// Imprimir la lista de alumnos y calificaciones
if ($result->num_rows > 0) {
  echo "<table>";
  echo "<thead>";
  echo "<tr>";
  echo "<th>Nombre</th>";
  echo "<th>Matrícula</th>";
  echo "<th>Grado</th>";
  echo "<th>Materia</th>";
  echo "<th>Calificación</th>";
  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";
  while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>{$row['nombre']}</td>";
    echo "<td>{$row['matricula']}</td>";
    echo "<td>{$row['grado']}</td>";
    echo "<td>{$row['materia']}</td>";
    echo "<td>{$row['calificacion']}</td>";
    echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>";
} else {
  echo "<p>No hay alumnos registrados.</p>";
}

// Cerrar la conexión a la base de datos
$conn->close();

echo "</body>";
echo "</html>";
?>
