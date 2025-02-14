DROP DATABASE IF EXISTS clientes;
CREATE DATABASE clientes;

USE clientes;

CREATE TABLE usuarios (
    correo VARCHAR(100) PRIMARY KEY,
    contraseña VARCHAR(255) UNIQUE,
    nombre VARCHAR(25),
    apellido VARCHAR(25)
);

CREATE TABLE tareas (
    id_tarea INT PRIMARY KEY AUTO_INCREMENT,
    correo VARCHAR(100),
    nombre_tarea VARCHAR(50),
    descripcion VARCHAR(50),
    fecha_inicio DATE,
    estado VARCHAR(10),
    FOREIGN KEY (correo) REFERENCES usuarios(correo)
);

INSERT INTO usuarios (correo, contraseña, nombre, apellido)
VALUES
('juan.perez@email.com', '$2b$12$c3HWu80mSduX9gNIIyJ8nuCX0L6Lq9k/N3sH6RuTcWAQn0iGWU3aG', 'Juan', 'Pérez'),
('maria.gomez@email.com', '$2b$12$LYdAWAXy6sOaO.t1vGZOB.SoG/yWgQivLnyIa9KbhTX/ClRL0KAaG', 'María', 'Gómez'),
('luis.martinez@email.com', '$2b$12$5.AzLdsWNDIbQ5v4MRFZD.ori8nuf0PTgNXsyRkHj1MuBCDJjiRZa', 'Luis', 'Martínez');
-- juan tiene como contraseña -> contraseña123
-- maria tiene como contraseña -> password456
-- luis tiene como contraseña -> contraseña789



-- Insertar tareas correspondientes a Juan Pérez
INSERT INTO tareas (correo, nombre_tarea, descripcion, fecha_inicio, estado)
VALUES
('juan.perez@email.com', 'Revisión de informe', 'Revisar el informe de ventas', '2025-02-12', 'Pendiente'),
('juan.perez@email.com', 'Reunión con cliente', 'Reunión para discutir nuevos proyectos', '2025-02-13', 'Pendiente');

-- Insertar tareas correspondientes a María Gómez
INSERT INTO tareas (correo, nombre_tarea, descripcion, fecha_inicio, estado)
VALUES
('maria.gomez@email.com', 'Actualización de base de datos', 'Actualizar registros en la base de datos', '2025-02-12', 'Pendiente'),
('maria.gomez@email.com', 'Llamada a proveedores', 'Llamar a proveedores para seguimiento de pedidos', '2025-02-14', 'Pendiente');

-- Insertar tareas correspondientes a Luis Martínez
INSERT INTO tareas (correo, nombre_tarea, descripcion, fecha_inicio, estado)
VALUES
('luis.martinez@email.com', 'Redacción de reporte', 'Redactar el reporte mensual de actividades', '2025-02-15', 'Pendiente'),
('luis.martinez@email.com', 'Revisión de contrato', 'Revisar el contrato con el nuevo proveedor', '2025-02-16', 'Pendiente');
select * from usuarios;
select * from tareas where correo='juan.perez@email.com';
