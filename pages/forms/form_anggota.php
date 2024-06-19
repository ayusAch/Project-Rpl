<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (!isset($_SESSION['username'])) {
    die("Anda belum login");
}

$jumlahTiket = isset($_POST['jumlah']) ? $_POST['jumlah'] : 1; // Mendapatkan jumlah tiket dari POST data

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data Anggota</title>
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
                            <h4>Data Anggota</h4>
                            <h6 class="font-weight-light">Lengkapi Data Anggota</h6>
                            <form id="anggotaForm" class="pt-3" action="../aksi/aksi_anggota.php" method="POST">
                                <input type="hidden" name="registrasi"
                                    value="<?php echo $_SESSION['id_registrasi']; ?>">
                                <input type="hidden" id="jumlah_tiket" name="jumlah_tiket"
                                    value="<?php echo $jumlahTiket; ?>">
                                <div id="anggotaContainer"></div>

                                <div class="mt-3">
                                    <input type="submit" name="input" value="Kirim"
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

    <script src="../../vendors/js/vendor.bundle.base.js"></script>
    <script src="../../js/off-canvas.js"></script>
    <script src="../../js/hoverable-collapse.js"></script>
    <script src="../../js/template.js"></script>

    <script>
        function generateAnggotaForms(jumlah) {
            const container = document.getElementById('anggotaContainer');
            container.innerHTML = ''; // Clear existing form elements

            // Starting from 2 because member 1 is the session user (assumed)
            for (let i = 2; i <= jumlah; i++) {
                const form = `
                    <h6>Data Anggota ${i}</h6>
                    <div class="form-group">
                        <label>Nama Lengkap Anggota ${i}</label>
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                                <span class="input-group-text bg-transparent border-right-0">
                                    <i class="mdi mdi-account-outline text-primary"></i>
                                </span>
                            </div>
                            <input type="text" name="nama[]" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin Anggota ${i}</label>
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                                <span class="input-group-text bg-transparent border-right-0">
                                    <i class="mdi mdi-gender text-primary"></i>
                                </span>
                            </div>
                            <select name="kelamin[]" class="form-control" required>
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir Anggota ${i}</label>
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                                <span class="input-group-text bg-transparent border-right-0">
                                    <i class="mdi mdi-calendar text-primary"></i>
                                </span>
                            </div>
                            <input type="date" name="tanggal[]" class="form-control" required>
                        </div>
                    </div>
                    <hr>
                `;
                container.innerHTML += form;
            }
        }

        // Get the number of tickets from the hidden input field
        const jumlahTiket = parseInt(document.getElementById('jumlah_tiket').value);
        if (jumlahTiket > 1) {
            generateAnggotaForms(jumlahTiket);
        }
    </script>
</body>

</html>