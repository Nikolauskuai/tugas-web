<?php
include __DIR__ . "/koneksi.php";

// Get fish count for stats
$stmt = mysqli_prepare($koneksi, "SELECT COUNT(*) as total FROM ikan");
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$total_ikan = mysqli_fetch_assoc($result)['total'] ?? 0;

$stmt = mysqli_prepare($koneksi, "SELECT jenis, COUNT(*) as jumlah FROM ikan GROUP BY jenis");
mysqli_stmt_execute($stmt);
$jenis_result = mysqli_stmt_get_result($stmt);
$total_jenis = mysqli_num_rows($jenis_result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AquaKu - Koleksi Ikan Akuarium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<!-- Floating Particles -->
<div class="particles">
    <div class="particle" style="left: 10%; animation-delay: 0s;"></div>
    <div class="particle" style="left: 20%; animation-delay: 2s;"></div>
    <div class="particle" style="left: 30%; animation-delay: 4s;"></div>
    <div class="particle" style="left: 40%; animation-delay: 6s;"></div>
    <div class="particle" style="left: 50%; animation-delay: 8s;"></div>
    <div class="particle" style="left: 60%; animation-delay: 10s;"></div>
    <div class="particle" style="left: 70%; animation-delay: 12s;"></div>
    <div class="particle" style="left: 80%; animation-delay: 14s;"></div>
    <div class="particle" style="left: 90%; animation-delay: 3s;"></div>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">AquaKu</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" style="border:none;">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#koleksi">Koleksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Admin Panel</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero -->
<section class="hero">
    <img src="../images/aquarium.jpg" alt="Aquarium">
    <div class="hero-text">
        <h1>AquaKu</h1>
        <p>Koleksi Ikan Akuarium Premium Pilihan Terbaik</p>
    </div>
    <div class="scroll-indicator" onclick="document.getElementById('koleksi').scrollIntoView({behavior:'smooth'})"></div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="stat-card fade-in">
                    <div class="stat-number"><?php echo $total_ikan; ?></div>
                    <div class="stat-label">Total Ikan</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card fade-in">
                    <div class="stat-number"><?php echo $total_jenis; ?></div>
                    <div class="stat-label">Jenis Ikan</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card fade-in">
                    <div class="stat-number">100%</div>
                    <div class="stat-label">Kualitas Premium</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Koleksi -->
<section class="container" id="koleksi">
    <div class="section-header">
        <h2>Koleksi Ikan Kami</h2>
        <p>Ikan koi hias dengan ciri khas kepala merah yang menonjol. Memiliki bentuk tubuh yang indah dan gerakan yang anggun. Cocok untuk koleksi ikan hias premium</p>
    </div>

    <div class="row g-4">
        <?php
        $stmt = mysqli_prepare($koneksi, "SELECT id, foto, nama_ikan, jenis, warna, kondisi FROM ikan");
        if (!$stmt) {
            die("Query error: " . mysqli_error($koneksi));
        }
        mysqli_stmt_execute($stmt);
        $data = mysqli_stmt_get_result($stmt);
        if (!$data) {
            die("Result error: " . mysqli_error($koneksi));
        }

        while($d = mysqli_fetch_array($data))
        {
            $kondisi_class = '';
            switch(strtolower($d['kondisi'])) {
                case 'sehat':
                    $kondisi_class = 'background: linear-gradient(135deg, #d4edda, #c3e6cb); color: #155724;';
                    break;
                case 'mengalami perawatan':
                    $kondisi_class = 'background: linear-gradient(135deg, #fff3cd, #ffeaa7); color: #856404;';
                    break;
                default:
                    $kondisi_class = 'background: linear-gradient(135deg, #d1ecf1, #bee5eb); color: #0c5460;';
            }
        ?>

        <div class="col-md-4 col-sm-6 fade-in">
            <div class="product-card h-100">
                <div class="img-wrapper">
                    <img src="../images/<?php echo htmlspecialchars($d['foto'], ENT_QUOTES, 'UTF-8'); ?>" 
                         class="card-img-top" 
                         alt="<?php echo htmlspecialchars($d['nama_ikan'], ENT_QUOTES, 'UTF-8'); ?>"
                         loading="lazy"
                         onerror="this.src='../images/aquarium.jpg'">
                    <div class="img-overlay">
                        <span class="badge-status" style="background: rgba(255,255,255,0.95); color: var(--primary-dark);">
                            <?php echo htmlspecialchars($d['kondisi'], ENT_QUOTES, 'UTF-8'); ?>
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="product-title">
                        <?php echo htmlspecialchars($d['nama_ikan'], ENT_QUOTES, 'UTF-8'); ?>
                    </h5>
                    
                    <div class="fish-info">
                        <div class="fish-info-item">
                            <div class="info-icon"></div>
                            <div>
                                <span class="info-label">Jenis</span>
                                <span class="info-value"><?php echo htmlspecialchars($d['jenis'], ENT_QUOTES, 'UTF-8'); ?></span>
                            </div>
                        </div>
                        <div class="fish-info-item">
                            <div class="info-icon"></div>
                            <div>
                                <span class="info-label">Warna</span>
                                <span class="info-value"><?php echo htmlspecialchars($d['warna'], ENT_QUOTES, 'UTF-8'); ?></span>
                            </div>
                        </div>
                    </div>

                    <span class="badge-status" style="<?php echo $kondisi_class; ?>">
                        <?php echo htmlspecialchars($d['kondisi'], ENT_QUOTES, 'UTF-8'); ?>
                    </span>
                </div>
            </div>
        </div>

        <?php 
        }
        
        if($total_ikan == 0) {
        ?>
        <div class="col-12">
            <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v11.25a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11.75 0 .375.375 0 01-.75 0z"/>
                </svg>
                <h3>Belum ada koleksi ikan</h3>
                <p>Koleksi ikan akan ditampilkan di sini setelah admin menambahkan data</p>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</section>

<!-- Footer -->
<footer>
    <div class="container text-center">
        <p style="margin: 0; opacity: 0.9;">© 2026 AquaKu. All rights reserved.</p>
        <p style="margin: 8px 0 0; opacity: 0.6; font-size: 0.85rem;">Premium Aquarium Fish Collection</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Navbar scroll effect
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

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

// Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});
</script>

</body>
</html>
