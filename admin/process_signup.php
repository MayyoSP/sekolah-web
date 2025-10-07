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
        exit;
    } else {
        $_SESSION['error'] = "Signup gagal: " . mysqli_error($conn);
        header("Location: ../index.php");
        exit;
    }
} else {
    // Jika akses langsung, tampilkan form sederhana
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Signup Admin</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class="container">
            <h2>Signup Admin</h2>
            <?php if (isset($_SESSION['error'])) { echo "<p style='color:red;'>" . $_SESSION['error'] . "</p>"; unset($_SESSION['error']); } ?>
            <form action="" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit" class="btn">Signup</button>
            </form>
        </div>
    </body>
    </html>
    <?php
}
?>