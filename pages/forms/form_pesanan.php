<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (!isset($_SESSION['username'])) {
    die("Anda belum login");
}

$id_registrasi = $_SESSION['id_registrasi'];

$query_tiket = "SELECT * FROM tiket
                INNER JOIN destinasi ON tiket.id_destinasi = destinasi.id_destinasi
                INNER JOIN registrasi ON tiket.id_registrasi = registrasi.id_registrasi
                WHERE tiket.id_registrasi = ?
                ORDER BY tiket.id_tiket DESC
                LIMIT 1";

$stmt = $koneksi->prepare($query_tiket);
$stmt->bind_param("i", $id_registrasi);
$stmt->execute();
$dt_tiket = $stmt->get_result();
$row_tiket = $dt_tiket->fetch_assoc();

?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Booking</title>
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
    <div class="container-scroller d-flex">
        <div class="container-fluid page-body-wrapper full-page-wrapper d-flex">
            <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
                <div class="row flex-grow">
                    <div class="col-lg-6 d-flex align-items-center justify-content-center">
                        <div class="auth-form-transparent text-left p-3">
                            <div class="brand-logo">
                                <img src="../../images/logo.svg" alt="logo">
                            </div>
                            <h4>Data Pesanan</h4>
                            <h6 class="font-weight-light">Konfirmasi Pesanan Anda</h6>
                            <form class="pt-3" action="../aksi/aksi_pesanan.php" method="POST">
                                <input type="hidden" name="tiket" value="<?php echo ($row_tiket['id_tiket']); ?>">
                                <?php if ($row_tiket) { ?>
                                    <div class="form-group">
                                        <label>Pilihan Destinasi</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend bg-transparent">
                                                <span class="input-group-text bg-transparent border-right-0">
                                                    <i class="mdi mdi-circle text-primary"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control"
                                                value="<?php echo ($row_tiket['nama_destinasi']); ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah Tiket Dipesan</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend bg-transparent">
                                                <span class="input-group-text bg-transparent border-right-0">
                                                    <i class="mdi mdi-ticket text-primary"></i>
                                                </span>
                                            </div>
                                            <input type="text" id="jumlah" name="jumlah" class="form-control"
                                                value="<?php echo ($row_tiket['jumlah_tiket']); ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Total Pembayaran</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend bg-transparent">
                                                <span class="input-group-text bg-transparent border-right-0">
                                                    <i class="mdi mdi-ticket text-primary"></i>
                                                </span>
                                            </div>
                                            <input type="text" id="harga" name="harga" class="form-control"
                                                value="<?php echo ($row_tiket['total_harga']); ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Pesanan</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend bg-transparent">
                                                <span class="input-group-text bg-transparent border-right-0">
                                                    <i class="mdi mdi-ticket text-primary"></i>
                                                </span>
                                            </div>
                                            <input type="text" id="tanggal" name="tanggal" class="form-control"
                                                value="<?php echo ($row_tiket['tanggal_pesanan']); ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Data Pengguna</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend bg-transparent">
                                                <span class="input-group-text bg-transparent border-right-0">
                                                    <i class="mdi mdi-account-outline text-primary"></i>
                                                </span>
                                            </div>
                                            <input type="text" id="nama" name="nama" class="form-control"
                                                value="<?php echo ($row_tiket['nama_lengkap']); ?>" readonly>
                                        </div>
                                        <div class="form-group"></div>
                                        <div class="input-group">
                                            <div class="input-group-prepend bg-transparent">
                                                <span class="input-group-text bg-transparent border-right-0">
                                                    <i class="mdi mdi-email text-primary"></i>
                                                </span>
                                            </div>
                                            <input type="text" id="identitas" name="identitas" class="form-control"
                                                value="<?php echo ($row_tiket['email']); ?>" readonly>
                                        </div>
                                        <div class="form-group"></div>
                                        <div class="input-group">
                                            <div class="input-group-prepend bg-transparent">
                                                <span class="input-group-text bg-transparent border-right-0">
                                                    <i class="mdi mdi-pin text-primary"></i>
                                                </span>
                                            </div>
                                            <input type="text" id="alamat" name="alamat" class="form-control"
                                                value="<?php echo ($row_tiket['alamat']); ?>" readonly>
                                        </div>
                                        <div class="form-group"></div>
                                        <div class="input-group">
                                            <div class="input-group-prepend bg-transparent">
                                                <span class="input-group-text bg-transparent border-right-0">
                                                    <i class="mdi mdi-phone text-primary"></i>
                                                </span>
                                            </div>
                                            <input type="text" id="hp" name="hp" class="form-control"
                                                value="<?php echo ($row_tiket['no_hp']); ?>" readonly>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <p>Tidak ada data pesanan ditemukan.</p>
                                <?php } ?>
                                <div class="mb-4">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input" required>
                                            Konfirmasi Pesanan
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <input type="submit" name="input" value="Pesan Sekarang"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 register-half-bg d-none d-lg-flex flex-row">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- container-scroller -->
    <!-- base:js -->
    <script src="../../vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="../../js/off-canvas.js"></script>
    <script src="../../js/hoverable-collapse.js"></script>
    <script src="../../js/template.js"></script>
    <script>
        function getTodayDate() {
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const day = String(today.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('tanggal').value = getTodayDate();
        });
    </script>
    <!-- endinject -->
</body>

</html>