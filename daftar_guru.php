<?php session_start(); ?>
<?php include 'komponen/header.php'; ?>
<?php include 'komponen/navbar.php'; ?>
<?php include 'koneksi.php'; ?>

<section id="daftar-guru">
    <div class="container">
        <h2>Daftar Guru</h2>
        <?php if (isset($_SESSION['admin_id'])) { ?>
            <h3>Tambah Guru Baru</h3>
            <form action="daftar_guru.php" method="post">
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
                        echo "<form action='daftar_guru.php' method='post' style='display:inline;'>";
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                        echo "<button type='button' class='btn edit-btn'>Edit</button>";
                        echo "</form>";
                        echo "<a href='daftar_guru.php?delete_guru=" . $row['id'] . "' class='btn' onclick='return confirm(\"Yakin hapus?\")'>Hapus</a>";
                        echo "</td>";
                    }
                    echo "<td><input type='text' value='" . $row['nama'] . "' name='nama' readonly data-original='" . $row['nama'] . "'></td>";
                    echo "<td><input type='text' value='" . ($row['mata_pelajaran'] ?? '') . "' name='mata_pelajaran' readonly data-original='" . ($row['mata_pelajaran'] ?? '') . "'></td>";
                    echo "<td><input type='text' value='" . $row['foto'] . "' name='foto' readonly data-original='" . $row['foto'] . "'><br><img src='" . $row['foto'] . "' alt='" . $row['nama'] . "'></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

<?php include 'komponen/footer.php'; ?>