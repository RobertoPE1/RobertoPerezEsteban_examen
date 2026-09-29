<?php
require "config.php";

// Si recibimos un ID por GET
if (isset($_GET["id"])) {

    $id = $_GET["id"];

    // Consulta preparada para borrar
    $sql = "DELETE FROM libros WHERE id=:id";
    $stmt = $pdo->prepare($sql);

    // Ejecutamos pasando el ID
    $stmt->execute([":id" => $id]);

    // Volvemos al listado
    header("Location: index.php");
    exit;
}
?>
