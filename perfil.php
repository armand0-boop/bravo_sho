<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Perfil | Bravo Shop</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header class="header">
    <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?> 👋</h1>
  </header>

  <main class="main">
    <p>Aquí puedes actualizar o eliminar tu cuenta:</p>
    <div class="acciones">
      <a href="actualizar.php" class="btn-principal">Actualizar datos</a>
      <a href="eliminar.php" class="btn-secundario" onclick="return confirm('¿Seguro que quieres eliminar tu cuenta?');">Eliminar cuenta</a>
    </div>
  </main>
</body>
</html>