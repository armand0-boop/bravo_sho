<?php
session_start();
require_once '../includes/db.php';

$query = isset($_GET['query']) ? trim($_GET['query']) : '';
$resultados = [];

if ($query !== '') {
  try {
    $stmt = $conn->prepare("SELECT * FROM productos WHERE nombre LIKE :query OR descripcion LIKE :query");
    $stmt->execute(['query' => "%$query%"]);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    die("Error en la búsqueda: " . $e->getMessage());
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resultados de búsqueda</title>
  <link rel="stylesheet" href="../assets/css/global.css">
  <link rel="stylesheet" href="../assets/css/busqueda.css">
</head>
<body>
  <?php include '../includes/header.php'; ?>

  <main class="resultados">
    <h1>Resultados para: "<?php echo htmlspecialchars($query); ?>"</h1>

    <?php if (empty($resultados)): ?>
      <p>No se encontraron productos.</p>
    <?php else: ?>
      <div class="grid-productos">
        <?php foreach ($resultados as $producto): ?>
          <div class="producto">
            <img src="../assets/img/productos/<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
            <h3><?php echo $producto['nombre']; ?></h3>
            <p>$<?php echo number_format($producto['precio'], 2); ?> MXN</p>
            <a href="producto.php?id=<?php echo $producto['id']; ?>" class="btn-ver">Ver producto</a>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </main>

  <div class="volver">
    <a href="inicio.php">← Volver al inicio</a>
  </div>

  <?php include '../includes/footer.php'; ?>
</body>
</html>