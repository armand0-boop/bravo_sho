<?php
session_start();

// Recibe el ID del producto y la cantidad desde el formulario
$id_producto = $_POST['id_producto'];
$cantidad = $_POST['cantidad'] ?? 1;

// Inicializa el carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Si el producto ya está en el carrito, suma la cantidad
if (isset($_SESSION['carrito'][$id_producto])) {
    $_SESSION['carrito'][$id_producto] += $cantidad;
} else {
    $_SESSION['carrito'][$id_producto] = $cantidad;
}

// Redirige al carrito
header("Location: carrito.php");
exit();