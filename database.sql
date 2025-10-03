-- ==================================================
-- CREACIÓN DE TABLAS PARA EL PROYECTO ALOJAMIENTOS
-- Base de datos: alogamientos
-- ==================================================

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    tipo ENUM('usuario', 'admin') DEFAULT 'usuario'
);

-- Tabla de alojamientos
CREATE TABLE IF NOT EXISTS alojamientos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT,
    ubicacion VARCHAR(150),
    precio DECIMAL(10, 2) NOT NULL,
    imagen VARCHAR(255)
);

-- Relación usuarios - alojamientos (qué alojamientos eligió cada usuario)
CREATE TABLE IF NOT EXISTS usuarios_alojamientos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    alojamiento_id INT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios (id) ON DELETE CASCADE,
    FOREIGN KEY (alojamiento_id) REFERENCES alojamientos (id) ON DELETE CASCADE
);

-- ==================================================
-- INSERTS DE PRUEBA
-- ==================================================

-- Usuario administrador
INSERT INTO
    usuarios (nombre, email, password, tipo)
VALUES (
        'Administrador',
        'admin@example.com',
        MD5('admin123'),
        'admin'
    );

-- Usuarios normales
INSERT INTO
    usuarios (nombre, email, password, tipo)
VALUES (
        'Juan Pérez',
        'juan@example.com',
        MD5('1234'),
        'usuario'
    ),
    (
        'Ana López',
        'ana@example.com',
        MD5('1234'),
        'usuario'
    );

-- Alojamientos de ejemplo
INSERT INTO
    alojamientos (
        nombre,
        descripcion,
        ubicacion,
        precio,
        imagen
    )
VALUES (
        'Hotel Playa Bonita',
        'Hotel frente al mar con desayuno incluido',
        'La Libertad',
        85.00,
        'playa.jpg'
    ),
    (
        'Cabaña Montaña Verde',
        'Cabaña en el bosque con chimenea',
        'Chalatenango',
        60.00,
        'cabana.jpg'
    ),
    (
        'Hostal Centro Histórico',
        'Habitación económica en el centro de San Salvador',
        'San Salvador',
        25.00,
        'hostal.jpg'
    ),
    (
        'Resort Costa Azul',
        'Resort con piscina y spa',
        'Sonsonate',
        120.00,
        'resort.jpg'
    );