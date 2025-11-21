<?php
session_start();
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = intval($_POST['id_producto']);
  $cantidad = intval($_POST['cantidad']);

  $stmt = $conn->prepare("SELECT * FROM productos WHERE id = :id");
  $stmt->execute(['id' => $id]);
  $producto = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($producto) {
    $_SESSION['carrito'][] = [
      'id' => $producto['id'],
      'nombre' => $producto['nombre'],
      'precio' => $producto['precio'],
      'cantidad' => $cantidad
    ];
  }
}

$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
$total = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Carrito - Bravo Shop</title>
  <link rel="stylesheet" href="../assets/css/global.css">
</head>
<body>
  <?php include '../includes/header.php'; ?>

  <main class="carrito">
    <h2>Tu carrito de compras</h2>

    <?php if (empty($carrito)): ?>
      <p>Tu carrito está vacío.</p>
    <?php else: ?>
      <ul>
        <?php foreach ($carrito as $item): 
          $subtotal = $item['precio'] * $item['cantidad'];
          $total += $subtotal;
        ?>
          <li>
            <?php echo $item['cantidad']; ?> × <?php echo $item['nombre']; ?> — 
            $<?php echo number_format($subtotal, 2); ?> MXN
          </li>
        <?php endforeach; ?>
      </ul>

      <p><strong>Total:</strong> $<?php echo number_format($total, 2); ?> MXN</p>

      <form action="ticket.php" method="POST">
        <button type="submit">Finalizar compra</button>
      </form>
    <?php endif; ?>
  </main>

  <?php include '../includes/footer.php'; ?>
</body>
</html>