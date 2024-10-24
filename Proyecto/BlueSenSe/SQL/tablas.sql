CREATE TABLE Calidades (
    pk_calidades INT AUTO_INCREMENT PRIMARY KEY,
    nombre_calidad VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE Fuentes (
    pk_fuentes INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    coordenadas POINT NOT NULL,
    calidad_id INT NOT NULL,
    descripcion TEXT NOT NULL,
    FOREIGN KEY (calidad_id) REFERENCES Calidades(pk_calidades) ON DELETE CASCADE
);

CREATE TABLE ParametrosCalidad (
    pk_parametros INT AUTO_INCREMENT PRIMARY KEY,
    fuente_id INT,
    fecha_muestra DATETIME,
    ph DECIMAL(5,2) NOT NULL,
    turbidez DECIMAL(5,2) NOT NULL,
    oxigeno DECIMAL(5,2) NOT NULL,
    temperatura DECIMAL(5,2) NOT NULL,
    FOREIGN KEY (fuente_id) REFERENCES Fuentes(pk_fuentes) ON DELETE CASCADE
);

INSERT INTO Calidades (nombre_calidad)
VALUES
('Peligrosa'),
('Moderada'),
('Buena');


INSERT INTO Fuentes (nombre, coordenadas, calidad_id, descripcion)
VALUES
('Rio San Pedro', POINT(20.80394858195299, -104.40808974962866), 2, 'Agua apta solo para riego.'),
('Río Mololoa', POINT(21.51585409995925, -104.88884195220137), 1, 'Agua altamente contaminada, no debe ser usada.'),
('Rio Grande', POINT(21.264028, -104.343727), 1, 'Agua altamente contaminada, no debe ser usada.'),
('Laguna de Mora', POINT(21.516758, -104.811909), 3, 'Agua en óptimas condiciones.'),
('Rio chiquito Amatlan de Cañas', POINT(20.80394858195299, -104.40808974962866), 3, 'Agua en óptimas condiciones.'),
('Rio Ameca', POINT(20.838401, -104.495727), 2, 'Agua apta solo para riego.'),
('Cascada el Cora', POINT(21.414812193928924, -105.12698881963927), 3, 'Agua en óptimas condiciones.'),
('Rio Huicicila', POINT(21.320345002104013, -105.055278545828), 3, 'Agua en óptimas condiciones.'),
('Rio Huajimic', POINT(21.682471382309757, -104.31890872392408), 3, 'Agua en óptimas condiciones.'),
('Laguna de Tepeltitic', POINT(21.273760171607496, -104.68462570269907), 3, 'Agua en óptimas condiciones.'),
('Laguna de San Pedro Lagunillas', POINT(21.207092, -104.733817), 3, 'Agua en óptimas condiciones.'),
('Presa de Refilion', POINT(21.31053327955347, -104.89369957722249), 2, 'Agua apta solo para riego.'),
('Laguna Garzas', POINT(22.16928318601648, -105.40931795578376), 3, 'Agua en óptimas condiciones.'),
('Rio Acaponeta', POINT(22.16928318601648, -105.40931795578376), 3, 'Agua en óptimas condiciones.');

INSERT INTO ParametrosCalidad (fuente_id, fecha_muestra, ph, turbidez, oxigeno, temperatura)
VALUES
(1, '2024-10-01 10:00:00', 7.2, 1.5, 8.0, 22.5),  -- Rio San Pedro
(2, '2024-10-01 10:00:00', 4.5, 10.0, 2.5, 25.0), -- Río Mololoa
(3, '2024-10-01 10:00:00', 4.2, 12.0, 3.0, 26.0), -- Rio Grande
(4, '2024-10-01 10:00:00', 7.5, 0.5, 9.0, 20.0),  -- Laguna de Mora
(5, '2024-10-01 10:00:00', 7.8, 0.8, 9.5, 21.0),  -- Rio chiquito Amatlan de Cañas
(6, '2024-10-01 10:00:00', 6.8, 1.0, 7.5, 24.0),  -- Rio Ameca
(7, '2024-10-01 10:00:00', 7.0, 0.3, 8.5, 19.5),  -- Cascada el Cora
(8, '2024-10-01 10:00:00', 7.2, 0.4, 8.8, 20.5),  -- Rio Huicicila
(9, '2024-10-01 10:00:00', 7.1, 0.2, 9.0, 21.5),  -- Rio Huajimic
(10, '2024-10-01 10:00:00', 7.3, 0.6, 8.3, 22.0),  -- Laguna de Tepeltitic
(11, '2024-10-01 10:00:00', 7.4, 0.7, 8.1, 22.8),  -- Laguna de San Pedro Lagunillas
(12, '2024-10-01 10:00:00', 6.9, 1.2, 7.0, 23.5),  -- Presa de Refilion
(13, '2024-10-01 10:00:00', 7.5, 0.9, 9.1, 20.0),  -- Laguna Garzas
(14, '2024-10-01 10:00:00', 7.6, 1.1, 8.7, 21.2);  -- Rio Acaponeta