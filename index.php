<?php include 'komponen/header.php'; ?>
<?php include 'komponen/navbar.php'; ?>

<?php
if (isset($_SESSION['error'])) {
    echo "<p style='color:red; text-align:center;'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo "<p style='color:green; text-align:center;'>" . $_SESSION['success'] . "</p>";
    unset($_SESSION['success']);
}
?>

<div id="loginModal" class="modal">
    <div class="modal-content">
        <span id="closeLogin" class="close">&times;</span>
        <h2>Login Admin</h2>
        <form action="admin/process_login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</div>

<div id="signupModal" class="modal">
    <div class="modal-content">
        <span id="closeSignup" class="close">&times;</span>
        <h2>Signup Admin</h2>
        <form action="admin/process_signup.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" class="btn">Signup</button>
        </form>
    </div>
</div>

<section class="hero" id="beranda">
    <div class="container hero-content">
        <h1>Selamat Datang di Sekolah XYZ</h1>
        <p>Sekolah terbaik dengan pendidikan berkualitas di Jakarta.</p>
        <div class="hero-buttons">
            <a href="#tentang" class="btn">Pelajari Lebih Lanjut</a>
        </div>
    </div>
</section>

<section class="about" id="tentang">
    <div class="container">
        <h2>Tentang Sekolah XYZ</h2>
        <div class="about-container">
            <div class="about-image">
                <img src="https://example.com/sekolah-image.jpg" alt="Sekolah XYZ">
            </div>
            <div class="about-content">
                <p>Sekolah XYZ adalah institusi pendidikan yang telah berdiri sejak 2000, fokus pada pengembangan siswa holistik.</p>
                <p>Dengan fasilitas modern dan guru berpengalaman, kami siap membentuk generasi masa depan.</p>
            </div>
        </div>
    </div>
</section>

<section class="keunggulan" id="fasilitas">
    <div class="container">
        <h2>Fasilitas Sekolah</h2>
        <p style="text-align: center; margin-bottom: 40px;">Fasilitas modern untuk mendukung pembelajaran.</p>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-book"></i>
                </div>
                <h3>Perpustakaan</h3>
                <p>Koleksi buku lengkap dan digital.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-flask"></i>
                </div>
                <h3>Laboratorium</h3>
                <p>Lab sains dan komputer canggih.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-futbol"></i>
                </div>
                <h3>Lapangan Olahraga</h3>
                <p>Fasilitas olahraga indoor dan outdoor.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <h3>Ruang Kelas</h3>
                <p>Ruang kelas nyaman dengan AC.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-wifi"></i>
                </div>
                <h3>WiFi Gratis</h3>
                <p>Akses internet cepat di seluruh area.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-medkit"></i>
                </div>
                <h3>UKS</h3>
                <p>Unit Kesehatan Sekolah lengkap.</p>
            </div>
        </div>
    </div>
</section>

<section class="testimoni" id="testimoni">
    <div class="container">
        <h2>Testimoni Alumni</h2>
        <p style="text-align: center; margin-bottom: 40px;">Apa kata alumni tentang Sekolah XYZ</p>
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <img src="https://example.com/alumni1.jpg" alt="Alumni 1" class="