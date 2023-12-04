<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilo_interfaz_prof.css">
    <title>Bienvenido</title>
</head>

<body>
    <header>
        <h1>Interfaz de alumno</h1>
    </header>
    <nav>
        <ul>
            <li> <a href="calificaciones_alum.php">Calificaciones</li>
            <li> <a href="clases.php">Clases</a></li>
            <li> <a href="trabajos.php">Mis trabajos</a></li>
        </ul>
    </nav>
    <table>
        <tr>
            <td>Clase</td>
            <td>Profesor/a</td>
            <td>Calificacion</td>
            <td>Trabajos pendientes</td>
        </tr>
    </table>
</body>

</html>
<?php
//file that contains connection to db
include "db/conexion.php";
$consulta_clases = "SELECT * FROM materias";
$resultado_clases = $conn->query($consulta_clases);
while ($filaclases = $resultado_clases->fetch_assoc());
echo"<tr>";
echo"<td>";
?>