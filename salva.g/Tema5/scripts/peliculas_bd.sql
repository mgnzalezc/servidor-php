-- CREATE SCHEMA peliculas_bd;
-- USE peliculas_bd;

-- CREATE TABLE estudios (
-- 	nombre_estudio VARCHAR(30) PRIMARY KEY,
--     ciudad VARCHAR(40),
--     anno_fundacion NUMERIC(4,0)
-- );

-- CREATE TABLE peliculas (
-- 	id_pelicula INT PRIMARY KEY AUTO_INCREMENT,
--     titulo VARCHAR(80) UNIQUE,
--     nombre_estudio VARCHAR(30),
--     anno_estreno NUMERIC(4,0),
--     num_temporadas NUMERIC(2,0),
--     FOREIGN KEY (nombre_estudio) REFERENCES estudios(nombre_estudio)
-- );

-- INSERT INTO estudios VALUES ('Warner Bros', 'Burbank', 1923);
-- INSERT INTO estudios VALUES ('Universal Pictures', 'Universal City', 1912);
-- INSERT INTO estudios VALUES ('Paramount Pictures', 'Hollywood', 1912);
-- INSERT INTO estudios VALUES ('20th Century Studios', 'Los Angeles', 1935);
-- INSERT INTO estudios VALUES ('Columbia Pictures', 'Culver City', 1924);
-- INSERT INTO estudios VALUES ('Walt Disney Pictures', 'Burbank', 1923);
-- INSERT INTO estudios VALUES ('Marvel Studios', 'Burbank', 2008);
-- INSERT INTO estudios VALUES ('Lucasfilm', 'San Francisco', 1971);
-- INSERT INTO estudios VALUES ('DreamWorks', 'Glendale', 1994);
-- INSERT INTO estudios VALUES ('Pixar', 'Emeryville', 1986);
-- INSERT INTO estudios VALUES ('New Line Cinema', 'Los Angeles', 1967);
-- INSERT INTO estudios VALUES ('Lionsgate', 'Santa Monica', 1997);
-- INSERT INTO estudios VALUES ('A24', 'Nueva York', 2012);
-- INSERT INTO estudios VALUES ('MGM', 'Beverly Hills', 1924);

-- INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas) 
-- 	VALUES ('The Dark Knight', 'Warner Bros', 2008, 3);
-- INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas) 
-- 	VALUES ('Oppenheimer', 'Universal Pictures', 2023, 1);
-- INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas) 
-- 	VALUES ('Inception', 'Warner Bros', 2010, 1);
-- INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas) 
-- 	VALUES ('Interstellar', 'Paramount Pictures', 2014, 1);
-- INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas) 
-- 	VALUES ('Avatar', '20th Century Studios', 2009, 2);
-- INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas) 
-- 	VALUES ('Titanic', '20th Century Studios', 1997, 1);
-- INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas) 
-- 	VALUES ('The Shawshank Redemption', 'Columbia Pictures', 1994, 1);
-- INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas) 
-- 	VALUES ('Avengers: Endgame', 'Marvel Studios', 2019, 4);
-- INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas) 
-- 	VALUES ('Black Panther', 'Marvel Studios', 2018, 2);
-- INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas) 
-- 	VALUES ('Spider-Man: No Way Home', 'Marvel Studios', 2021, 3);
-- INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas) 
-- 	VALUES ('Star Wars: The Force Awakens', 'Lucasfilm', 2015, 3);
-- INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas) 
-- 	VALUES ('Indiana Jones and the Last Crusade', 'Lucasfilm', 1989, 4);
-- INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas) 
-- 	VALUES ('Jurassic Park', 'Universal Pictures', 1993, 3);
-- INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas) 
-- 	VALUES ('The Lord of the Rings: The Return of the King', 'New Line Cinema', 2003, 3);
-- INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas) 
-- 	VALUES ('Toy Story', 'Pixar', 1995, 4);
-- INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas) 
-- 	VALUES ('Finding Nemo', 'Pixar', 2003, 2);
-- INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas) 
-- 	VALUES ('The Lion King', 'Walt Disney Pictures', 1994, 3);
-- INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas) 
-- 	VALUES ('Frozen', 'Walt Disney Pictures', 2013, 2);
-- INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas) 
-- 	VALUES ('Shrek', 'DreamWorks', 2001, 4);
-- INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas) 
-- 	VALUES ('The Hunger Games', 'Lionsgate', 2012, 4);
-- INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas) 
-- 	VALUES ('Everything Everywhere All at Once', 'A24', 2022, 1);
-- INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas) 
-- 	VALUES ('The Matrix', 'Warner Bros', 1999, 4);
-- INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas) 
-- 	VALUES ('Rocky', 'MGM', 1976, 6);
    
-- USE peliculas_bd;
-- SELECT titulo, nombre_estudio FROM peliculas ORDER BY titulo DESC;
-- SELECT * FROM peliculas WHERE titulo = "Oppenheimer";
-- SELECT * FROM peliculas WHERE titulo LIKE "%oppenheimer%";
-- SELECT * FROM peliculas;
-- SELECT * FROM estudios;
-- -- Titulo pelicula, estudio, ciudad
-- SELECT p.titulo, e.nombre_estudio, e.ciudad
-- 	FROM peliculas p JOIN estudios e 
-- 		ON p.nombre_estudio = e.nombre_estudio;

-- -- Crear usuario MEDAC
-- CREATE USER IF NOT EXISTS 'MEDAC'@'localhost' IDENTIFIED BY 'MEDAC';
-- GRANT ALL PRIVILEGES ON peliculas_bd.* TO 'MEDAC'@'localhost';
-- FLUSH PRIVILEGES;




-- -------------------SEGUNDA VERSION CARGANDOTE LO ANTERIOR SI EXISTE ---------------------------------------
--encender sql primero y luego apache, apagar sql primero y luego apache

-- Eliminar usuario si existe
DROP USER IF EXISTS 'MEDAC'@'localhost';

-- Eliminar base de datos si existe
DROP SCHEMA IF EXISTS peliculas_bd;

CREATE USER 'MEDAC'@'localhost' IDENTIFIED BY 'MEDAC';
GRANT ALL PRIVILEGES ON *.* TO 'MEDAC'@'localhost';
FLUSH PRIVILEGES;

-- Crear base de datos
CREATE SCHEMA peliculas_bd;
USE peliculas_bd;

CREATE TABLE estudios (
	nombre_estudio VARCHAR(30) PRIMARY KEY,
    ciudad VARCHAR(40),
    anno_fundacion NUMERIC(4,0)
) ENGINE=InnoDB;

CREATE TABLE peliculas (
	id_pelicula INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(80) UNIQUE,
    nombre_estudio VARCHAR(30),
    anno_estreno NUMERIC(4,0),
    num_temporadas NUMERIC(2,0),
    duracion INT COMMENT 'Duración en minutos',
    FOREIGN KEY (nombre_estudio) REFERENCES estudios(nombre_estudio)
) ENGINE=InnoDB;

CREATE TABLE usuarios (
	id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    admin TINYINT(1) DEFAULT 0
) ENGINE=InnoDB;

INSERT INTO estudios VALUES ('Warner Bros', 'Burbank', 1923);
INSERT INTO estudios VALUES ('Universal Pictures', 'Universal City', 1912);
INSERT INTO estudios VALUES ('Paramount Pictures', 'Hollywood', 1912);
INSERT INTO estudios VALUES ('20th Century Studios', 'Los Angeles', 1935);
INSERT INTO estudios VALUES ('Columbia Pictures', 'Culver City', 1924);
INSERT INTO estudios VALUES ('Walt Disney Pictures', 'Burbank', 1923);
INSERT INTO estudios VALUES ('Marvel Studios', 'Burbank', 2008);
INSERT INTO estudios VALUES ('Lucasfilm', 'San Francisco', 1971);
INSERT INTO estudios VALUES ('DreamWorks', 'Glendale', 1994);
INSERT INTO estudios VALUES ('Pixar', 'Emeryville', 1986);
INSERT INTO estudios VALUES ('New Line Cinema', 'Los Angeles', 1967);
INSERT INTO estudios VALUES ('Lionsgate', 'Santa Monica', 1997);
INSERT INTO estudios VALUES ('A24', 'Nueva York', 2012);
INSERT INTO estudios VALUES ('MGM', 'Beverly Hills', 1924);

INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas, duracion) 
	VALUES ('The Dark Knight', 'Warner Bros', 2008, 3, 152);
INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas, duracion) 
	VALUES ('Oppenheimer', 'Universal Pictures', 2023, 1, 180);
INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas, duracion) 
	VALUES ('Inception', 'Warner Bros', 2010, 1, 148);
INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas, duracion) 
	VALUES ('Interstellar', 'Paramount Pictures', 2014, 1, 169);
INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas, duracion) 
	VALUES ('Avatar', '20th Century Studios', 2009, 2, 162);
INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas, duracion) 
	VALUES ('Titanic', '20th Century Studios', 1997, 1, 194);
INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas, duracion) 
	VALUES ('The Shawshank Redemption', 'Columbia Pictures', 1994, 1, 142);
INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas, duracion) 
	VALUES ('Avengers: Endgame', 'Marvel Studios', 2019, 4, 181);
INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas, duracion) 
	VALUES ('Black Panther', 'Marvel Studios', 2018, 2, 134);
INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas, duracion) 
	VALUES ('Spider-Man: No Way Home', 'Marvel Studios', 2021, 3, 148);
INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas, duracion) 
	VALUES ('Star Wars: The Force Awakens', 'Lucasfilm', 2015, 3, 138);
INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas, duracion) 
	VALUES ('Indiana Jones and the Last Crusade', 'Lucasfilm', 1989, 4, 127);
INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas, duracion) 
	VALUES ('Jurassic Park', 'Universal Pictures', 1993, 3, 127);
INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas, duracion) 
	VALUES ('The Lord of the Rings: The Return of the King', 'New Line Cinema', 2003, 3, 201);
INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas, duracion) 
	VALUES ('Toy Story', 'Pixar', 1995, 4, 81);
INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas, duracion) 
	VALUES ('Finding Nemo', 'Pixar', 2003, 2, 100);
INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas, duracion) 
	VALUES ('The Lion King', 'Walt Disney Pictures', 1994, 3, 88);
INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas, duracion) 
	VALUES ('Frozen', 'Walt Disney Pictures', 2013, 2, 102);
INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas, duracion) 
	VALUES ('Shrek', 'DreamWorks', 2001, 4, 90);
INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas, duracion) 
	VALUES ('The Hunger Games', 'Lionsgate', 2012, 4, 142);
INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas, duracion) 
	VALUES ('Everything Everywhere All at Once', 'A24', 2022, 1, 139);
INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas, duracion) 
	VALUES ('The Matrix', 'Warner Bros', 1999, 4, 136);
INSERT INTO peliculas (titulo, nombre_estudio, anno_estreno, num_temporadas, duracion)
	VALUES ('Rocky', 'MGM', 1976, 6, 120);

-- Insertar usuarios de ejemplo
-- Contraseña para admin: admin123 (darle una vuelta a esto para ver por que no furula)
-- Contraseña para cliente: cliente123 (darle una vuelta a esto para ver por que no furula)
-- $2y$10$9li1K8DsJom4bys/zSZrpumVqJcD.7ELJ5o8vxl7FWaAnvGvaZkpy  (de admin123)

INSERT INTO usuarios (usuario, contrasena, admin)
	VALUES ('admin', '$2y$10$lqO8mEqxqPOVxQJfGXJRh.vvMJxDqjFYYvqU7F2zT5bYLZXJ5GYNa', 1);
INSERT INTO usuarios (usuario, contrasena, admin)
	VALUES ('cliente', '$2y$10$vEfHqW4qyKGN3rXK6jMWu.m5qKXdT0mYH5.rNlPKWxV3HpYJLyJe6', 0);

-- Consultas de ejemplo pa probar
USE peliculas_bd;
SELECT titulo, nombre_estudio FROM peliculas ORDER BY titulo DESC;
SELECT * FROM peliculas WHERE titulo = "Oppenheimer";
SELECT * FROM peliculas WHERE titulo LIKE "%oppenheimer%";
SELECT * FROM peliculas;
SELECT * FROM estudios;
-- Titulo pelicula, estudio, ciudad
SELECT p.titulo, e.nombre_estudio, e.ciudad
	FROM peliculas p JOIN estudios e 
		ON p.nombre_estudio = e.nombre_estudio;