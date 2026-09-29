<?php
// Datos de conexión de InfinityFree
$host = "sql105.infinityfree.com";     // Host del servidor MySQL
$dbname = "if0_42915762_biblioteca2";  // Nombre REAL de tu BD en InfinityFree
$user = "if0_42915762";                // Usuario MySQL del hosting
$pass = "EGh5e7hT72male";               // Contraseña MySQL del hosting

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
