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

    a{
        text-decoration: none;
        color: #f0f0f0;
    }
    
  </style>
</head>
<body>
  <header>
    <h1><a href="interfaz_prof.php">Interfaz de control escolar</a></h1>
  </header>
  <nav>
    <ul>
      <li><a href="alumnos.php">Alumnos</a></li>
      <li><a href="trabajos.php">Trabajos</a></li>
      <li><a href="reportes.php">Reportes</a></li>
    </ul>
  </nav>
</body>