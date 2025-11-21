<?php
session_start();
require_once '../includes/db.php';

$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
$total = 0;
$id_usuario = isset($_SESSION['usuario']['id']) ? $_SESSION['usuario']['id'] : null;
$id_compra = null;

if ($id_usuario && !empty($carrito)) {
  try {
    // Calcular total
    foreach ($carrito as $item) {
      $total += $item['precio'] * $item['cantidad'];
    }

    // Insertar compra
    $stmt = $conn->prepare("INSERT INTO compras (id_usuario, total) VALUES (:id_usuario, :total)");
    $stmt->execute([
      'id_usuario' => $id_usuario,
      'total' => $total
    ]);
    $id_compra = $conn->lastInsertId();

    // Insertar detalle de compra
    $stmt_detalle = $conn->prepare("INSERT INTO detalle_compra (id_compra, id_producto, cantidad, precio_unitario) VALUES (:id_compra, :id_producto, :cantidad, :precio_unitario)");

    foreach ($carrito as $item) {
      $stmt_detalle->execute([
        'id_compra' => $id_compra,
        'id_producto' => $item['id'],
        'cantidad' => $item['cantidad'],
        'precio_unitario' => $item['precio']
      ]);
    }

    // Limpiar carrito
    unset($_SESSION['carrito']);
  } catch (PDOException $e) {
    die("❌ Error al registrar la compra: " . $e->getMessage());
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ticket de compra - Bravo Shop</title>
  <link rel="stylesheet" href="../assets/css/global.css">
</head>
<body>
  <?php include '../includes/header.php'; ?>

  <main class="ticket">
    <h2>Gracias por tu compra</h2>

    <?php if (!$id_compra): ?>
      <p>No se pudo registrar la compra. Asegúrate de haber iniciado sesión y tener productos en el carrito.</p>
    <?php else: ?>
      <p>Tu compra ha sido registrada con el ID <strong>#<?php echo $id_compra; ?></strong></p>
      <table>
        <thead>
          <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio unitario</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($carrito as $item): 
            $subtotal = $item['precio'] * $item['cantidad'];
          ?>
            <tr>
              <td><?php echo $item['nombre']; ?></td>
              <td><?php echo $item['cantidad']; ?></td>
              <td>$<?php echo number_format($item['precio'], 2); ?></td>
              <td>$<?php echo number_format($subtotal, 2); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3"><strong>Total:</strong></td>
            <td><strong>$<?php echo number_format($total, 2); ?> MXN</strong></td>
          </tr>
        </tfoot>
      </table>
    <?php endif; ?>

    <div class="volver">
      <a href="inicio.php">← Volver al inicio</a>
    </div>
  </main>

  <?php include '../includes/footer.php'; ?>
</body>
</html>