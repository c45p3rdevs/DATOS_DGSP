CREATE DATABASE IF NOT EXISTS inventario;
USE inventario;

CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    marca VARCHAR(100),
    modelo VARCHAR(100),
    no_serie VARCHAR(100),
    codigo VARCHAR(100)
);
