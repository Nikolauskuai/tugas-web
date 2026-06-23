<?php
// Halama pembuatan QR Code dengan pilihan warna hitam dan mera.
$qrCodeUrl = null;
$teksInput = "";
$warnaPilihan  = "hitam";
$warnaLabel  = "Hitam";
$warnaParam = "0-0-0";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $teksInput = htmlspecialchars($_POST['teks_qr'] ?? '');
    $warnaPilihan = $_POST['warna_qr'] ?? 'hitam';

    if ($warnaPilihan === 'merah') {
        $warnaLabel = 'Merah';
        $warnaParam = '255-0-0';
    }

    if (!empty($teksInput)) {
        $urlTeks = urlencode($teksInput);
        $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=300x300&color={$warnaParam}&data=" . $urlTeks;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>QR Code Warna</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; margin: 40px; background-color: #f1f3f6; color: #222; }
        .container { max-width: 420px; margin: 0 auto; background: #fff; padding: 32px; border-radius: 12px; box-shadow: 0 6px 18px rgba(0,0,0,0.08); }
        h2 { margin-bottom: 18px; }
        label { display: block; margin-bottom: 8px; font-weight: 600; }
        input[type="text"], select { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 8px; margin-bottom: 16px; font-size: 15px; }
        button { width: 100%; padding: 12px; border: none; border-radius: 8px; background: #d63333; color: white; font-size: 16px; cursor: pointer; }
        button:hover { background: #b02a2a; }
        .result { margin-top: 26px; padding-top: 18px; border-top: 1px solid #e4e7eb; }
        .result img { width: 100%; max-width: 300px; border: 1px solid #dcdcdc; border-radius: 8px; background: #fff; }
        .nav-link { display: inline-block; margin-top: 14px; color: #333; text-decoration: none; font-size: 14px; }
    </style>
</head>
<body>

<div class="container">
    <h2>QR Code dengan Warna</h2>
    <form method="POST">
        <label for="teks_qr">Masukkan teks untuk QR Code</label>
        <input type="text" id="teks_qr" name="teks_qr" value="<?php echo $teksInput; ?>" placeholder="Contoh: Niko Laus Kuai" required>

        <label for="warna_qr">Pilih warna QR Code</label>
        <select id="warna_qr" name="warna_qr">
            <option value="hitam"<?php echo $warnaPilihan === 'hitam' ? ' selected' : ''; ?>>Hitam</option>
            <option value="merah"<?php echo $warnaPilihan === 'merah' ? ' selected' : ''; ?>>Merah</option>
        </select>

        <button type="submit">Buat QR Code</button>
    </form>

    <?php if ($qrCodeUrl): ?>
        <div class="result">
            <h3>Hasil QR Code (Warna <?php echo $warnaLabel; ?>)</h3>
            <img src="<?php echo $qrCodeUrl; ?>" alt="QR Code Warna <?php echo $warnaLabel; ?>">
            <p>Data teks: <strong><?php echo $teksInput; ?></strong></p>
        </div>
    <?php endif; ?>

    <a class="nav-link" href="index.php">Kembali ke halaman QR Code standar</a>
</div>

</body>
</html>
