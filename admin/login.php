<?php
session_start();
require_once '../config/database.php';
require_once '../config/security.php';

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = cleanInput($_POST['email']);
    $password = $_POST['password'];

    $conn = getConnection();
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        logActivity('login', 'Successful login for ' . $user['username']);
        header('Location: index.php');
        exit;
    } else {
        $message = "Invalid credentials";
        logActivity('login_attempt', 'Failed login for ' . $email);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Admin Login</h2>
        <?php if ($message) echo "<p>$message</p>"; ?>
        <form method="post">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>