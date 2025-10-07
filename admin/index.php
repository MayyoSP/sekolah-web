<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
require_once '../config/functions.php';

// Dashboard content, e.g., links to manage
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
        <a href="manage_news.php">Manage News</a>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>