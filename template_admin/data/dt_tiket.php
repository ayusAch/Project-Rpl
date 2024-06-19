<?php
session_start();
include "../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if (!isset($_SESSION['username'])) {
    die("Admin belum login");
}

$query = "SELECT * FROM tiket INNER JOIN destinasi ON destinasi.id_destinasi = tiket.id_destinasi";
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
    <title>Tiket</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-4">
            <div>
                <a href='dashboard_admin.php' class="btn btn-primary">Kembali</a>
                <a href='form_pesanan.php' class="btn btn-success">Lihat Pesanan</a>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Pilihan Destinasi</th>
                    <th>Jumlah Tiket</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($dt_wisata = $dt_query->fetch_assoc()) {
                    ?>
                    <tr>
                        <td>
                            <?php echo($no++); ?>
                        </td>
                        <td>
                            <?php echo($dt_wisata['nama_destinasi']); ?>
                        </td>
                        <td>
                            <?php echo($dt_wisata['jumlah_tiket']); ?>
                        </td>
                        <td>
                            <?php echo($dt_wisata['total_harga']); ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>