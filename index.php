<?php include 'komponen/header.php'; ?>
<?php include 'komponen/navbar.php'; ?>
<?php include 'koneksi.php'; ?>

<?php
if (isset($_SESSION['error'])) {
    echo "<p style='color:red; text-align:center;'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo "<p style='color:green; text-align:center;'>" . $_SESSION['success'] . "</p>";
    unset($_SESSION['success']);
}

// Handle CRUD berita (POST to self for add)
if (isset($_SESSION['admin_id']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_berita'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi = mysqli_real_escape_string($conn, $_POST['isi']);
    $tanggal = date('Y-m-d');
    $sql = "INSERT INTO berita (judul, isi, tanggal) VALUES ('$judul', '$isi', '$tanggal')";
    mysqli_query($conn, $sql);
}

// Handle delete berita
if (isset($_SESSION['admin_id']) && isset($_GET['delete_berita'])) {
    $id = intval($_GET['delete_berita']);
    $sql = "DELETE FROM berita WHERE id = $id";
    mysqli_query($conn, $sql);
}

// Handle edit berita (simple, assume POST with id)
if (isset($_SESSION['admin_id']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_berita'])) {
    $id = intval($_POST['id']);
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi = mysqli_real_escape_string($conn, $_POST['isi']);
    $sql = "UPDATE berita SET judul='$judul', isi='$isi' WHERE id=$id";
    mysqli_query($conn, $sql);
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

<section id="berita">
    <div class="container">
        <h2>Berita Sekolah</h2>
        <div class="articles-grid">
            <?php
            $sql = "SELECT * FROM berita ORDER BY tanggal DESC";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='article-card'>";
                echo "<h4>" . $row['judul'] . "</h4>";
                echo "<p>" . $row['isi'] . "</p>";
                echo "<small>Tanggal: " . $row['tanggal'] . "</small>";
                if (isset($_SESSION['admin_id'])) {
                    echo "<form action='index.php#berita' method='post' style='margin-top:10px;'>";
                    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                    echo "<input type='text' name='judul' value='" . $row['judul'] . "' required>";
                    echo "<textarea name='isi' required>" . $row['isi'] . "</textarea>";
                    echo "<button type='submit' name='edit_berita' class='btn'>Edit</button>";
                    echo "</form>";
                    echo "<a href='index.php?delete_berita=" . $row['id'] . "#berita' class='btn' onclick='return confirm(\"Yakin hapus?\")'>Delete</a>";
                }
                echo "</div>";
            }
            ?>
        </div>
        <?php if (isset($_SESSION['admin_id'])) { ?>
            <h3>Tambah Berita Baru</h3>
            <form action="index.php#berita" method="post">
                <label for="judul">Judul:</label>
                <input type="text" id="judul" name="judul" required>
                <label for="isi">Isi:</label>
                <textarea id="isi" name="isi" required></textarea>
                <button type="submit" name="add_berita" class="btn">Tambah</button>
            </form>
        <?php } ?>
    </div>
</section>

<section id="guru">
    <div class="container">
        <h2>List Guru</h2>
        <p>Untuk detail guru, <?php echo isset($_SESSION['admin_id']) ? '<a href="list_guru.php">klik di sini</a>' : 'silakan login sebagai admin.'; ?></p>
        <?php
        $sql = "SELECT * FROM guru LIMIT 3"; // Preview for user
        $result = mysqli_query($conn, $sql);
        echo "<div class='pests-grid'>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='pest-card'>";
            echo "<img src='" . $row['foto'] . "' alt='" . $row['nama'] . "' class='pest-image'>";
            echo "<h3>" . $row['nama'] . "</h3>";
            echo "<p>Mata Pelajaran: " . $row['mata_pelajaran'] . "</p>";
            echo "</div>";
        }
        echo "</div>";
        ?>
    </div>
</section>

<section id="siswa">
    <div class="container">
        <h2>List Siswa</h2>
        <p>Untuk detail siswa, <?php echo isset($_SESSION['admin_id']) ? '<a href="list_siswa.php">klik di sini</a>' : 'silakan login sebagai admin.'; ?></p>
        <?php
        $sql = "SELECT * FROM siswa LIMIT 3"; // Preview
        $result = mysqli_query($conn, $sql);
        echo "<div class='pests-grid'>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='pest-card'>";
            echo "<img src='" . $row['foto'] . "' alt='" . $row['nama'] . "' class='pest-image'>";
            echo "<h3>" . $row['nama'] . "</h3>";
            echo "<p>Kelas: " . $row['kelas'] . "</p>";
            echo "</div>";
        }
        echo "</div>";
        ?>
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