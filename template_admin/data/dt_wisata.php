<?php
session_start();
include "../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if (!isset($_SESSION['username'])) {
    die("Admin belum login");
}

$query = "SELECT * FROM wisata INNER JOIN destinasi ON wisata.id_wisata = destinasi.id_wisata
INNER JOIN jadwal ON jadwal.id_jadwal = destinasi.id_jadwal
INNER JOIN lokasi ON lokasi.id_lokasi = destinasi.id_lokasi";
$dt_query = $koneksi->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- site metas -->
    <title>Daftar Wisata</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-4">
            <div>
                <a href='dashboard_admin.php' class="btn btn-primary">Kembali</a>
                <a href='form_wisata.php' class="btn btn-success">Tambah Wisata</a>
            </div>
            <a href='dt_destinasi.php' class="btn btn-success">Lihat Destinasi</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Jenis Wisata</th>
                    <th>Nama Destinasi</th>
                    <th>Deskripsi Wisata</th>
                    <th>Lokasi</th>
                    <th>Tiket Masuk</th>
                    <th>Jam Kerja</th>
                    <th>Buka</th>
                    <th>Tutup</th>
                    <th>Kelola</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($dt_wisata = $dt_query->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo ($no++); ?></td>
                        <td><?php echo ($dt_wisata['nama_wisata']); ?></td>
                        <td><?php echo ($dt_wisata['nama_destinasi']); ?></td>
                        <td><?php echo ($dt_wisata['deskripsi_destinasi']); ?></td>
                        <td><?php echo ($dt_wisata['nama_lokasi']); ?></td>
                        <td><?php echo ($dt_wisata['harga_destinasi']); ?></td>
                        <td><?php echo ($dt_wisata['hari']); ?></td>
                        <td><?php echo ($dt_wisata['jam_buka']); ?></td>
                        <td><?php echo ($dt_wisata['jam_tutup']); ?></td>
                        <td>
                            <a href='edit.php?id=<?php echo ($dt_wisata['id_wisata']); ?>' 
                            class="btn btn-warning btn-sm">Update</a>
                            <a href='delete.php?id=<?php echo ($dt_wisata['id_wisata']); ?>'
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <div>
        <a href='../pages/aksi/logout.php' class="btn btn-danger">Logout</a>
        </div>
    </div>

    <!-- JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
