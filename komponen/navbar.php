<?php session_start(); ?>
<header id="header">
    <div class="container header-container">
        <a href="index.php" class="logo">
            <img src="https://i.imgur.com/nye4g7w.png" alt="Sekolah XYZ">
            <span class="logo-text">Sekolah XYZ</span>
        </a>
        <nav>
            <ul class="nav-menu" id="nav-menu">
                <li><a href="index.php#beranda">Beranda</a></li>
                <li><a href="index.php#tentang">Tentang</a></li>
                <li><a href="daftar_berita.php">Berita</a></li>
                <li><a href="list_guru.php">Guru</a></li>
                <li><a href="list_siswa.php">Siswa</a></li>
                <li><a href="index.php#kontak">Kontak</a></li>
            </ul>
            <?php if (isset($_SESSION['admin_id'])) { ?>
                <a href="admin/process_logout.php" class="btn">Logout</a>
            <?php } else { ?>
                <button id="loginBtn" class="btn">Login</button>
                <button id="signupBtn" class="btn">Signup</button>
            <?php } ?>
            <button class="hamburger" id="hamburger">
                <i class="fas fa-bars"></i>
            </button>
        </nav>
    </div>
</header>