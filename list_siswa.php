<?php 
session_start(); 
include 'koneksi.php';

// Handle CRUD
if (isset($_SESSION['admin_id']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_siswa'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);
    $foto = mysqli_real_escape_string($conn, $_POST['foto']);
    $sql = "INSERT INTO siswa (nama, kelas, foto) VALUES ('$nama', '$kelas', '$foto')";
    mysqli_query($conn, $sql);
}

if (isset($_SESSION['admin_id']) && isset($_GET['delete_siswa'])) {
    $id = intval($_GET['delete_siswa']);
    $sql = "DELETE FROM siswa WHERE id = $id";
    mysqli_query($conn, $sql);
}

if (isset($_SESSION['admin_id']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_siswa'])) {
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

<section id="daftar-siswa">
    <div class="container">
        <h2>Daftar Siswa</h2>
        <?php if (isset($_SESSION['admin_id'])) { ?>
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
        <?php } ?>
        <table class="table">
            <thead>
                <tr>
                    <?php if (isset($_SESSION['admin_id'])) { ?>
                        <th>Action</th>
                    <?php } ?>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM siswa";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    if (isset($_SESSION['admin_id'])) {
                        echo "<td>";
                        echo "<form action='list_siswa.php' method='post' style='display:inline;'>";
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                        echo "<input type='text' name='nama' value='" . $row['nama'] . "' required style='margin-bottom:5px;'>";
                        echo "<input type='text' name='kelas' value='" . $row['kelas'] . "' required style='margin-bottom:5px;'>";
                        echo "<input type='text' name='foto' value='" . $row['foto'] . "' required style='margin-bottom:5px;'>";
                        echo "<button type='submit' name='edit_siswa' class='btn'>Edit</button>";
                        echo "</form>";
                        echo "<a href='list_siswa.php?delete_siswa=" . $row['id'] . "' class='btn' onclick='return confirm(\"Yakin hapus?\")'>Delete</a>";
                        echo "</td>";
                    }
                    echo "<td>" . $row['nama'] . "</td>";
                    echo "<td>" . $row['kelas'] . "</td>";
                    echo "<td><img src='" . $row['foto'] . "' alt='" . $row['nama'] . "'></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

<?php include 'komponen/footer.php'; ?>