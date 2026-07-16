-- AQUAKU DATABASE SETUP
-- 
-- INSTRUKSI UNTUK INFINITYFREE:
-- 1. Buat database baru di cPanel InfinityFree
-- 2. Catat nama database, username, dan password
-- 3. Import file ini melalui phpMyAdmin
-- 4. Jika import gagal, hapus baris "CREATE DATABASE" di bawah untuk versi hosting

-- Hapus tanda -- di baris bawah ini jika database BELUM dibuat
-- CREATE DATABASE IF NOT EXISTS aquaku CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
-- USE aquaku;

-- Tabel Admin
CREATE TABLE admin (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabel Ikan
CREATE TABLE ikan (
    id INT PRIMARY KEY AUTO_INCREMENT,
    foto VARCHAR(255) NOT NULL,
    nama_ikan VARCHAR(100) NOT NULL,
    jenis VARCHAR(100) NOT NULL,
    warna VARCHAR(100) NOT NULL,
    kondisi VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data Admin Default (username: admin, password: admin123)
-- Password sudah di-hash dengan PHP password_hash()
INSERT INTO admin (username, password) VALUES 
('admin', '$2y$10$T7KN4IyeJzWGiArGjkTWveuvDr3nm3RjoL0PwmwaRDF0MyvrH4kPK')
ON DUPLICATE KEY UPDATE username = username;

-- Data Ikan Sample
INSERT INTO ikan (foto, nama_ikan, jenis, warna, kondisi) VALUES
('glofish-pink.jpg', 'GloFish Pink', 'Ikan Hias', 'Pink', 'Sehat'),
('black-marble.jpg', 'Black Marble', 'Ikan Hias', 'Hitam Marmer', 'Sehat'),
('oranda-red-cap.jpg', 'Oranda Red Cap', 'Ikan Koi', 'Oranye Putih', 'Sehat'),
('fantail.jpg', 'Fantail', 'Ikan Koi', 'Putih Oranye', 'Sehat'),
('glofish-kuning.jpeg', 'GloFish Kuning', 'Ikan Hias', 'Kuning', 'Sehat')
ON DUPLICATE KEY UPDATE foto = VALUES(foto);
