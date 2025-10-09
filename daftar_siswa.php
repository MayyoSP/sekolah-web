<?php session_start(); ?>
<?php include 'komponen/header.php'; ?>
<?php include 'komponen/navbar.php'; ?>
<?php include 'koneksi.php'; ?>

<section id="daftar-siswa">
    <div class="container">
        <h2>Daftar Siswa</h2>
        <?php if (isset($_SESSION['admin_id'])) { ?>
            <h3>Tambah Siswa Baru</h3>
            <form action="daftar_siswa.php" method="post">
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
                        echo "<form action='daftar_siswa.php' method='post' style='display:inline;'>";
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                        echo "<button type='button' class='btn edit-btn'>Edit</button>";
                        echo "</form>";
                        echo "<a href='daftar_siswa.php?delete_siswa=" . $row['id'] . "' class='btn' onclick='return confirm(\"Yakin hapus?\")'>Hapus</a>";
                        echo "</td>";
                    }
                    echo "<td><input type='text' value='" . $row['nama'] . "' name='nama' readonly data-original='" . $row['nama'] . "'></td>";
                    echo "<td><input type='text' value='" . $row['kelas'] . "' name='kelas' readonly data-original='" . $row['kelas'] . "'></td>";
                    echo "<td><input type='text' value='" . $row['foto'] . "' name='foto' readonly data-original='" . $row['foto'] . "'><br><img src='" . $row['foto'] . "' alt='" . $row['nama'] . "'></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

<?php include 'komponen/footer.php'; ?>