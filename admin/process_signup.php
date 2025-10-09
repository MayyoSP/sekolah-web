<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO admin (username, email, password) VALUES ('$username', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = "Sign up berhasil, silakan sign in";
        header("Location: ../index.php");
        exit;
    } else {
        $_SESSION['error'] = "Sign up gagal: " . mysqli_error($conn);
        header("Location: ../index.php");
        exit;
    }
} else {
    // Jika diakses langsung
    echo "<!DOCTYPE html><html><head><title>Sign Up Error</title></head><body>";
    echo "<h2>Akses Tidak Diizinkan</h2>";
    echo "<p>Silakan sign up melalui form.</p>";
    echo "</body></html>";
}
?>