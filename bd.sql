-- Creamos la base de datos
CREATE DATABASE IF NOT EXISTS biblioteca2;
USE biblioteca2;

-- Creamos la tabla de videojuegos
CREATE TABLE IF NOT EXISTS libros (
    id INT AUTO_INCREMENT PRIMARY KEY,   -- Identificador único
    titulo VARCHAR(150) NOT NULL,        -- Título del videojuego
    escritor VARCHAR(100) NOT NULL, -- Empresa desarrolladora
    formato VARCHAR(50) NOT NULL,     -- Plataforma (PC, PS5, etc.)
    precio VARCHAR(50) NOT NULL,         -- Género del juego
    anio INT NOT NULL                    -- Año de lanzamiento
);
