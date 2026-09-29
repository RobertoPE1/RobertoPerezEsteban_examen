<?php
require "config.php"; // Conexión PDO

$errores = []; // Array para guardar errores

// Si el formulario se envió
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Recogemos los datos del formulario
    $titulo = trim($_POST["titulo"]);
    $escritor = trim($_POST["escritor"]);
    $formato = trim($_POST["formato"]);
    $precio = trim($_POST["precio"]);
    $anio = trim($_POST["anio"]);

    // Validación: todos los campos obligatorios
    if ($titulo === "" || $escritor === "" || $formato === "" || $precio === "" || $anio === "") {
        $errores[] = "Todos los campos son obligatorios.";
    }

    // Si no hay errores, insertamos en la BD
    if (empty($errores)) {

        // Consulta preparada para evitar inyecciones SQL
        $sql = "INSERT INTO libros (titulo, escritor, formato, precio, anio)
                VALUES (:titulo, :escritor, :formato, :precio, :anio)";
        $stmt = $pdo->prepare($sql);

        // Ejecutamos la consulta con los valores
        $stmt->execute([
            ":titulo" => $titulo,
            ":escritor" => $escritor,
            ":formato" => $formato,
            ":precio" => $precio,
            ":anio" => $anio
        ]);

        // Redirigimos al listado
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Crear libro</title></head>
<body>

<h1>Añadir libro</h1>

<!-- Mostramos errores si los hay -->
<?php foreach ($errores as $e): ?>
<p style="color:red;"><?= $e ?></p>
<?php endforeach; ?>

<!-- Formulario -->
<form method="POST">
    Título: <input type="text" name="titulo"><br><br>
    Escritor: <input type="text" name="escritor"><br><br>
    Formato: <input type="text" name="formato"><br><br>
    Precio: <input type="text" name="precio"><br><br>
    Año: <input type="number" name="anio"><br><br>

    <button type="submit">Guardar</button>
</form>

<a href="index.php">Volver</a>

</body>
</html>
