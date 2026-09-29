<?php
// ACTIVAR ERRORES (solo para depurar, puedes quitarlo al entregar)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "config.php"; // Conexión PDO

// -----------------------------
// 1. COMPROBAR QUE LLEGA EL ID
// -----------------------------
if (!isset($_GET["id"])) {
    // Si no llega el ID, no podemos editar nada
    die("ERROR: No se recibió el ID del videojuego.");
}

$id = $_GET["id"];

// -------------------------------------------
// 2. OBTENER EL VIDEOJUEGO QUE VAMOS A EDITAR
// -------------------------------------------
$sql = "SELECT * FROM libros WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([":id" => $id]);

$libros = $stmt->fetch(PDO::FETCH_ASSOC);

// Si no existe el juego, mostramos error
if (!$libros) {
    die("ERROR: No existe un videojuego con el ID $id");
}

$errores = [];

// -------------------------------------------
// 3. SI SE ENVÍA EL FORMULARIO (POST)
// -------------------------------------------
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Recogemos los datos enviados por el formulario
    $titulo = trim($_POST["titulo"]);
    $escritor = trim($_POST["escritor"]);
    $formato = trim($_POST["formato"]);
    $precio = trim($_POST["precio"]);
    $anio = trim($_POST["anio"]);

    // Validación: todos los campos obligatorios
    if ($titulo === "" || $escritor === "" || $formato === "" || $precio === "" || $anio === "") {
        $errores[] = "Todos los campos son obligatorios.";
    }

    // -------------------------------------------
    // 4. SI NO HAY ERRORES → ACTUALIZAR REGISTRO
    // -------------------------------------------
    if (empty($errores)) {

        $sql = "UPDATE libros SET 
                titulo = :titulo,
                escritor = :escritor,
                formato = :formato,
                precio = :precio,
                anio = :anio
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        // Ejecutamos la actualización
        $stmt->execute([
            ":titulo" => $titulo,
            ":escritor" => $escritor,
            ":formato" => $formato,
            ":precio" => $precio,
            ":anio" => $anio,
            ":id" => $id
        ]);

        // Redirigimos al listado
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar libro</title>
</head>
<body>

<h1>Editar libro</h1>

<!-- Mostrar errores si los hay -->
<?php foreach ($errores as $e): ?>
<p style="color:red;"><?= $e ?></p>
<?php endforeach; ?>

<!-- Formulario con los datos actuales -->
<form method="POST">
    Título: <input type="text" name="titulo" value="<?= $libros['titulo'] ?>"><br><br>
    Escritor: <input type="text" name="escritor" value="<?= $libros['escritor'] ?>"><br><br>
    Formato: <input type="text" name="formato" value="<?= $libros['formato'] ?>"><br><br>
    Precio: <input type="text" name="precio" value="<?= $libros['precio'] ?>"><br><br>
    Año: <input type="number" name="anio" value="<?= $libros['anio'] ?>"><br><br>

    <button type="submit">Actualizar</button>
</form>

<a href="index.php">Volver</a>

</body>
</html>
