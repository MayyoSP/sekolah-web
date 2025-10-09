<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM admin WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['admin_id'] = $user['id'];
        header("Location: ../index.php");
        exit;
    } else {
        $_SESSION['error'] = "Username atau password salah";
        header("Location: ../index.php");
        exit;
    }
} else {
    // Jika diakses langsung
    echo "<!DOCTYPE html><html><head><title>Sign In Error</title></head><body>";
    echo "<h2>Akses Tidak Diizinkan</h2>";
    echo "<p>Silakan sign in melalui form.</p>";
    echo "</body></html>";
}
?>