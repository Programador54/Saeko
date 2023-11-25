<?php
include ('barra_nav.php');
// Conexión a la base de datos (ajusta las credenciales)
$conn = new mysqli("localhost", "root", "", "saeko");

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}
$carpeta_destino = "archivos_adjuntos/";

// Verificar si la carpeta existe, si no, crearla
if (!file_exists($carpeta_destino)) {
    mkdir($carpeta_destino, 0777, true);
}

// Manejar la entrada del formulario para agregar un nuevo trabajo
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $fecha_entrega = $_POST["fecha_entrega"];

    // Manejar el archivo adjunto
    $archivo_adjunto = $_FILES["archivo_adjunto"];
    $archivo_nombre = $archivo_adjunto["name"];
    $archivo_temporal = $archivo_adjunto["tmp_name"];


    $carpeta_destino = "archivos_adjuntos/";
    $ruta_archivo = $carpeta_destino . $archivo_nombre;

    move_uploaded_file($archivo_temporal, $ruta_archivo);

    $sql = "INSERT INTO trabajos (titulo, descripcion, fecha_entrega, archivo_adjunto) VALUES ('$titulo', '$descripcion', '$fecha_entrega', '$ruta_archivo')";
    if ($conn->query($sql) === TRUE) {
        echo "Trabajo agregado con éxito.";
    } else {
        echo "Error al agregar el trabajo: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Trabajo con Archivos Adjuntos</title>
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

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
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
    <h2>Agregar Trabajo con Archivos Adjuntos</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" required>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" rows="4" required></textarea>

        <label for="fecha_entrega">Fecha de Entrega:</label>
        <input type="date" name="fecha_entrega" required>

        <label for="archivo_adjunto">Archivo Adjunto:</label>
        <input type="file" name="archivo_adjunto" accept="image/*, application/pdf, .doc, .docx">

        <button type="submit">Agregar Trabajo</button>
    </form>
</body>
</html>
