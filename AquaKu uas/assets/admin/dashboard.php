<?php
session_start();
include __DIR__ . "/koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - AquaKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<!-- Admin Header -->
<div class="admin-header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h2>Dashboard Admin</h2>
            <div class="d-flex gap-2 flex-wrap">
                <a href="../idex.php" class="btn btn-light btn-sm" style="border-radius: 10px; font-weight: 600;">
                    Preview
                </a>
                <a href="tambah.php" class="btn btn-light btn-sm" style="border-radius: 10px; font-weight: 600;">
                    Tambah Ikan
                </a>
                <a href="logout.php" class="btn btn-sm" style="background: rgba(255,255,255,0.2); color: white; border-radius: 10px; font-weight: 600; border: 1px solid rgba(255,255,255,0.2);">
                    Logout
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row g-4">
        <?php
        $no = 1;
        $stmt = mysqli_prepare($koneksi, "SELECT id, foto, nama_ikan, jenis, warna, kondisi FROM ikan");
        if (!$stmt) {
            die("Query error: " . mysqli_error($koneksi));
        }
        mysqli_stmt_execute($stmt);
        $data = mysqli_stmt_get_result($stmt);
        if (!$data) {
            die("Result error: " . mysqli_error($koneksi));
        }
        while($d = mysqli_fetch_array($data)){
            $kondisi_class = '';
            $kondisi_icon = '';
            switch(strtolower($d['kondisi'])) {
                case 'sehat':
                    $kondisi_class = 'background: linear-gradient(135deg, #d4edda, #c3e6cb); color: #155724;';
                    $kondisi_icon = '';
                    break;
                case 'mengalami perawatan':
                    $kondisi_class = 'background: linear-gradient(135deg, #fff3cd, #ffeaa7); color: #856404;';
                    $kondisi_icon = '';
                    break;
                default:
                    $kondisi_class = 'background: linear-gradient(135deg, #d1ecf1, #bee5eb); color: #0c5460;';
                    $kondisi_icon = '';
            }
        ?>
        <div class="col-md-4 col-sm-6 fade-in">
            <div class="product-card h-100">
                <div class="img-wrapper">
                    <img src="../images/<?= htmlspecialchars($d['foto'], ENT_QUOTES, 'UTF-8'); ?>" 
                         class="card-img-top" 
                         alt="<?= htmlspecialchars($d['nama_ikan'], ENT_QUOTES, 'UTF-8'); ?>"
                         loading="lazy">
                    <div class="img-overlay">
                        <span class="badge-status" style="background: rgba(255,255,255,0.95); color: var(--primary-dark);">
                            <?= htmlspecialchars($d['kondisi'], ENT_QUOTES, 'UTF-8'); ?>
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="product-title">
                        <?= htmlspecialchars($d['nama_ikan'], ENT_QUOTES, 'UTF-8'); ?>
                    </h5>
                    
                    <div class="fish-info">
                        <div class="fish-info-item">
                            <div class="info-icon"></div>
                            <div>
                                <span class="info-label">Jenis</span>
                                <span class="info-value"><?= htmlspecialchars($d['jenis'], ENT_QUOTES, 'UTF-8'); ?></span>
                            </div>
                        </div>
                        <div class="fish-info-item">
                            <div class="info-icon"></div>
                            <div>
                                <span class="info-label">Warna</span>
                                <span class="info-value"><?= htmlspecialchars($d['warna'], ENT_QUOTES, 'UTF-8'); ?></span>
                            </div>
                        </div>
                    </div>

                    <span class="badge-status" style="<?= $kondisi_class; ?>">
                        <?= htmlspecialchars($d['kondisi'], ENT_QUOTES, 'UTF-8'); ?>
                    </span>

                    <div class="card-actions">
                        <a href="edit.php?id=<?= (int)$d['id']; ?>" class="btn btn-edit">
                            Edit
                        </a>
                        <a href="hapus.php?id=<?= (int)$d['id']; ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus data ini?')">
                            Hapus
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<script>
// Scroll animation
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, observerOptions);

document.querySelectorAll('.fade-in').forEach(el => {
    observer.observe(el);
});
</script>

</body>
</html>
