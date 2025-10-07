<?php 
session_start(); 
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}
include 'koneksi.php';

// Handle CRUD
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_guru'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $mata_pelajaran = mysqli_real_escape_string($conn, $_POST['mata_pelajaran']);
    $foto = mysqli_real_escape_string($conn, $_POST['foto']); // Asumsi upload, tapi simple text
    $sql = "INSERT INTO guru (nama, mata_pelajaran, foto) VALUES ('$nama', '$mata_pelajaran', '$foto')";
    mysqli_query($conn, $sql);
}

if (isset($_GET['delete_guru'])) {
    $id = intval($_GET['delete_guru']);
    $sql = "DELETE FROM guru WHERE id = $id";
    mysqli_query($conn, $sql);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_guru'])) {
    $id = intval($_POST['id']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $mata_pelajaran = mysqli_real_escape_string($conn, $_POST['mata_pelajaran']);
    $foto = mysqli_real_escape_string($conn, $_POST['foto']);
    $sql = "UPDATE guru SET nama='$nama', mata_pelajaran='$mata_pelajaran', foto='$foto' WHERE id=$id";
    mysqli_query($conn, $sql);
}
?>

<?php include 'komponen/header.php'; ?>
<?php include 'komponen/navbar.php'; ?>

<section id="list-guru">
    <div class="container">
        <h2>List Guru (Admin Only)</h2>
        <div class="pests-grid">
            <?php
            $sql = "SELECT * FROM guru";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='pest-card'>";
                echo "<img src='" . $row['foto'] . "' alt='" . $row['nama'] . "' class='pest-image'>";
                echo "<h3>" . $row['nama'] . "</h3>";
                echo "<p>Mata Pelajaran: " . $row['mata_pelajaran'] . "</p>";
                echo "<form action='list_guru.php' method='post' style='margin-top:10px;'>";
                echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                echo "<input type='text' name='nama' value='" . $row['nama'] . "' required>";
                echo "<input type='text' name='mata_pelajaran' value='" . $row['mata_pelajaran'] . "' required>";
                echo "<input type='text' name='foto' value='" . $row['foto'] . "' required>";
                echo "<button type='submit' name='edit_guru' class='btn'>Edit</button>";
                echo "</form>";
                echo "<a href='list_guru.php?delete_guru=" . $row['id'] . "' class='btn' onclick='return confirm(\"Yakin hapus?\")'>Delete</a>";
                echo "</div>";
            }
            ?>
        </div>
        <h3>Tambah Guru Baru</h3>
        <form action="list_guru.php" method="post">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>
            <label for="mata_pelajaran">Mata Pelajaran:</label>
            <input type="text" id="mata_pelajaran" name="mata_pelajaran" required>
            <label for="foto">Foto URL:</label>
            <input type="text" id="foto" name="foto" required>
            <button type="submit" name="add_guru" class="btn">Tambah</button>
        </form>
    </div>
</section>

<?php include 'komponen/footer.php'; ?>