<?php
session_start();
require_once 'db.php'; // conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Buscar usuario por correo
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE correo = ?");
    $stmt->execute([$correo]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
        // Guardar datos en sesión
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];

        // Redirigir al perfil
        header("Location: perfil.php");
        exit();
    } else {
        $error = "Correo o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Iniciar Sesión | Bravo Shop</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
  <header class="header">
    <h1 class="titulo">Iniciar Sesión</h1>
  </header>

  <main class="main">
    <section class="formulario-login">
      <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
      <form action="login.php" method="POST">
        <label for="correo">Correo electrónico</label>
        <input type="email" id="correo" name="correo" required />

        <label for="contrasena">Contraseña</label>
        <input type="password" id="contrasena" name="contrasena" required />

        <div class="acciones">
          <button type="submit" class="btn-principal">Iniciar sesión</button>
          <a href="registro.html" class="btn-secundario">¿No tienes cuenta? Regístrate</a>
        </div>
      </form>
    </section>
  </main>
</body>
</html>