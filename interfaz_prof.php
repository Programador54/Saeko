<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Interfaz de control escolar</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    header {
      background-color: #4CAF50;
      color: white;
      text-align: center;
      padding: 1em;
      width: 100%;
    }

    nav {
      background-color: #333;
      color: white;
      padding: 0.5em;
      width: 100%;
    }

    nav ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: space-around;
    }

    nav a {
      text-decoration: none;
      color: white;
    }

    main {
      display: flex;
      justify-content: space-around;
      width: 100%;
      padding: 20px;
    }

    table {
      border-collapse: collapse;
      width: 70%;
    }

    table, th, td {
      border: 1px solid #ddd;
    }

    th, td {
      padding: 10px;
      text-align: left;
    }

    aside {
      width: 20%;
      padding: 20px;
      background-color: #f0f0f0;
    }
aside h2 {
      color: #333;
    }

    aside ul {
      list-style-type: none;
      padding: 0;
    }

    aside li {
      margin-bottom: 10px;
    }

    aside a {
      text-decoration: none;
      color: #333;
      display: block;
      padding: 10px;
      background-color: #ddd;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    aside a:hover {
      background-color: #bbb;
    }
    
  </style>
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
        // Conexión a la base de datos (ajusta las credenciales)
        $conexion = new mysqli("localhost", "root", "", "saeko");

        // Verificar la conexión
        if ($conexion->connect_error) {
          die("La conexión falló: " . $conexion->connect_error);
        }

        // Consulta para obtener los datos de la tabla alumnos
        $consulta = "SELECT * FROM alumnos";
        $resultado = $conexion->query($consulta);

        // Mostrar los datos en la tabla
        while ($fila = $resultado->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $fila['id'] . "</td>";
          echo "<td>" . $fila['nombre'] . "</td>";
          echo "<td>" . $fila['grado'] . "</td>";
          echo "<td>" . $fila['matricula'] . "</td>";
          echo "</tr>";
        }

        // Cerrar la conexión
        $conexion->close();
      ?>

    </table>
    <aside>
      <h2>Materias</h2>
      <ul>
        <li>Matemáticas</li>
        <li>Historia</li>
        <li>Ciencias</li>
        <!-- Agrega más materias según tus datos -->
      </ul>
    </aside>
  </main>
  <footer>
    <p>Copyright &copy; 2023</p>
  </footer>
</body>
</html>

