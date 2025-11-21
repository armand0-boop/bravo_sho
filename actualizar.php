<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['usuario_id'];

// Si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];

    $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, apellidos = ?, correo = ? WHERE id = ?");
    $stmt->execute([$nombre, $apellidos, $correo, $id]);

    $_SESSION['usuario_nombre'] = $nombre; // actualiza el nombre en sesión
    header("Location: perfil.php");
    exit();
}

// Obtener datos actuales
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$id]);
$usuario = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Actualizar Datos</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h1>Actualizar tus datos</h1>
  <form method="POST">
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>

    <label>Apellidos:</label>
    <input type="text" name="apellidos" value="<?php echo $usuario['apellidos']; ?>" required>

    <label>Correo:</label>
    <input type="email" name="correo" value="<?php echo $usuario['correo']; ?>" required>

    <button type="submit" class="btn-principal">Guardar cambios</button>
    <a href="perfil.php" class="btn-secundario">Cancelar</a>
  </form>
</body>
</html>