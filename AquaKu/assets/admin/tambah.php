<?php
session_start();
include __DIR__ . "/koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

if(isset($_POST['tambah'])){
    $foto = trim($_POST['foto'] ?? '');
    $nama_ikan = trim($_POST['nama_ikan'] ?? '');
    $jenis = trim($_POST['jenis'] ?? '');
    $warna = trim($_POST['warna'] ?? '');
    $kondisi = trim($_POST['kondisi'] ?? '');

    $stmt = mysqli_prepare($koneksi, "INSERT INTO ikan (foto, nama_ikan, jenis, warna, kondisi) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . mysqli_error($koneksi));
    }
    mysqli_stmt_bind_param($stmt, "sssss", $foto, $nama_ikan, $jenis, $warna, $kondisi);
    if (!mysqli_stmt_execute($stmt)) {
        die("Execute failed: " . mysqli_stmt_error($stmt));
    }
    mysqli_stmt_close($stmt);

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Ikan - AquaKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="../style.css">
</head>
<body class="bg-light">

<!-- Admin Navbar -->
<nav class="navbar navbar-expand-lg admin-nav">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">AquaKu Admin</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container my-5">
    <div class="form-card">
        <div class="card-header-custom">
            <h3>Tambah Ikan Baru</h3>
            <p>Tambahkan data ikan baru ke koleksi</p>
        </div>
        <form method="POST">
            <div class="mb-4">
                <label class="form-label">Foto (nama file + ekstensi)</label>
                <input type="text" name="foto" class="form-control" placeholder="contoh: glofish-pink.jpg" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Nama Ikan</label>
                <input type="text" name="nama_ikan" class="form-control" placeholder="contoh: GloFish Pink" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Jenis Ikan</label>
                <input type="text" name="jenis" class="form-control" placeholder="contoh: Ikan Hias" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Warna</label>
                <input type="text" name="warna" class="form-control" placeholder="contoh: Pink" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Kondisi</label>
                <select name="kondisi" class="form-control" required>
                    <option value="">Pilih kondisi</option>
                    <option value="Sehat">Sehat</option>
                    <option value="Mengalami Perawatan">Mengalami Perawatan</option>
                </select>
            </div>
            <button type="submit" name="tambah" class="btn-submit">
                Tambah Ikan
            </button>
            <a href="dashboard.php" class="btn-cancel">
                Kembali ke Dashboard
            </a>
        </form>
    </div>
</div>

</body>
</html>
