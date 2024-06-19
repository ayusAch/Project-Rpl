<?php
session_start();
include "../../koneksi.php";
if (!isset($_SESSION['username'])) {
    die("Anda belum login");
}

$kode_pembayaran = isset($_SESSION['kode_pembayaran']) ? $_SESSION['kode_pembayaran'] : '';

if (!$kode_pembayaran) {
    die("Kode pembayaran tidak ditemukan.");
}

$query_transaksi = "SELECT pesanan.*, tiket.*, destinasi.nama_destinasi, registrasi.nama_lengkap, registrasi.email 
                    FROM pesanan
                    INNER JOIN tiket ON pesanan.id_tiket = tiket.id_tiket
                    INNER JOIN destinasi ON tiket.id_destinasi = destinasi.id_destinasi
                    INNER JOIN registrasi ON tiket.id_registrasi = registrasi.id_registrasi
                    WHERE pesanan.kode_pembayaran = ?";

$stmt = $koneksi->prepare($query_transaksi);
$stmt->bind_param("s", $kode_pembayaran);
$stmt->execute();
$dt_transaksi = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Transaksi</title>
    <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="shortcut icon" href="../../images/favicon.png">
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
                            <h4>Detail Transaksi</h4>
                            <h6 class="font-weight-light">Pastikan Data Anda Sudah Benar</h6>
                            <form class="pt-3" enctype="multipart/form-data" action="../aksi/aksi_transaksi.php"
                                method="POST">
                                <?php if ($row_transaksi = $dt_transaksi->fetch_assoc()) { ?>
                                    <div class="form-group">
                                        <label>Kode Pembayaran</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend bg-transparent">
                                                <span class="input-group-text bg-transparent border-right-0">
                                                    <i class="mdi mdi-key text-primary"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control"
                                                value="<?php echo ($kode_pembayaran); ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Pembayaran</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend bg-transparent">
                                                <span class="input-group-text bg-transparent border-right-0">
                                                    <i class="mdi mdi-calendar text-primary"></i>
                                                </span>
                                            </div>
                                            <input type="date" id="tanggal" name="tanggal" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Metode Pembayaran</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend bg-transparent">
                                                <span class="input-group-text bg-transparent border-right-0">
                                                    <i class="mdi mdi-cash text-primary"></i>
                                                </span>
                                            </div>
                                            <select name="metode" id="metode" class="form-control form-control-lg">
                                                <option value="Mobile Banking">Mobile Banking</option>
                                                <option value="Transfer Bank">Transfer Bank</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Upload Bukti</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend bg-transparent">
                                            </div>
                                            <input type="file" name="gambar" id="gambar" class="form-control" required>
                                        </div>
                                        <input type="hidden" name="id_pesanan"
                                            value="<?php echo $row_transaksi['id_pesanan']; ?>">
                                        <div class="mt-3">
                                            <input type="submit" name="input" value="Bayar Sekarang"
                                                class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                        </div>

                                    <?php } else { ?>
                                        <p>Data transaksi tidak ditemukan.</p>
                                    <?php } ?>
                                </div>
                        </div>
                    </div>
                    <div class="col-lg-6 register-half-bg d-none d-lg-flex flex-row"></div>
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
        // Fungsi untuk mendapatkan tanggal hari ini dalam format YYYY-MM-DD
        function getTodayDate() {
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const day = String(today.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        // Mengisi nilai input tanggal pesan dengan tanggal hari ini
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('tanggal').value = getTodayDate();
        });
    </script>
</body>

</html>