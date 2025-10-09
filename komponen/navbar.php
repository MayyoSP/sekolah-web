<header id="header">
    <div class="container header-container">
        <a href="index.php" class="logo">
            <img src="https://i.imgur.com/nye4g7w.png" alt="Sekolah Mayyo">
            <span class="logo-text">Sekolah Mayyo</span>
        </a>
        <nav>
            <ul class="desktop-nav" id="desktop-nav">
                <li><a href="index.php">Halaman Utama</a></li>
                <li><a href="daftar_siswa.php">Daftar Siswa</a></li>
                <li><a href="daftar_guru.php">Daftar Guru</a></li>
                <li><a href="daftar_berita.php">Daftar Berita</a></li>
                <?php if (isset($_SESSION['admin_id'])) { ?>
                    <li><a href="admin/process_logout.php">Logout</a></li>
                <?php } else { ?>
                    <li><button id="loginBtn" class="btn">Sign In</button></li>
                    <li><button id="signupBtn" class="btn">Sign Up</button></li>
                <?php } ?>
            </ul>
            <button class="hamburger" id="hamburger">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="mobile-nav" id="mobile-nav">
                <li><a href="index.php">Halaman Utama</a></li>
                <li><a href="daftar_siswa.php">Daftar Siswa</a></li>
                <li><a href="daftar_guru.php">Daftar Guru</a></li>
                <li><a href="daftar_berita.php">Daftar Berita</a></li>
                <?php if (isset($_SESSION['admin_id'])) { ?>
                    <li><a href="admin/process_logout.php">Logout</a></li>
                <?php } else { ?>
                    <li><button id="loginBtn">Sign In</button></li>
                    <li><button id="signupBtn">Sign Up</button></li>
                <?php } ?>
                <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') { ?>
                    <hr>
                    <li><a href="#tentang">Tentang</a></li>
                    <li><a href="#visi-misi">Visi Misi Sekolah</a></li>
                    <li><a href="#fasilitas">Fasilitas Sekolah</a></li>
                    <li><a href="#testimoni">Testimoni</a></li>
                    <li><a href="#faq">FAQ</a></li>
                    <li><a href="#kontak">Kontak</a></li>
                <?php } ?>
            </ul>
            <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') { ?>
                <ul class="sub-nav-desktop">
                    <li><a href="#tentang">Tentang</a></li>
                    <li><a href="#visi-misi">Visi Misi Sekolah</a></li>
                    <li><a href="#fasilitas">Fasilitas Sekolah</a></li>
                    <li><a href="#testimoni">Testimoni</a></li>
                    <li><a href="#faq">FAQ</a></li>
                    <li><a href="#kontak">Kontak</a></li>
                </ul>
            <?php } ?>
        </nav>
    </div>
</header>