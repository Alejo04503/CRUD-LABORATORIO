-- Base de datos del laboratorio CRUD.
-- Este script crea una base independiente llamada CRUD.
-- No modifica ni elimina otras bases de datos.

CREATE DATABASE IF NOT EXISTS CRUD
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE CRUD;

CREATE TABLE IF NOT EXISTS PERSONA (
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(45) NOT NULL,
    apellidos VARCHAR(45) NOT NULL,
    telefono VARCHAR(45) NOT NULL,
    ciudad VARCHAR(45) NOT NULL,
    correo VARCHAR(45) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB;
