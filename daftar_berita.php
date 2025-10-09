<?php session_start(); ?>
<?php include 'komponen/header.php'; ?>
<?php include 'komponen/navbar.php'; ?>
<?php include 'koneksi.php'; ?>

<section id="daftar-berita">
    <div class="container">
        <h2>Daftar Berita</h2>
        <?php if (isset($_SESSION['admin_id'])) { ?>
            <h3>Tambah Berita Baru</h3>
            <form action="daftar_berita.php" method="post">
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
                        echo "<form action='daftar_berita.php' method='post' style='display:inline;'>";
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                        echo "<button type='button' class='btn edit-btn'>Edit</button>";
                        echo "</form>";
                        echo "<a href='daftar_berita.php?delete_berita=" . $row['id'] . "' class='btn' onclick='return confirm(\"Yakin hapus?\")'>Hapus</a>";
                        echo "</td>";
                    }
                    echo "<td><input type='text' value='" . $row['judul'] . "' name='judul' readonly data-original='" . $row['judul'] . "'></td>";
                    echo "<td><textarea name='isi' readonly data-original='" . $row['isi'] . "'>" . $row['isi'] . "</textarea></td>";
                    echo "<td>" . $row['tanggal'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

<?php include 'komponen/footer.php'; ?>