<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
require_once '../config/functions.php';

$news = getLatestNews(100);  // All news

// Handle add (POST; incomplete)
if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_SESSION['username'];
    addNews($title, $content, $author);  // TODO: Validate input, redirect
}

// Handle update (POST; incomplete)
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    updateNews($id, $title, $content);  // TODO: Redirect
}

// Handle delete (GET; incomplete)
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    deleteNews($id);  // TODO: Confirm, redirect
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Manage News</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Manage News</h2>
        <div class="news-grid">
            <?php foreach($news as $item): ?>
            <div class="news-card">
                <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                <!-- TODO: Edit form or link -->
                <a href="?delete=<?php echo $item['id']; ?>">Delete</a>
            </div>
            <?php endforeach; ?>
        </div>
        <!-- Add form (incomplete) -->
        <form method="post">
            <input type="text" name="title" placeholder="Title">
            <textarea name="content" placeholder="Content"></textarea>
            <button type="submit" name="add">Add News</button>
        </form>
        <!-- TODO: Update form with pre-filled data based on ID -->
    </div>
</body>
</html>