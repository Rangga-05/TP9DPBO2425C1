-- Create database
CREATE DATABASE IF NOT EXISTS mvp_db;
USE mvp_db;

-- Create table pembalap
CREATE TABLE IF NOT EXISTS pembalap (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    tim VARCHAR(255) NOT NULL,
    negara VARCHAR(255) NOT NULL,
    poinMusim INT DEFAULT 0,
    jumlahMenang INT DEFAULT 0
);

-- Insert data pembalap
INSERT INTO pembalap (nama, tim, negara, poinMusim, jumlahMenang) VALUES
('Lewis Hamilton', 'Mercedes', 'United Kingdom', 347, 11),
('Max Verstappen', 'Red Bull', 'Netherlands', 335, 10),
('Valtteri Bottas', 'Mercedes', 'Finland', 203, 2),
('Sergio Perez', 'Red Bull', 'Mexico', 190, 1),
('Carlos Sainz', 'Ferrari', 'Spain', 150, 0),
('Daniel Ricciardo', 'McLaren', 'Australia', 115, 1),
('Charles Leclerc', 'Ferrari', 'Monaco', 95, 0),
('Lando Norris', 'McLaren', 'United Kingdom', 88, 0),
('Pierre Gasly', 'AlphaTauri', 'France', 75, 0),
('Fernando Alonso', 'Alpine', 'Spain', 65, 0);

-- Create table sirkuit
CREATE TABLE IF NOT EXISTS mobil (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kodeRangka VARCHAR(50) NOT NULL,
    merkMesin VARCHAR(100) NOT NULL,
    warna VARCHAR(255) NOT NULL,
    topKecepatan INT DEFAULT 0
);

-- Insert data mobil
INSERT INTO mobil (kodeRangka, merkMesin, warna, topKecepatan) VALUES
('RB19', 'Honda RBPT', 'Navy Blue', 350),
('W14', 'Mercedes', 'Silver', 345),
('SF-23', 'Ferrari', 'Red', 348);