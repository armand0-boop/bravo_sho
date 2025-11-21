CREATE DATABASE IF NOT EXISTS bravo_shop;
USE bravo_shop;

CREATE TABLE productos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100),
  descripcion TEXT,
  precio DECIMAL(10,2),
  imagen VARCHAR(100),
  disponible TINYINT(1) DEFAULT 1
);

INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES
('LA azul', 'Gorra azul estilo LA', 299.00, 'la_azul.jpg'),
('Yankees black', 'Gorra negra Yankees', 349.00, 'yankees_black.jpg'),
('Sad Boys - Junior H', 'Gorra Sad Boys edición Junior H', 399.00, 'sad_boys.jpg');