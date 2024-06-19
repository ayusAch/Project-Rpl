<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (!isset($_SESSION['username'])) {
    die("Anda belum login");
}
$query_destinasi = "SELECT * FROM destinasi";
$dt_destinasi = $koneksi->query($query_destinasi);

$username = $_SESSION['username'];
$query_registrasi = "SELECT * FROM registrasi WHERE username='$username'";
$dt_registrasi = $koneksi->query($query_registrasi);

if ($dt_registrasi->num_rows > 0) {
    $row = $dt_registrasi->fetch_assoc();
    $nama_lengkap = $row['nama_lengkap'];
    $email = $row['email'];
    $_SESSION['id_registrasi'] = $row['id_registrasi'];
} else {
    echo "Data pengguna tidak ditemukan.";
    exit();
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tiket</title>
    <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../css/style.css">
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
                            <h4>Pesan Tiket</h4>
                            <h6 class="font-weight-light">Lengkapi Pilihan Anda</h6>
                            <form id="tiketForm" class="pt-3" action="../aksi/aksi_tiket.php" method="POST">
                                <input type="hidden" name="registrasi"
                                    value="<?php echo $_SESSION['id_registrasi']; ?>">
                                <div class="form-group">
                                    <label>Pilih Wisata</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-email-outline text-primary"></i>
                                            </span>
                                        </div>
                                        <select id="destinasi" name="destinasi" class="form-control"
                                            onchange="updateHarga()">
                                            <?php while ($row_destinasi = $dt_destinasi->fetch_assoc()) { ?>
                                                <option value="<?php echo $row_destinasi['id_destinasi']; ?>"
                                                    data-harga="<?php echo $row_destinasi['harga_destinasi']; ?>">
                                                    <?php echo $row_destinasi['nama_destinasi']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Harga Tiket Destinasi</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-ticket text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="harga" name="harga" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Tiket</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-account-outline text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="jumlah" name="jumlah" value="1" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <input type="submit" value="Lanjutkan"
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

    <!-- base:js -->
    <script src="../../vendors/js/vendor.bundle.base.js"></script>
    <script src="../../js/off-canvas.js"></script>
    <script src="../../js/hoverable-collapse.js"></script>
    <script src="../../js/template.js"></script>
    <!-- Script untuk memperbarui harga dan total -->
    <script>
        function updateHarga() {
            var wisataSelect = document.getElementById('destinasi');
            var jumlahSelect = document.getElementById('jumlah');
            var selectedOption = wisataSelect.options[wisataSelect.selectedIndex];
            var hargaPerOrang = parseFloat(selectedOption.getAttribute('data-harga'));
            var jumlahTiket = parseInt(jumlahSelect.value);

            document.getElementById('harga').value = hargaPerOrang;

        }

        document.addEventListener("DOMContentLoaded", function () {
            updateHarga();
        });
    </script>
</body>

</html>