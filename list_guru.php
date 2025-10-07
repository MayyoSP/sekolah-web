<?php 
session_start(); 
include 'koneksi.php';

// Handle CRUD
if (isset($_SESSION['admin_id']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_guru'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $mata_pelajaran = mysqli_real_escape_string($conn, $_POST['mata_pelajaran']);
    $foto = mysqli_real_escape_string($conn, $_POST['foto']);
    $sql = "INSERT INTO guru (nama, mata_pelajaran, foto) VALUES ('$nama', '$mata_pelajaran', '$foto')";
    mysqli_query($conn, $sql);
}

if (isset($_SESSION['admin_id']) && isset($_GET['delete_guru'])) {
    $id = intval($_GET['delete_guru']);
    $sql = "DELETE FROM guru WHERE id = $id";
    mysqli_query($conn, $sql);
}

if (isset($_SESSION['admin_id']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_guru'])) {
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

<section id="daftar-guru">
    <div class="container">
        <h2>Daftar Guru</h2>
        <?php if (isset($_SESSION['admin_id'])) { ?>
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
        <?php } ?>
        <table class="table">
            <thead>
                <tr>
                    <?php if (isset($_SESSION['admin_id'])) { ?>
                        <th>Action</th>
                    <?php } ?>
                    <th>Nama</th>
                    <th>Mata Pelajaran</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM guru";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    if (isset($_SESSION['admin_id'])) {
                        echo "<td>";
                        echo "<form action='list_guru.php' method='post' style='display:inline;'>";
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                        echo "<input type='text' name='nama' value='" . $row['nama'] . "' required style='margin-bottom:5px;'>";
                        echo "<input type='text' name='mata_pelajaran' value='" . $row['mata_pelajaran'] . "' required style='margin-bottom:5px;'>";
                        echo "<input type='text' name='foto' value='" . $row['foto'] . "' required style='margin-bottom:5px;'>";
                        echo "<button type='submit' name='edit_guru' class='btn'>Edit</button>";
                        echo "</form>";
                        echo "<a href='list_guru.php?delete_guru=" . $row['id'] . "' class='btn' onclick='return confirm(\"Yakin hapus?\")'>Delete</a>";
                        echo "</td>";
                    }
                    echo "<td>" . $row['nama'] . "</td>";
                    echo "<td>" . $row['mata_pelajaran'] . "</td>";
                    echo "<td><img src='" . $row['foto'] . "' alt='" . $row['nama'] . "'></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

<?php include 'komponen/footer.php'; ?>