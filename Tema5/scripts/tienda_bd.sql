-- Eliminar usuario si existe
-- DROP USER IF EXISTS 'MEDAC'@'localhost';

-- Eliminar base de datos si existe
DROP SCHEMA IF EXISTS tienda_bd;

-- SOLO SI NO ESTÁ CREADO
-- CREATE USER 'MEDAC'@'localhost' IDENTIFIED BY 'MEDAC';
-- GRANT ALL PRIVILEGES ON tienda_bd.* TO 'MEDAC'@'localhost';
-- FLUSH PRIVILEGES;

-- Crear base de datos
CREATE SCHEMA tienda_bd;
USE tienda_bd;

CREATE TABLE usuarios (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    telefono VARCHAR(15),
    direccion VARCHAR(200),
    codigo_postal VARCHAR(10),
    ciudad VARCHAR(50),
    admin TINYINT(1) DEFAULT 0,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE productos_hogar (
    id_producto INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT, -- para tner descripciones más largas
    categoria VARCHAR(50) NOT NULL,
    precio DECIMAL(10,2) NOT NULL, -- para ser un poco más precisos
    stock INT NOT NULL DEFAULT 0,
    material VARCHAR(50),
    dimensiones VARCHAR(50),
    color VARCHAR(30),
    imagen VARCHAR(255),
    fecha_alta TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- para poner fechas automáticamente
) ENGINE=InnoDB;

CREATE TABLE productos_electronicos (
    id_producto INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    categoria VARCHAR(50) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    marca VARCHAR(50) NOT NULL,
    modelo VARCHAR(50),
    garantia_meses INT DEFAULT 24,
    especificaciones TEXT,
    imagen VARCHAR(255),
    fecha_alta TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE productos_ropa (
    id_producto INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    categoria VARCHAR(50) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    marca VARCHAR(50),
    talla VARCHAR(10) NOT NULL,
    color VARCHAR(30) NOT NULL,
    genero ENUM('Hombre', 'Mujer', 'Unisex', 'Niño', 'Niña') NOT NULL, -- para valores fijos
    material VARCHAR(50),
    imagen VARCHAR(255),
    fecha_alta TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Contraseña para admin: admin123
-- Contraseña para cliente: cliente123
INSERT INTO usuarios (nombre, apellidos, email, contrasena, telefono, direccion, codigo_postal, ciudad, admin) VALUES
('Admin', 'Sistema', 'admin@tienda.com', '$2y$10$9li1K8DsJom4bys/zSZrpumVqJcD.7ELJ5o8vxl7FWaAnvGvaZkpy', '666111222', 'Calle Admin 1', '28001', 'Madrid', 1),
('Juan', 'Pérez García', 'juan@email.com', '$2y$10$vEfHqW4qyKGN3rXK6jMWu.m5qKXdT0mYH5.rNlPKWxV3HpYJLyJe6', '666333444', 'Calle Cliente 5', '28002', 'Madrid', 0),
('María', 'López Martín', 'maria@email.com', '$2y$10$vEfHqW4qyKGN3rXK6jMWu.m5qKXdT0mYH5.rNlPKWxV3HpYJLyJe6', '666555666', 'Avenida Sol 12', '41001', 'Sevilla', 0);


INSERT INTO productos_hogar (nombre, descripcion, categoria, precio, stock, material, dimensiones, color, imagen) VALUES
('Sofá Nórdico 3 Plazas', 'Sofá cómodo estilo escandinavo con patas de madera', 'Muebles', 599.99, 8, 'Tela y Madera', '210x85x90 cm', 'Gris', 'sofa_nordico.jpg'),
('Mesa de Comedor Extensible', 'Mesa de comedor con extensión para 8 personas', 'Muebles', 349.99, 5, 'Madera', '160-200x90x75 cm', 'Roble', 'mesa_comedor.jpg'),
('Lámpara de Pie Industrial', 'Lámpara de diseño industrial con trípode', 'Decoración', 89.99, 15, 'Metal', '150x40 cm', 'Negro', 'lampara_pie.jpg'),
('Juego de Sábanas Premium', 'Sábanas de algodón 100% egipcio de 300 hilos', 'Textil', 79.99, 25, 'Algodón', '150x190 cm', 'Blanco', 'sabanas.jpg'),
('Alfombra Salón Moderna', 'Alfombra suave de pelo corto diseño geométrico', 'Decoración', 129.99, 12, 'Fibra sintética', '200x140 cm', 'Beige', 'alfombra.jpg'),
('Set Ollas Antiadherentes', 'Set de 5 ollas y sartenes antiadherentes', 'Cocina', 149.99, 20, 'Aluminio', 'Varios', 'Negro', 'ollas.jpg'),
('Estantería Modular', 'Estantería de 5 baldas estilo nórdico', 'Muebles', 119.99, 10, 'Madera', '180x80x30 cm', 'Blanco', 'estanteria.jpg'),
('Espejo Redondo Dorado', 'Espejo decorativo con marco dorado', 'Decoración', 69.99, 18, 'Cristal y Metal', '60 cm diámetro', 'Dorado', 'espejo.jpg');


INSERT INTO productos_electronicos (nombre, descripcion, categoria, precio, stock, marca, modelo, garantia_meses, especificaciones, imagen) VALUES
('Smartphone Galaxy Max', 'Smartphone de última generación con 5G', 'Smartphones', 799.99, 30, 'Samsung', 'Galaxy Max Pro', 24, 'Pantalla 6.5", 128GB, Cámara 48MP', 'smartphone_samsung.jpg'),
('Portátil Gaming Pro', 'Portátil gaming con procesador i7 y RTX 4060', 'Portátiles', 1299.99, 12, 'ASUS', 'ROG Strix G16', 24, 'Intel i7-13650HX, 16GB RAM, RTX 4060, 512GB SSD', 'portatil_gaming.jpg'),
('Smart TV 55 pulgadas', 'Televisor 4K UHD con Smart TV y HDR', 'Televisores', 549.99, 15, 'LG', 'OLED55C3', 24, '55" 4K OLED, WebOS, HDMI 2.1, 120Hz', 'tv_lg.jpg'),
('Auriculares Noise Cancelling', 'Auriculares inalámbricos con cancelación de ruido', 'Audio', 349.99, 25, 'Sony', 'WH-1000XM5', 24, 'Bluetooth 5.2, 30h autonomía, cancelación ruido adaptativa', 'auriculares_sony.jpg'),
('Tablet Pro 12.9', 'Tablet profesional con lápiz incluido', 'Tablets', 1099.99, 18, 'Apple', 'iPad Pro', 12, 'Chip M2, 12.9", 256GB, Pencil incluido', 'tablet_ipad.jpg'),
('Smartwatch deportivo', 'Reloj inteligente con GPS y monitor cardíaco', 'Wearables', 249.99, 40, 'Garmin', 'Forerunner 265', 24, 'GPS, Monitor cardíaco, 13 días batería', 'smartwatch_garmin.jpg'),
('Altavoz Bluetooth Premium', 'Altavoz portátil resistente al agua', 'Audio', 179.99, 22, 'JBL', 'Charge 5', 12, 'Bluetooth, 20h batería, IP67, 40W', 'altavoz_jbl.jpg'),
('Cámara Sin Espejo', 'Cámara mirrorless para fotografía profesional', 'Fotografía', 1899.99, 8, 'Canon', 'EOS R6 Mark II', 24, '24.2MP, 4K 60fps, estabilización IBIS', 'camara_canon.jpg');

-- =====================================================
-- INSERTAR PRODUCTOS DE ROPA
-- =====================================================
INSERT INTO productos_ropa (nombre, descripcion, categoria, precio, stock, marca, talla, color, genero, material, imagen) VALUES
('Camiseta Básica Premium', 'Camiseta de algodón orgánico', 'Camisetas', 24.99, 50, 'H&M', 'M', 'Negro', 'Unisex', 'Algodón 100%', 'camiseta_basica.jpg'),
('Vaqueros Slim Fit', 'Pantalones vaqueros ajustados', 'Pantalones', 59.99, 35, 'LeviS', '32', 'Azul', 'Hombre', 'Denim', 'vaqueros_levis.jpg'),
('Vestido Floral Verano', 'Vestido ligero con estampado floral', 'Vestidos', 49.99, 28, 'Zara', 'M', 'Multicolor', 'Mujer', 'Algodón y Poliéster', 'vestido_floral.jpg'),
('Sudadera con Capucha', 'Sudadera deportiva con capucha y bolsillo', 'Sudaderas', 39.99, 45, 'Nike', 'L', 'Gris', 'Unisex', 'Algodón 80%', 'sudadera_nike.jpg'),
('Zapatillas Running', 'Zapatillas deportivas para running', 'Calzado', 89.99, 30, 'Adidas', '42', 'Negro', 'Unisex', 'Sintético', 'zapatillas_adidas.jpg'),
('Chaqueta Vaquera', 'Chaqueta denim clásica', 'Chaquetas', 69.99, 20, 'Pull&Bear', 'L', 'Azul', 'Mujer', 'Denim', 'chaqueta_vaquera.jpg'),
('Camisa Lino Blanca', 'Camisa de lino perfecta para verano', 'Camisas', 44.99, 25, 'Massimo Dutti', 'M', 'Blanco', 'Hombre', 'Lino 100%', 'camisa_lino.jpg'),
('Pantalón Chino', 'Pantalón chino casual elegante', 'Pantalones', 54.99, 32, 'Dockers', '34', 'Beige', 'Hombre', 'Algodón', 'pantalon_chino.jpg'),
('Falda Plisada', 'Falda midi plisada elegante', 'Faldas', 39.99, 22, 'Mango', 'S', 'Negro', 'Mujer', 'Poliéster', 'falda_plisada.jpg'),
('Abrigo Lana', 'Abrigo largo de lana para invierno', 'Abrigos', 149.99, 15, 'Bershka', 'M', 'Camel', 'Mujer', 'Lana 70%', 'abrigo_lana.jpg');


