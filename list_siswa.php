<?php 
session_start(); 
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}
include 'koneksi.php';

// Handle CRUD similar to guru
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_siswa'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);
    $foto = mysqli_real_escape_string($conn, $_POST['foto']);
    $sql = "INSERT INTO siswa (nama, kelas, foto) VALUES ('$nama', '$kelas', '$foto')";
    mysqli_query($conn, $sql);
}

if (isset($_GET['delete_siswa'])) {
    $id = intval($_GET['delete_siswa']);
    $sql = "DELETE FROM siswa WHERE id = $id";
    mysqli_query($conn, $sql);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_siswa'])) {
    $id = intval($_POST['id']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);
    $foto = mysqli_real_escape_string($conn, $_POST['foto']);
    $sql = "UPDATE siswa SET nama='$nama', kelas='$kelas', foto='$foto' WHERE id=$id";
    mysqli_query($conn, $sql);
}
?>

<?php include 'komponen/header.php'; ?>
<?php include 'komponen/navbar.php'; ?>

<section id="list-siswa">
    <div class="container">
        <h2>List Siswa (Admin Only)</h2>
        <div class="pests-grid">
            <?php
            $sql = "SELECT * FROM siswa";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='pest-card'>";
                echo "<img src='" . $row['foto'] . "' alt='" . $row['nama'] . "' class='pest-image'>";
                echo "<h3>" . $row['nama'] . "</h3>";
                echo "<p>Kelas: " . $row['kelas'] . "</p>";
                echo "<form action='list_siswa.php' method='post' style='margin-top:10px;'>";
                echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                echo "<input type='text' name='nama' value='" . $row['nama'] . "' required>";
                echo "<input type='text' name='kelas' value='" . $row['kelas'] . "' required>";
                echo "<input type='text' name='foto' value='" . $row['foto'] . "' required>";
                echo "<button type='submit' name='edit_siswa' class='btn'>Edit</button>";
                echo "</form>";
                echo "<a href='list_siswa.php?delete_siswa=" . $row['id'] . "' class='btn' onclick='return confirm(\"Yakin hapus?\")'>Delete</a>";
                echo "</div>";
            }
            ?>
        </div>
        <h3>Tambah Siswa Baru</h3>
        <form action="list_siswa.php" method="post">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>
            <label for="kelas">Kelas:</label>
            <input type="text" id="kelas" name="kelas" required>
            <label for="foto">Foto URL:</label>
            <input type="text" id="foto" name="foto" required>
            <button type="submit" name="add_siswa" class="btn">Tambah</button>
        </form>
    </div>
</section>

<?php include 'komponen/footer.php'; ?>