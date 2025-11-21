<?php
session_start();
require_once '../includes/db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$producto = null;

if ($id > 0) {
  $stmt = $conn->prepare("SELECT * FROM productos WHERE id = :id");
  $stmt->execute(['id' => $id]);
  $producto = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Producto - Bravo Shop</title>
  <link rel="stylesheet" href="../assets/css/global.css">
</head>
<body>
  <?php include '../includes/header.php'; ?>

  <main class="producto-detalle">
    <?php if (!$producto): ?>
      <p>Producto no encontrado.</p>
    <?php else: ?>
      <h2><?php echo $producto['nombre']; ?></h2>
      <img src="../assets/img/productos/<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
      <p><?php echo $producto['descripcion']; ?></p>
      <p><strong>Precio:</strong> $<?php echo number_format($producto['precio'], 2); ?> MXN</p>
      <form method="POST" action="carrito.php">
        <input type="hidden" name="id_producto" value="<?php echo $producto['id']; ?>">
        <input type="number" name="cantidad" value="1" min="1">
        <button type="submit">Agregar al carrito</button>
      </form>
    <?php endif; ?>
  </main>

  <?php include '../includes/footer.php'; ?>
</body>
</html>