<?php
$host = "localhost";
$dbname = "bravo_shop";
$username = "root"; // cambia si tu usuario es distinto
$password = "";     // pon tu contraseña de MySQL si tienes

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>