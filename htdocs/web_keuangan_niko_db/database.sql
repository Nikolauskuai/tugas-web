CREATE DATABASE IF NOT EXISTS db_keuangan_niko;

USE db_keuangan_niko;

CREATE TABLE pengeluaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    total_uang INT NOT NULL,
    jumlah_hari INT NOT NULL,
    hasil_perhari INT NOT NULL,
    tanggal_input DATE NOT NULL
);