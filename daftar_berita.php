<?php 
session_start(); 
include 'koneksi.php';

// Handle CRUD berita
if (isset($_SESSION['admin_id']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_berita'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi = mysqli_real_escape_string($conn, $_POST['isi']);
    $tanggal = date('Y-m-d');
    $sql = "INSERT INTO berita (judul, isi, tanggal) VALUES ('$judul', '$isi', '$tanggal')";
    mysqli_query($conn, $sql);
}

if (isset($_SESSION['admin_id']) && isset($_GET['delete_berita'])) {
    $id = intval($_GET['delete_berita']);
    $sql = "DELETE FROM berita WHERE id = $id";
    mysqli_query($conn, $sql);
}

if (isset($_SESSION['admin_id']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_berita'])) {
    $id = intval($_POST['id']);
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi = mysqli_real_escape_string($conn, $_POST['isi']);
    $sql = "UPDATE berita SET judul='$judul', isi='$isi' WHERE id=$id";
    mysqli_query($conn, $sql);
}
?>

<?php include 'komponen/header.php'; ?>
<?php include 'komponen/navbar.php'; ?>

<section id="daftar-berita">
    <div class="container">
        <h2>Daftar Berita</h2>
        <?php if (isset($_SESSION['admin_id'])) { ?>
            <h3>Tambah Berita Baru</h3>
            <form action="berita.php" method="post">
                <label for="judul">Judul:</label>
                <input type="text" id="judul" name="judul" required>
                <label for="isi">Isi:</label>
                <textarea id="isi" name="isi" required></textarea>
                <button type="submit" name="add_berita" class="btn">Tambah</button>
            </form>
        <?php } ?>
        <table class="table">
            <thead>
                <tr>
                    <?php if (isset($_SESSION['admin_id'])) { ?>
                        <th>Action</th>
                    <?php } ?>
                    <th>Judul</th>
                    <th>Isi</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM berita ORDER BY tanggal DESC";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    if (isset($_SESSION['admin_id'])) {
                        echo "<td>";
                        echo "<form action='berita.php' method='post' style='display:inline;'>";
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                        echo "<input type='text' name='judul' value='" . $row['judul'] . "' required style='margin-bottom:5px;'>";
                        echo "<textarea name='isi' required style='margin-bottom:5px;'>" . $row['isi'] . "</textarea>";
                        echo "<button type='submit' name='edit_berita' class='btn'>Edit</button>";
                        echo "</form>";
                        echo "<a href='berita.php?delete_berita=" . $row['id'] . "' class='btn' onclick='return confirm(\"Yakin hapus?\")'>Delete</a>";
                        echo "</td>";
                    }
                    echo "<td>" . $row['judul'] . "</td>";
                    echo "<td>" . $row['isi'] . "</td>";
                    echo "<td>" . $row['tanggal'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

<?php include 'komponen/footer.php'; ?>