CREATE DATABASE IF NOT EXISTS residencia;
USE residencia;

-- 1. TABLA: Administrador
-- Almacena los datos personales de quienes gestionan el sistema.
CREATE TABLE Administrador (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidoPaterno VARCHAR(100) NOT NULL,
    apellidoMaterno VARCHAR(100) NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL
);

-- 2. TABLA: Residente
-- Incluye 'registrado_por' para saber qué admin hizo el alta y 'fecha_registro' para la interfaz de lista.
CREATE TABLE Residente (
    id_residente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidoPaterno VARCHAR(100) NOT NULL,
    apellidoMaterno VARCHAR(100) NOT NULL,
    num_residencia VARCHAR(50) NOT NULL, -- Antes direccionF
    telefono VARCHAR(15) UNIQUE,
    correo VARCHAR(100) UNIQUE NOT NULL,
    id_admin_registro INT, -- Llave foránea para saber quién lo dio de alta
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_admin_registro) REFERENCES Administrador(id_admin)
);

-- 3. TABLA: Usuario (Sistema de Login)
CREATE TABLE Usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL, -- Aumentado para soportar hashes de PHP
    rol ENUM('residente', 'admin') NOT NULL,
    id_residente INT NULL,
    id_admin INT NULL,
    FOREIGN KEY (id_residente) REFERENCES Residente(id_residente) ON DELETE CASCADE,
    FOREIGN KEY (id_admin) REFERENCES Administrador(id_admin) ON DELETE CASCADE
);

-- 4. TABLA: AreaComun
CREATE TABLE AreaComun (
    id_area INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL, -- Alberca, Parque, Canchas
    descripcion TEXT
);

-- 5. TABLA: SolicitudAcceso
-- Conecta con la interfaz de "Autorizar Accesos"
CREATE TABLE SolicitudAcceso (
    id_solicitud INT AUTO_INCREMENT PRIMARY KEY,
    id_residente INT NOT NULL,
    id_area INT NOT NULL,
    id_admin_valida INT, -- Admin que aprueba o rechaza
    fecha_solicitada DATE NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('Pendiente', 'Aprobado', 'Rechazado') DEFAULT 'Pendiente',
    comentario_residente TEXT,
    comentario_admin TEXT,
    FOREIGN KEY (id_residente) REFERENCES Residente(id_residente),
    FOREIGN KEY (id_area) REFERENCES AreaComun(id_area),
    FOREIGN KEY (id_admin_valida) REFERENCES Administrador(id_admin)
);

-- 6. TABLA: Cuotas
CREATE TABLE Cuota (
    id_cuota INT AUTO_INCREMENT PRIMARY KEY,
    mes VARCHAR(20) NOT NULL,
    anio INT NOT NULL,
    monto DECIMAL(10,2) NOT NULL,
    descripcion VARCHAR(100) -- Ej: "Mantenimiento Mensual"
);

-- 7. TABLA: Pagos y Comprobantes
-- Unificada para facilitar la interfaz de "Validar Comprobantes"
CREATE TABLE Pago (
    id_pago INT AUTO_INCREMENT PRIMARY KEY,
    id_residente INT NOT NULL,
    id_cuota INT NOT NULL,
    monto_pagado DECIMAL(10,2) NOT NULL,
    fecha_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    archivo_comprobante VARCHAR(255), -- Ruta de la imagen o PDF
    estado ENUM('Pendiente', 'Validado', 'Rechazado') DEFAULT 'Pendiente',
    motivo_rechazo TEXT,
    FOREIGN KEY (id_residente) REFERENCES Residente(id_residente),
    FOREIGN KEY (id_cuota) REFERENCES Cuota(id_cuota)
);

ALTER TABLE Pago ADD COLUMN concepto VARCHAR(100), ADD COLUMN folio VARCHAR(50);
-- ==========================================
-- DATOS INICIALES PARA PRUEBAS
-- ==========================================

-- Insertar Áreas
INSERT INTO AreaComun (nombre, descripcion) VALUES 
('Alberca', 'Área techada con calefacción'),
('Parque', 'Zona de juegos infantiles'),
('Canchas', 'Cancha de usos múltiples');

-- Insertar un Administrador principal
INSERT INTO Administrador (nombre, apellidoPaterno, apellidoMaterno, correo) 
VALUES ('Citlalli Carolina', 'Carpintero', 'Ortiz', 'citla@gmail.com');

INSERT INTO Administrador (nombre, apellidoPaterno, apellidoMaterno, correo) 
VALUES ('Maria Fernanda', 'Velasco', 'Campos', 'ferchis@gmail.com');

-- Crear su usuario (password: 1234)
INSERT INTO Usuario (username, password, rol, id_admin) 
VALUES ('admin_ferchis', '1234', 'admin', 2);

-- ==============================================
		-- MODIFICAMOS LA TABLA PAGO --
        
-- Primero eliminamos la restricción actual de la tabla pago
ALTER TABLE Pago DROP FOREIGN KEY pago_ibfk_1;

-- La volvemos a crear con "ON DELETE CASCADE"
ALTER TABLE Pago 
ADD CONSTRAINT pago_ibfk_1 
FOREIGN KEY (id_residente) REFERENCES Residente(id_residente) 
ON DELETE CASCADE;

-- Hacemos lo mismo con SolicitudAcceso para que no te de el mismo error después
ALTER TABLE SolicitudAcceso DROP FOREIGN KEY solicitudacceso_ibfk_1;

ALTER TABLE SolicitudAcceso 
ADD CONSTRAINT solicitudacceso_ibfk_1 
FOREIGN KEY (id_residente) REFERENCES Residente(id_residente) 
ON DELETE CASCADE;
-- ==============================================residente_ibfk_1

use residencia;
SELECT * FROM usuario;
SELECT * FROM residente;
SELECT * FROM pago;
SELECT * FROM SolicitudAcceso;
SELECT * FROM administrador;
SELECT * FROM cuota;

USE residencia;
SELECT * FROM administrador;
SELECT * FROM usuario;
SELECT * FROM residente;
