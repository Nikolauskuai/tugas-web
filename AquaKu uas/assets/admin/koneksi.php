<?php
/**
 * KONEKSI DATABASE - AQUAKU
 * 
 * INSTRUKSI UNTUK INFINITYFREE:
 * 1. Buat database di InfinityFree cPanel
 * 2. Ganti nilai di bawah dengan kredensial hosting Anda
 * 3. Import file database.sql ke phpMyAdmin
 */

// Konfigurasi Database - UBAH SESUAI DENGAN HOSTING ANDA
$host     = "localhost";
$username = "root";
$password = "";
$database = "aquaku";

// Koneksi MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$koneksi = mysqli_connect($host, $username, $password, $database);

// Set charset
mysqli_set_charset($koneksi, "utf8mb4");

// Cek koneksi (tampilkan pesan yang ramah)
if (!$koneksi) {
    die("Koneksi database gagal. Periksa file koneksi.php");
}
?>
