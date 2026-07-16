<?php
session_start();
include __DIR__ . "/koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

if(isset($_GET['id'])){
    $id = (int)($_GET['id'] ?? 0);
    $stmt = mysqli_prepare($koneksi, "DELETE FROM ikan WHERE id = ?");
    if (!$stmt) {
        die("Prepare failed: " . mysqli_error($koneksi));
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}


header("Location: dashboard.php");
exit;
?>
