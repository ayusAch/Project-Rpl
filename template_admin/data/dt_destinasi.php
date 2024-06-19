<?php
session_start();
include "../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if (!isset($_SESSION['username'])) {
    die("Anda belum login");
}

// Menggunakan prepared statement untuk query
$query = "SELECT * FROM destinasi INNER JOIN wisata ON destinasi.id_wisata = wisata.id_wisata
INNER JOIN lokasi ON destinasi.id_lokasi=lokasi.id_lokasi";
$dt_query = $koneksi->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Destinasi</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-4">
            <div>
                <a href='dashboard_admin.php' class="btn btn-primary">Kembali</a>
                <a href='form_destinasi.php' class="btn btn-success">Tambah Destinasi</a>
            </div>
            <a href='dt_jadwal.php' class="btn btn-danger">Lihat Jadwal</a>
        </div>
        <form action="multi_delete.php" method="POST" id="deleteForm">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll"></th>
                        <th>No.</th>
                        <th>Jenis Wisata</th>
                        <th>Nama Destinasi</th>
                        <th>Lokasi</th>
                        <th>Kelola</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($dt_wisata = $dt_query->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><input type="checkbox" name="selected_ids[]"
                                    value="<?php echo ($dt_wisata['id_destinasi']); ?>"></td>
                            <td>
                                <?php echo ($no++); ?>
                            </td>
                            <td>
                                <?php echo ($dt_wisata['nama_wisata']); ?>
                            </td>
                            <td>
                                <?php echo ($dt_wisata['nama_destinasi']); ?>
                            </td>
                            <td>
                                <?php echo ($dt_wisata['nama_lokasi']); ?>
                            </td>
                            <td>
                                <a href='edit.php?id=<?php echo ($dt_wisata['id_destinasi']); ?>'
                                    class="btn btn-warning btn-sm">Edit</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-danger"
                onclick="return confirm('Apakah Anda yakin ingin menghapus destinasi yang dipilih?')">Hapus
                Terpilih</button>
        </form>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('selectAll').addEventListener('click', function () {
            var checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
            for (var checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        });
    </script>
</body>

</html>