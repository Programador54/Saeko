<?php
// Conexión a la base de datos (ajusta las credenciales)
$conn = new mysqli("localhost", "root", "", "saeko");

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}

// Obtener la lista de alumnos para el formulario
$sql = "SELECT id, nombre FROM alumnos";
$result = $conn->query($sql);

// Manejar el formulario para agregar incidencias
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los alumnos seleccionados
    $alumnos_seleccionados = isset($_POST["alumnos"]) ? $_POST["alumnos"] : [];

    // Verificar si se seleccionaron alumnos
    if (empty($alumnos_seleccionados)) {
        echo "Debes seleccionar al menos un alumno.";
    } else {
        // Dentro del bucle foreach
foreach ($alumnos_seleccionados as $alumno_id) {
    // Verificar si los índices están definidos antes de acceder a ellos
    if (isset($_POST["tipo_incidencia"][$alumno_id], $_POST["descripcion"][$alumno_id], $_POST["fecha_incidencia"][$alumno_id])) {
        // Procesar las incidencias del alumno
        $tipo_incidencia = $_POST["tipo_incidencia"][$alumno_id];
        $descripcion = $_POST["descripcion"][$alumno_id];
        $fecha_incidencia = $_POST["fecha_incidencia"][$alumno_id];

        // Resto del código para insertar en la base de datos...
    } else {
        // Manejar la situación en la que los índices no están definidos
        echo "Error: Algunos índices no están definidos para el alumno con ID $alumno_id.<br>";
    }
}

    }
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Incidencias</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        form {
            width: 50%;
            margin-top: 20px;
        }

        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Registrar Incidencias</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Selecciona uno o más alumnos:</label><br>
        <?php
        // Mostrar casillas de verificación para los alumnos
        while ($row = $result->fetch_assoc()) {
            echo "<input type='checkbox' name='alumnos[]' value='{$row['id']}'> {$row['nombre']}<br>";

            // Agregar campos para cada alumno
            echo "<div>";
            echo "<label for='tipo_incidencia_{$row['id']}'>Tipo de Incidencia:</label>";
            echo "<input type='text' name='tipo_incidencia[{$row['id']}]' id='tipo_incidencia_{$row['id']}' required><br>";

            echo "<label for='descripcion_{$row['id']}'>Descripción:</label>";
            echo "<textarea name='descripcion[{$row['id']}]' id='descripcion_{$row['id']}' required></textarea><br>";

            echo "<label for='fecha_incidencia_{$row['id']}'>Fecha de Incidencia:</label>";
            echo "<input type='date' name='fecha_incidencia[{$row['id']}]' id='fecha_incidencia_{$row['id']}' required><br>";
            echo "</div>";
        }
        ?>
        <button type="submit">Registrar Incidencias</button>
    </form>
</body>
</html>
