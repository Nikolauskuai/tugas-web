<?php
session_start();
include __DIR__ . "/koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

if(isset($_GET['id'])){
    $id = (int)($_GET['id'] ?? 0);
    $stmt = mysqli_prepare($koneksi, "SELECT id, foto, nama_ikan, jenis, warna, kondisi FROM ikan WHERE id = ? LIMIT 1");
    if (!$stmt) {
        die("Prepare failed: " . mysqli_error($koneksi));
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $query = mysqli_stmt_get_result($stmt);
    $d = mysqli_fetch_array($query);
}

if(isset($_POST['update'])){
    $id = (int)($_POST['id'] ?? 0);
    $foto = trim($_POST['foto'] ?? '');
    $nama_ikan = trim($_POST['nama_ikan'] ?? '');
    $jenis = trim($_POST['jenis'] ?? '');
    $warna = trim($_POST['warna'] ?? '');
    $kondisi = trim($_POST['kondisi'] ?? '');

    $stmt = mysqli_prepare($koneksi, "UPDATE ikan SET foto = ?, nama_ikan = ?, jenis = ?, warna = ?, kondisi = ? WHERE id = ?");
    if (!$stmt) {
        die("Prepare failed: " . mysqli_error($koneksi));
    }
    mysqli_stmt_bind_param($stmt, "sssssi", $foto, $nama_ikan, $jenis, $warna, $kondisi, $id);
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
    <title>Edit Ikan - AquaKu</title>
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
            <h3>Edit Data Ikan</h3>
            <p>Perbarui informasi ikan yang ada</p>
        </div>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo (int)$d['id']; ?>">
            
            <div class="mb-4">
                <label class="form-label">Foto (nama file + ekstensi)</label>
                <input type="text" name="foto" class="form-control" value="<?php echo htmlspecialchars($d['foto'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Nama Ikan</label>
                <input type="text" name="nama_ikan" class="form-control" value="<?php echo htmlspecialchars($d['nama_ikan'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Jenis Ikan</label>
                <input type="text" name="jenis" class="form-control" value="<?php echo htmlspecialchars($d['jenis'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Warna</label>
                <input type="text" name="warna" class="form-control" value="<?php echo htmlspecialchars($d['warna'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Kondisi</label>
                <select name="kondisi" class="form-control" required>
                    <option value="">Pilih kondisi</option>
                    <option value="Sehat" <?= $d['kondisi'] == 'Sehat' ? 'selected' : '' ?>>Sehat</option>
                    <option value="Mengalami Perawatan" <?= $d['kondisi'] == 'Mengalami Perawatan' ? 'selected' : '' ?>>Mengalami Perawatan</option>
                </select>
            </div>
            <button type="submit" name="update" class="btn-submit">
                Update Data
            </button>
            <a href="dashboard.php" class="btn-cancel">
                Kembali ke Dashboard
            </a>
        </form>
    </div>
</div>

</body>
</html>
