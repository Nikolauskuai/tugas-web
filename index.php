<?php
include 'function.php';

$hasil = "";

if (isset($_POST['hitung'])) {
   
    $a = intval($_POST['angka1']);
    $b = intval($_POST['angka2']);
    $harga = intval($_POST['harga']);
    $diskon = intval($_POST['diskon']);

    
    $penjumlahan = tambah($a, $b);
    $pengurangan = kurang($a, $b);
    $hargaDiskon = hitungDiskon($harga, $diskon);

    $hasil = buildHasil($penjumlahan, $pengurangan, $hargaDiskon);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="page-wrapper">
        <div class="card">
            <header class="card-header">
                <h1>Aplikasi PHP Function</h1>
                <p>Hitung penjumlahan, pengurangan, dan harga setelah diskon dengan tampilan gelap.</p>
            </header>

            <form method="post" class="form-card">
                <div class="field-group">
                    <label for="angka1">Angka 1</label>
                    <input id="angka1" type="number" name="angka1" value="<?= htmlspecialchars($_POST['angka1'] ?? '', ENT_QUOTES) ?>" required>
                </div>

                <div class="field-group">
                    <label for="angka2">Angka 2</label>
                    <input id="angka2" type="number" name="angka2" value="<?= htmlspecialchars($_POST['angka2'] ?? '', ENT_QUOTES) ?>" required>
                </div>

                <div class="field-group">
                    <label for="harga">Harga</label>
                    <input id="harga" type="number" name="harga" value="<?= htmlspecialchars($_POST['harga'] ?? '', ENT_QUOTES) ?>" required>
                </div>

                <div class="field-group">
                    <label for="diskon">Diskon (%)</label>
                    <input id="diskon" type="number" name="diskon" value="<?= htmlspecialchars($_POST['diskon'] ?? '', ENT_QUOTES) ?>" required>
                </div>

                <button type="submit" name="hitung">Hitung Sekarang</button>
            </form>

            <?php if ($hasil !== ""): ?>
                <div class="hasil">
                    <h2>Hasil Perhitungan</h2>
                    <div class="result-box"><?= $hasil ?></div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>