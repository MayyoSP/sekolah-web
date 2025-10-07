<?php session_start(); ?>
<header id="header">
    <div class="container header-container">
        <a href="index.php" class="logo">
            <img src="https://i.imgur.com/nye4g7w.png" alt="Sekolah XYZ">
            <span class="logo-text">Sekolah XYZ</span>
        </a>
        <nav>
            <button class="hamburger" id="hamburger">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="nav-menu" id="nav-menu">
                <li><a href="index.php">Halaman Utama</a></li>
                <li><a href="index.php#tentang">Tentang</a></li>
                <li><a href="berita.php">Daftar Berita</a></li>
                <li><a href="list_guru.php">Daftar Guru</a></li>
                <li><a href="list_siswa.php">Daftar Siswa</a></li>
                <li><a href="index.php#kontak">Kontak</a></li>
                <?php if (isset($_SESSION['admin_id'])) { ?>
                    <li><a href="admin/process_logout.php">Logout</a></li>
                <?php } else { ?>
                    <li><button id="loginBtn">Login</button></li>
                    <li><button id="signupBtn">Signup</button></li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</header>