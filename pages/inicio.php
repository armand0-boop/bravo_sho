<?php
session_start();
require_once '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inicio - Bravo Shop</title>
  <link rel="stylesheet" href="../assets/css/global.css">
</head>
<body>
  <?php include '../includes/header.php'; ?>

  <main class="inicio">
    <section class="buscador">
      <form action="resultados.php" method="GET">
        <input type="text" name="query" placeholder="Busca tus productos" required>
        <button type="submit">Buscar</button>
      </form>
    </section>

    <section class="ofertas">
      <h2>Ofertas y novedades disponibles</h2>
      <p>¡Las mejores gorras para ti!</p>
      <a href="producto.php?id=3" class="btn-ver">Ver gorra destacada</a>
    </section>

    <section class="productos">
      <h2>Productos disponibles</h2>
      <div class="grid-productos">
        <?php
        try {
          $stmt = $conn->query("SELECT * FROM productos WHERE disponible = 1");
          while ($producto = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '
            <div class="producto">
              <img src="../assets/img/productos/' . $producto['imagen'] . '" alt="' . $producto['nombre'] . '">
              <h3>' . $producto['nombre'] . '</h3>
              <p>$' . number_format($producto['precio'], 2) . ' MXN</p>
              <a href="producto.php?id=' . $producto['id'] . '" class="btn-ver">Ver producto</a>
            </div>';
          }
        } catch (PDOException $e) {
          echo "<p>Error al cargar productos: " . $e->getMessage() . "</p>";
        }
        ?>
      </div>
    </section>
  </main>

  <?php include '../includes/footer.php'; ?>
</body>
</html>