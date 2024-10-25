
create database clinicadb;
USE clinicadb;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


--
-- Base de datos:CLINICA
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla consultarhc
--



-- Tabla para almacenar información de los médicos
CREATE TABLE medico (
    id_medico INT AUTO_INCREMENT PRIMARY KEY,
    rol_medico VARCHAR (50) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    documento VARCHAR(20) NOT NULL UNIQUE,
    correo VARCHAR(100) NOT NULL,
    telefono VARCHAR(15), -- Campo para almacenar el teléfono del médico
    contrasena VARCHAR(255) NOT NULL  -- Almacena el hash de la contraseña
);

-- Tabla para almacenar información de los pacientes
CREATE TABLE paciente (
    id_paciente INT AUTO_INCREMENT PRIMARY KEY,
    rol_paciente VARCHAR (50) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    documento VARCHAR(20) NOT NULL UNIQUE,
    correo VARCHAR(100) NOT NULL,
    telefono VARCHAR(15), -- Campo para almacenar el teléfono del paciente
    contrasena VARCHAR(255) NOT NULL  -- Almacena el hash de la contraseña
);

-- Tabla para almacenar el historial clínico, diagnóstico y tratamiento
CREATE TABLE historial_clinico (
    id_historial INT AUTO_INCREMENT PRIMARY KEY,
    id_paciente INT,
    id_medico INT,
    diagnostico TEXT NOT NULL,
    tratamiento TEXT NOT NULL,
    fecha DATE NOT NULL,
    FOREIGN KEY (id_paciente) REFERENCES paciente(id_paciente),
    FOREIGN KEY (id_medico) REFERENCES medico(id_medico)
);
