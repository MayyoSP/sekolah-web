<?php
// File: news.php
require_once 'config/functions.php';

$page_title = "Berita";
$latest_news = getLatestNews();  // Ambil semua berita tanpa limit

include 'components/header.php';
?>

<main class="main-content">
    <section class="news-section">
        <div class="container">
            <h2>Daftar Berita</h2>
            <div class="news-grid">
                <?php if(!empty($latest_news)): ?>
                    <?php foreach($latest_news as $news): ?>
                    <div class="news-card">
                        <h3><?php echo htmlspecialchars($news['title']); ?></h3>
                        <p class="date"><?php echo formatTanggal($news['created_at']); ?></p>
                        <p><?php echo substr(strip_tags($news['content']), 0, 150) . '...'; ?></p>
                        <a href="news-detail.php?id=<?php echo $news['id']; ?>" class="read-more">Baca Selengkapnya</a>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Belum ada berita.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php include 'components/footer.php'; ?>