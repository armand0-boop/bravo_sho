<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Catálogo | Bravo Shop</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
  <header class="header">
    <img src="./assets/logo.png.jpeg" alt="Bravo Shop Logo" class="logo" />
    <h1 class="titulo">Catálogo de Gorras</h1>
  </header>

  <main class="main">
    <section class="grid-productos">
      <div class="producto">
        <img src="./assets/productos/la-azul.jfif" alt="LA azul" />
        <h4>LA azul</h4>
        <p>$500</p>
        <a href="producto.html?id=la-azul" class="btn-secundario">Ver detalles</a>
        <!-- Botón para agregar al carrito -->
        <form action="agregar_al_carrito.php" method="POST">
          <input type="hidden" name="id_producto" value="1"> <!-- ID real en la BD -->
          <input type="number" name="cantidad" value="1" min="1">
          <button type="submit" class="btn-principal">Agregar al carrito</button>
        </form>
      </div>

      <div class="producto">
        <img src="./assets/productos/sad-boyz.jfif" alt="Sad Boys Junior H" />
        <h4>Sad Boys - Junior H</h4>
        <p>$500</p>
        <a href="producto.html?id=sadboys" class="btn-secundario">Ver detalles</a>
        <form action="agregar_al_carrito.php" method="POST">
          <input type="hidden" name="id_producto" value="2">
          <input type="number" name="cantidad" value="1" min="1">
          <button type="submit" class="btn-principal">Agregar al carrito</button>
        </form>
      </div>

      <div class="producto">
        <img src="./assets/productos/angeles-black.jfif" alt="Ángeles Full Black" />
        <h4>Ángeles Full Black</h4>
        <p>$500</p>
        <a href="producto.html?id=angeles-black" class="btn-secundario">Ver detalles</a>
        <form action="agregar_al_carrito.php" method="POST">
          <input type="hidden" name="id_producto" value="3">
          <input type="number" name="cantidad" value="1" min="1">
          <button type="submit" class="btn-principal">Agregar al carrito</button>
        </form>
      </div>

      <div class="producto">
        <img src="./assets/productos/yankees-black.jfif" alt="Yankees Black" />
        <h4>Yankees Black</h4>
        <p>$800</p>
        <a href="producto.html?id=yankees-black" class="btn-secundario">Ver detalles</a>
        <form action="agregar_al_carrito.php" method="POST">
          <input type="hidden" name="id_producto" value="4">
          <input type="number" name="cantidad" value="1" min="1">
          <button type="submit" class="btn-principal">Agregar al carrito</button>
        </form>
      </div>

      <div class="producto">
        <img src="./assets/productos/la-cupido.jfif" alt="LA Cupido" />
        <h4>LA Cupido</h4>
        <p>$800</p>
        <a href="producto.html?id=la-cupido" class="btn-secundario">Ver detalles</a>
        <form action="agregar_al_carrito.php" method="POST">
          <input type="hidden" name="id_producto" value="5">
          <input type="number" name="cantidad" value="1" min="1">
          <button type="submit" class="btn-principal">Agregar al carrito</button>
        </form>
      </div>
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

  <script src="js/main.js"></script>
</body>
</html>