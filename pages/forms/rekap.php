<?php
session_start();
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if (!isset($_SESSION['username'])) {
    die("Error: Pengguna tidak terautentikasi.");
}
$username = $_SESSION['username'];

$query = "SELECT pesanan.kode_pembayaran, registrasi.nama_lengkap, destinasi.nama_destinasi, 
                 tiket.total_harga, transaksi.tanggal_pembayaran, transaksi.metode_pembayaran, transaksi.bukti_pembayaran,transaksi.status_transaksi
          FROM transaksi 
          JOIN pesanan ON pesanan.id_pesanan=transaksi.id_pesanan
          JOIN tiket ON tiket.id_tiket=pesanan.id_tiket
          JOIN destinasi ON destinasi.id_destinasi=tiket.id_destinasi
          JOIN registrasi ON registrasi.id_registrasi=tiket.id_registrasi
          WHERE registrasi.username = ?";

$stmt = $koneksi->prepare($query);
if (!$stmt) {
    die("Persiapan query gagal: ");
}
$stmt->bind_param("s", $username);
$stmt->execute();
$dt_query = $stmt->get_result();

if (!$dt_query) {
    die("Eksekusi query gagal: " . $stmt->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pesananmu</title>
    <!-- base:css -->
    <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../../css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../../images/favicon.png" />
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-4">
            <h2>Transaksi</h2>
            <div> <a href="../../home.php" class="btn btn-primary">Kembali</a></div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode Pembayaran</th>
                    <th>Nama Lengkap</th>
                    <th>Pilihan Destinasi</th>
                    <th>Jumlah Pembayaran</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Metode Pembayaran</th>
                    <th>Bukti Pembayaran</th>
                    <th>Status Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($dt_transaksi = $dt_query->fetch_assoc()) {
                    ?>
                    <tr>
                        <td>
                            <?php echo ($no++); ?>
                        </td>
                        <td>
                            <?php echo ($dt_transaksi['kode_pembayaran']); ?>
                        </td>
                        <td>
                            <?php echo ($dt_transaksi['nama_lengkap']); ?>
                        </td>
                        <td>
                            <?php echo ($dt_transaksi['nama_destinasi']); ?>
                        </td>
                        <td>
                            <?php echo ($dt_transaksi['total_harga']); ?>
                        </td>
                        <td>
                            <?php echo ($dt_transaksi['tanggal_pembayaran']); ?>
                        </td>
                        <td>
                            <?php echo ($dt_transaksi['metode_pembayaran']); ?>
                        </td>
                        <td>
                            <img class="w-100 border rounded-0 h-auto"
                                src="../../bukti-bayar/<?php echo $dt_transaksi['bukti_pembayaran']; ?>" alt="gambar">
                        </td>
                         <td>
                            <?php echo ($dt_transaksi['status_transaksi']); ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>

        <?php if ($dt_query->num_rows == 0) { ?>
            <p>Kamu Belum Melakukan Transaksi Apapun.</p>
        <?php } ?>
    </div>
</body>

</html>