<?php
session_start();
include __DIR__ . "/koneksi.php";

if(isset($_POST['login'])){
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = mysqli_prepare($koneksi, "SELECT id, username, password FROM admin WHERE username = ? LIMIT 1");
    if (!$stmt) {
        die("Prepare failed: " . mysqli_error($koneksi));
    }
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $userRow = mysqli_fetch_assoc($result);

    if ($userRow && password_verify($password, $userRow['password'])) {
        $_SESSION['login']=true;
        header("Location: dashboard.php");
        exit;
    } else {
        echo "<script>
                alert('Username atau Password Salah!');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - AquaKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="../style.css">
</head>
<body class="login-page">

<div class="login-card">
    <div class="card-header-custom">
        <h1>AquaKu</h1>
        <p>Admin Panel Login</p>
    </div>
    
    <form method="POST" autocomplete="off">
        <div class="mb-4">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
        </div>
        
        <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
        </div>
        
        <button type="submit" name="login" class="btn-login">
            Masuk ke Dashboard
        </button>
    </form>
    
    <a href="idex.php" class="btn-back">
        Kembali ke Website
    </a>
</div>

</body>
</html>
