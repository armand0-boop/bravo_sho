<?php
session_start();
require_once 'db.php'; // conexión a la base de datos

$carrito = $_SESSION['compras'] ?? [];

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Carrito | Bravo Shop</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
  <header class="header">
    <img src="./assets/logo.png.jpeg" alt="Bravo Shop Logo" class="logo" />
    <h1 class="titulo">Carrito de Compra</h1>
  </header>

  <main class="main">
    <section class="carrito">
      <?php
      if (empty($carrito)) {
          echo "<p>Tu carrito está vacío.</p>";
      } else {
          $total = 0;
          foreach ($carrito as $id_producto => $cantidad) {
              $stmt = $conn->prepare("SELECT nombre, precio, imagen FROM productos WHERE id = ?");
              $stmt->execute([$id_producto]);
              $producto = $stmt->fetch();

              if ($producto) {
                  $subtotal = $producto['precio'] * $cantidad;
                  $total += $subtotal;
                  echo "
                  <div class='carrito-item'>
                      <img src='./assets/productos/{$producto['imagen']}' alt='{$producto['nombre']}' />
                      <div class='info'>
                          <h4>{$producto['nombre']}</h4>
                          <p>Precio: \${$producto['precio']}</p>
                          <p>Unidades: {$cantidad}</p>
                          <p>Subtotal: \$" . number_format($subtotal, 2) . "</p>
                      </div>
                  </div>
                  ";
              }
          }

          echo "
          <div class='total'>
            <p>Total a pagar: <strong>\$" . number_format($total, 2) . "</strong></p>
          </div>
          <div class='acciones'>
            <a href='finalizar_compra.php' class='btn-principal'>Pagar</a>
            <a href='productos.php' class='btn-secundario'>Seguir comprando</a>
          </div>
          ";
      }
      ?>
    </section>
  </main>

  <footer class="footer">
    <nav class="nav-footer">
      <a href="index.html">Inicio</a>
      <a href="productos.php" class="activo">Catálogo</a>
      <a href="carrito.php">Carrito</a>
      <a href="ofertas.html">Ofertas</a>
    </nav>
  </footer>
</body>
</html>