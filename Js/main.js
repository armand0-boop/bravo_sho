// main.js
// Aquí puedes agregar funciones como agregar al carrito, alertas, etc.
function cambiarCantidad(valor) {
  const input = document.getElementById('cantidad');
  let cantidad = parseInt(input.value);
  cantidad = Math.max(1, cantidad + valor);
  input.value = cantidad;
}
