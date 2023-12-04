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

echo "</body>";
echo "</html>";
