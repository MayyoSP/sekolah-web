<?php
// File: about.php
// Contoh penggunaan komponen

// Set judul halaman
$page_title = "Tentang Kami";

// Include header
include 'components/header.php';
?>

<main class="main-content">
    <section class="about-section">
        <div class="container">
            <h1>Tentang SMA Negeri 1 Contoh</h1>
            <p>Sekolah kami berdiri sejak tahun 1985...</p>
            
            <div class="stats">
                <div class="stat-item">
                    <h3>1200+</h3>
                    <p>Siswa Aktif</p>
                </div>
                <div class="stat-item">
                    <h3>80+</h3>
                    <p>Guru Berpengalaman</p>
                </div>
                <div class="stat-item">
                    <h3>95%</h3>
                    <p>Tingkat Kelulusan</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
// Include footer
include 'components/footer.php';
?>