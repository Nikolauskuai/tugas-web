<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Keuangan Niko</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>💰 Pengatur Keuangan Niko Laus Kuai</h1>
            
            <div class="profile-section">
                <div class="info">
                    <p><strong>Nama:</strong> Niko Laus Kuai</p>
                    <p><strong>NIM:</strong> 241110056</p>
                    <p><strong>Tempat Kuliah:</strong> Universitas Mercu Buana</p>
                    <p><strong>Asal:</strong> Kalimantan Timur</p>
                </div>
                <div class="photo">
                    <div class="profile-glow"></div>
                    <img src="foto.jpg" alt="Foto Profil Niko">
                </div>
            </div>
        </header>

        <form action="simpan.php" method="POST">
            <div class="form-group">
                <label for="total_uang">Total Uang (Rp)</label>
                <input type="number" id="total_uang" name="total_uang" min="1" required placeholder="Contoh: 300000">
            </div>
            <div class="form-group">
                <label for="jumlah_hari">Jumlah Hari</label>
                <input type="number" id="jumlah_hari" name="jumlah_hari" min="1" required placeholder="Contoh: 7">
            </div>
            <button type="submit">Hitung & Simpan</button>
        </form>

        <?php if (isset($_GET['hasil'])): ?>
            <div class="result">
                Batas pengeluaran per hari: <strong>Rp <?= number_format((int)$_GET['hasil'], 0, ',', '.') ?></strong>
            </div>
        <?php endif; ?>

        <a href="tampil.php">Lihat Semua Data Transaksi</a>
    </div>

    <?php
    // Koneksi ke database
    $host = 'localhost';
    $db   = 'nama_database';
    $user = 'root';
    $pass = '';

    $conn = new mysqli($host, $user, $pass, $db);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Buat tabel pengeluaran jika belum ada
    $sql = "CREATE TABLE IF NOT EXISTS pengeluaran (
        id INT AUTO_INCREMENT PRIMARY KEY,
        total_uang INT NOT NULL,
        jumlah_hari INT NOT NULL,
        hasil_perhari INT NOT NULL,
        tanggal_input DATE NOT NULL
    )";

    if ($conn->query($sql) === TRUE) {
        // Tabel berhasil dibuat
    } else {
        echo "Error creating table: " . $conn->error;
    }

    $conn->close();
    ?>
</body>
</html>