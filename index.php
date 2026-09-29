<?php
require "config.php"; // Conexión a la BD

// Consulta para obtener todos los videojuegos
$sql = "SELECT * FROM libros";
$stmt = $pdo->query($sql); // Ejecutamos la consulta
$libros = $stmt->fetchAll(PDO::FETCH_ASSOC); // Guardamos los resultados
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Listado de libros</title>
</head>
<body>

<h1>libros</h1>

<!-- Enlace para añadir un nuevo videojuego -->
<a href="crear.php">Añadir libro</a>

<!-- Tabla donde mostramos los videojuegos -->
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Escritor</th>
        <th>Formato</th>
        <th>Precio</th>
        <th>Año</th>
        <th>Acciones</th>
    </tr>

    <!-- Recorremos los videojuegos y los mostramos -->
    <?php foreach ($libros as $l): ?>
    <tr>
        <td><?= $l["id"] ?></td>
        <td><?= $l["titulo"] ?></td>
        <td><?= $l["escritor"] ?></td>
        <td><?= $l["formato"] ?></td>
        <td><?= $l["precio"] ?></td>
        <td><?= $l["anio"] ?></td>

        <td>
            <!-- Botón editar -->
            <a href="editar.php?id=<?= $l['id'] ?>">Editar</a>

            <!-- Botón borrar con confirmación -->
            |
            <a href="borrar.php?id=<?= $l['id'] ?>"
               onclick="return confirm('¿Seguro que deseas eliminar este videojuego?')">
               Eliminar
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
