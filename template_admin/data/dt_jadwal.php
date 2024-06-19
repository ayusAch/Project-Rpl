<?php
session_start();
include "../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if (!isset($_SESSION['username'])) {
    die("Admin belum login");
}

// Menggunakan prepared statement untuk query
$query = "SELECT * FROM destinasi INNER JOIN jadwal ON jadwal.id_jadwal = destinasi.id_jadwal";
$dt_query = $koneksi->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Destinasi</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-4">
            <div>
                <a href='dashboard_admin.php' class="btn btn-primary">Kembali</a>
            </div>
            <a href='form_jadwal.php' class="btn btn-success">Input Jadwal</a>
        </div>
        <table class="table table-bordered">
        <thead>
                <tr>
                    <th>No.</th>
                    <th>Destinasi</th>
                    <th>Hari</th>
                    <th>Jam Buka</th>
                    <th>Jam Tutup</th>
                    <th>Kelola</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($dt_jadwal = $dt_query->fetch_assoc()) {
                    ?>
                    <tr>
                        <td>
                            <?php echo ($no++); ?>
                        </td>
                        <td>
                            <?php echo ($dt_jadwal['nama_destinasi']); ?>
                        </td>
                        <td>
                            <?php echo ($dt_jadwal['hari']); ?>
                        </td>
                        <td>
                            <?php echo ($dt_jadwal['jam_buka']); ?>
                        </td>
                        <td>
                            <?php echo ($dt_jadwal['jam_tutup']); ?>
                        </td>
                        <td>
                            <a href='edit.php?id=<?php echo ($dt_jenis['id_destinasi']); ?>'
                                class="btn btn-warning btn-sm">Edit</a>
                            <a href='delete.php?id=<?php echo ($dt_jenis['id_destinasi']); ?>'
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>