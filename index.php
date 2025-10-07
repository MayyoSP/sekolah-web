<?php include 'komponen/header.php'; ?>
<?php include 'komponen/navbar.php'; ?>
<?php include 'koneksi.php'; ?>

<?php
if (isset($_SESSION['error'])) {
    echo '<div class="message error">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo '<div class="message success">' . $_SESSION['success'] . '</div>';
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
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-book"></i>
                </div>
                <h3>Perpustakaan Modern</h3>
                <p>Koleksi buku lengkap dan ruang baca nyaman.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-flask"></i>
                </div>
                <h3>Laboratorium Sains</h3>
                <p>Alat lengkap untuk praktik ilmu pengetahuan.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-laptop"></i>
                </div>
                <h3>Ruang Komputer</h3>
                <p>Akses internet cepat dan komputer terbaru.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-futbol"></i>
                </div>
                <h3>Lapangan Olahraga</h3>
                <p>Fasilitas untuk berbagai cabang olahraga.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-music"></i>
                </div>
                <h3>Ruang Seni</h3>
                <p>Tempat berkreasi musik dan seni rupa.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-apple-alt"></i>
                </div>
                <h3>Kantin Sehat</h3>
                <p>Makanan bergizi dengan harga terjangkau.</p>
            </div>
        </div>
    </div>
</section>

<section class="testimoni" id="testimoni">
    <div class="container">
        <h2>Testimoni Siswa</h2>
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <img src="https://example.com/siswa-testi1.jpg" alt="Testimoni 1" class="testimonial-image">
                <div class="testimonial-content">
                    <p class="testimonial-text">"Sekolah XYZ memberikan pengalaman belajar terbaik!"</p>
                    <p class="testimonial-author">- Andi, Kelas XII</p>
                </div>
            </div>
            <div class="testimonial-card">
                <img src="https://example.com/siswa-testi2.jpg" alt="Testimoni 2" class="testimonial-image">
                <div class="testimonial-content">
                    <p class="testimonial-text">"Guru-guru sangat suportif dan fasilitas lengkap."</p>
                    <p class="testimonial-author">- Rina, Kelas XI</p>
                </div>
            </div>
            <div class="testimonial-card">
                <img src="https://example.com/siswa-testi3.jpg" alt="Testimoni 3" class="testimonial-image">
                <div class="testimonial-content">
                    <p class="testimonial-text">"Saya senang belajar di sini, banyak kegiatan ekstrakurikuler."</p>
                    <p class="testimonial-author">- Budi, Kelas X</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="faq" id="faq">
    <div class="container">
        <h2>Pertanyaan Umum</h2>
        <div class="faq-container">
            <div class="faq-item">
                <div class="faq-question">
                    <span>Bagaimana cara mendaftar?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Datang langsung ke sekolah atau hubungi admin.</p>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <span>Apa saja program ekstrakurikuler?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Olahraga, seni, sains, dan banyak lagi.</p>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <span>Berapa biaya sekolah?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Hubungi kontak untuk detail.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contact" id="kontak">
    <div class="container">
        <h2>Hubungi Kami</h2>
        <p>Silakan hubungi kami untuk informasi lebih lanjut.</p>
        <div class="contact-buttons">
            <a href="mailto:info@sekolahxyz.sch.id" class="btn">Email Kami</a>
        </div>
    </div>
</section>

<?php include 'komponen/footer.php'; ?>