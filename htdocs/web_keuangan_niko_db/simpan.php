<?php
require_once 'koneksi.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validasi input
        if (empty($_POST['total_uang']) || empty($_POST['jumlah_hari'])) {
            throw new Exception("Total uang dan jumlah hari harus diisi!");
        }

        $total_uang = (int)$_POST['total_uang'];
        $jumlah_hari = (int)$_POST['jumlah_hari'];

        // Validasi nilai
        if ($total_uang <= 0) {
            throw new Exception("Total uang harus lebih dari 0!");
        }
        if ($jumlah_hari <= 0) {
            throw new Exception("Jumlah hari harus lebih dari 0!");
        }

        // Hitung hasil per hari
        $hasil_perhari = floor($total_uang / $jumlah_hari);
        $tanggal_input = date('Y-m-d');

        // Simpan ke database
        $stmt = $koneksi->prepare("INSERT INTO pengeluaran (total_uang, jumlah_hari, hasil_perhari, tanggal_input) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $koneksi->error);
        }

        $stmt->bind_param("iiis", $total_uang, $jumlah_hari, $hasil_perhari, $tanggal_input);
        
        if (!$stmt->execute()) {
            throw new Exception("Gagal menyimpan data: " . $stmt->error);
        }

        // Redirect dengan hasil
        header("Location: index.php?hasil=" . $hasil_perhari . "&success=1");
        exit();
    }
} catch (Exception $e) {
    // Redirect dengan pesan error
    header("Location: index.php?error=" . urlencode($e->getMessage()));
    exit();
}

// Jika bukan POST request, kembali ke halaman utama
header("Location: index.php");
exit();
?>
?>