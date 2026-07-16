<?php
try {
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'db_keuangan_niko';

    $koneksi = new mysqli($host, $username, $password);
    
    // Buat database jika belum ada
    $koneksi->query("CREATE DATABASE IF NOT EXISTS db_keuangan_niko");
    
    // Pilih database
    $koneksi->select_db($database);
    
    // Buat tabel jika belum ada
    $sql = "CREATE TABLE IF NOT EXISTS pengeluaran (
        id INT AUTO_INCREMENT PRIMARY KEY,
        total_uang INT NOT NULL,
        jumlah_hari INT NOT NULL,
        hasil_perhari INT NOT NULL,
        tanggal_input DATE NOT NULL
    )";
    
    $koneksi->query($sql);

} catch (Exception $e) {
    die("Koneksi atau pembuatan database gagal: " . $e->getMessage());
}
?>