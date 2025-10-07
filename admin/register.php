<?php
require_once '../config/database.php';
require_once '../config/security.php';

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = cleanInput($_POST['username']);
    $email = cleanInput($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Secure hash

    $conn = getConnection();
    $checkStmt = $conn->prepare("SELECT email FROM users WHERE email = :email");
    $checkStmt->bindParam(':email', $email);
    $checkStmt->execute();

    if ($checkStmt->rowCount() > 0) {
        $message = "Email already exists";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        if ($stmt->execute()) {
            $message = "Admin registered successfully";
        } else {
            $message = "Error registering";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Admin Register</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Admin Registration</h2>
        <?php if ($message) echo "<p>$message</p>"; ?>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>