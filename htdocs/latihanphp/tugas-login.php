<?php
// Memulai session untuk menyimpan status login
session_start();

// Akun dummy untuk login (bisa kamu ganti sesuai keinginan)
$username_benar = "admin";
$password_benar = "12345";

$error = "";

// Cek apakah tombol login sudah diklik
if (isset($_POST['login'])) {
    $username_input = $_POST['username'];
    $password_input = $_POST['password'];

    // Validasi username dan password
    if ($username_input === $username_benar && $password_input === $password_benar) {
        // Jika benar, simpan status login ke session
        $_SESSION['login'] = true;
        $_SESSION['user'] = $username_input;
        
        // Alihkan halaman ke katalog produk yang sudah kamu buat tadi
        header("Location: katalog.php");
        exit;
    } else {
        // Jika salah, munculkan pesan error
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tugas Praktikum - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-lg max-w-sm w-full">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">Selamat Datang</h2>
        <p class="text-sm text-gray-500 text-center mb-6">Silahkan login untuk mengakses katalog</p>
        
        <?php if (!empty($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4 text-sm text-center">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2" for="username">Username</label>
                <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       type="text" name="username" id="username" placeholder="Masukkan username" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-semibold mb-2" for="password">Password</label>
                <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       type="password" name="password" id="password" placeholder="Masukkan password" required>
            </div>

            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200" 
                    type="submit" name="login">
                Sign In
            </button>
        </form>
    </div>
</body>
</html>