<?php
session_start();
include "../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if (!isset($_SESSION['username'])) {
    die("Admin belum login");
}

$query = "SELECT * FROM transaksi INNER JOIN pesanan ON pesanan.id_pesanan = transaksi.id_pesanan";
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
    <title>Riwayat Transaksi</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-4">
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode Pembayaran</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Metode Pembayaran</th>
                    <th>Bukti Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($dt_transaksi = $dt_query->fetch_assoc()) {
                    ?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($no++); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($dt_transaksi['kode_pembayaran']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($dt_transaksi['tanggal_pembayaran']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($dt_transaksi['metode_pembayaran']); ?>
                        </td>
                        <td>
                            <?php
                            $file_path = $dt_transaksi['file_path'];
                            if (!empty($file_path)) {
                                echo '<a href="../dokumen-upload' . $file_path . '" class="btn btn-primary btn-sm" download>' . htmlspecialchars($dt_transaksi['bukti_pembayaran']) . '</a>';
                            } else {
                                echo 'Belum diunggah';
                            }
                            ?>
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