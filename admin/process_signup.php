<?php
session_start();
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO admin (username, email, password) VALUES ('$username', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = "Signup berhasil, silakan login";
        header("Location: ../index.php");
    } else {
        $_SESSION['error'] = "Signup gagal: " . mysqli_error($conn);
        header("Location: ../index.php");
    }
}
?>