<?php
require_once 'koneksi.php';

$result = $koneksi->query("SELECT * FROM pengeluaran ORDER BY tanggal_input DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi - Keuangan Niko</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>📊 Data Transaksi Pengeluaran</h1>
        </header>

        <?php if ($result && $result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Total Uang</th>
                        <th>Hari</th>
                        <th>Harian</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td>Rp <?= number_format($row['total_uang'], 0, ',', '.') ?></td>
                        <td><?= htmlspecialchars($row['jumlah_hari']) ?> hari</td>
                        <td>Rp <?= number_format($row['hasil_perhari'], 0, ',', '.') ?></td>
                        <td><?= htmlspecialchars($row['tanggal_input']) ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="text-align: center; color: #666; margin-top: 20px;">Belum ada data transaksi.</p>
        <?php endif; ?>

        <a href="index.php">Kembali ke Beranda</a>
    </div>
</body>
</html>