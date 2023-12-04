<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Interfaz de control escolar</title>
  <link rel="stylesheet" type="text/css" href="estilo_interfaz_prof.css"> 
</head>
<body>
  <header>
    <h1>Interfaz de control escolar</h1>
  </header>
  <nav>
    <ul>
      <li><a href="alumnos.php">Alumnos</a></li>
      <li><a href="trabajos.php">Trabajos</a></li>
      <li><a href="reportes.php">Reportes</a></li>
    </ul>
  </nav>
  <main>
    <table>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Grado</th>
        <th>Matricula</th>
      </tr>

      <?php
        $conexion = new mysqli("localhost", "root", "", "saeko");

        if ($conexion->connect_error) {
          die("La conexión falló: " . $conexion->connect_error);
        }

        $consulta_alumnos = "SELECT * FROM alumnos2";
        $resultado_alumnos = $conexion->query($consulta_alumnos);

        while ($fila_alumnos = $resultado_alumnos->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $fila_alumnos['id'] . "</td>";
          echo "<td>" . $fila_alumnos['nombre'] . "</td>";
          echo "<td>" . $fila_alumnos['grado'] . "</td>";
          echo "<td>" . $fila_alumnos['matricula'] . "</td>";
          echo "</tr>";
        }
      ?>
    </table>

    <aside>
    <h2>Materias</h2>
    <ul>
        <?php
        // Consulta para obtener las materias de la base de datos
        $consulta_materias = "SELECT * FROM materias";
        $resultado_materias = $conexion->query($consulta_materias);

        // Mostrar las materias en la lista con enlaces a páginas específicas
        while ($fila_materias = $resultado_materias->fetch_assoc()) {
            $id_materia = $fila_materias['id'];
            $nombre_materia = $fila_materias['nombre'];
            $url_pagina_materia = "pagina_materia.php?id_materia=$id_materia"; // Cambia el nombre de la página según tus necesidades
            echo "<li><a href='$url_pagina_materia'>$nombre_materia</a></li>";
        }
        ?>

        <!-- Formulario para agregar nuevas materias -->
        <form action="agregar_materia.php" method="post">
            <label for="nueva_materia">Nueva Materia:</label>
            <input type="text" id="nueva_materia" name="nueva_materia" required>
            <button type="submit">Agregar Materia</button>
        </form>
    </ul>
</aside>
  </main>
  <footer>
    <p>Copyright &copy; 2023</p>
  </footer>
</body>
</html>

<?php
$conexion->close();
?>
