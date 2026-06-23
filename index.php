<?php
// QR Code Generator mengunakan layanan API QR Server.
// Halaman ini membuat QR Code standar dengan teks dari pengguna.

$qrCodeUrl  = null;
$teksInput = htmlspecialchars($_POST['teks_qr'] ?? '');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($teksInput)) {
    $urlTeks = urlencode($teksInput);
    $qrCodeUrl  = "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=" . $urlTeks;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>QR Code Generator</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; margin: 40px; background: #f5f7fa; color: #1f2937; }
        .card { background: #ffffff; max-width: 420px; margin: 0 auto; padding: 32px; border-radius: 14px; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08); }
        h2 { margin-bottom: 18px; }
        label { display: block; margin-bottom: 8px; font-weight: 700; }
        input[type="text"] { width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 10px; margin-bottom: 18px; font-size: 15px; }
        button { width: 100%; padding: 12px; border: none; border-radius: 10px; background: #2563eb; color: white; font-size: 15px; cursor: pointer; }
        button:hover { background: #1d4ed8; }
        .result-box { margin-top: 24px; padding-top: 22px; border-top: 1px solid #e5e7eb; }
        .result-box img { width: 100%; max-width: 300px; border-radius: 10px; border: 1px solid #e5e7eb; background: #fff; }
        .link { display: inline-block; margin-top: 14px; color: #2563eb; text-decoration: none; }
        .link:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="card">
    <h2>QR Code Generator</h2>
    <form method="POST">
        <label for="teks_qr">Masukkan teks</label>
        <input type="text" id="teks_qr" name="teks_qr" value="<?php echo $teksInput; ?>" placeholder="Contoh: Niko Laus Kuai" required>
        <button type="submit">Buat QR Code</button>
    </form>

    <?php if ($qrCodeUrl): ?>
        <div class="result-box">
            <h3>Hasil QR Code</h3>
            <img src="<?php echo $qrCodeUrl; ?>" alt="QR Code Hasil">
            <p>Data teks: <strong><?php echo $teksInput; ?></strong></p>
        </div>
    <?php endif; ?>

    <a class="link" href="warna.php">Buka halaman wana QR Code (Hitam / Merah)</a>
</div>

</body>
</html>