<?php
session_start();
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if (!isset($_SESSION['username'])) {
    die("Anda belum login");
}

$username = $_SESSION['username'];
$query_registrasi = "SELECT * FROM registrasi WHERE username=?";
$stmt = $koneksi->prepare($query_registrasi);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id_registrasi = $row['id_registrasi'];
    $id_destinasi = $row['nama_destinasi'];
    $nama_user = $row['username'];
} else {
    echo "Data pengguna tidak ditemukan.";
    exit();
}

$query_destinasi = "SELECT id_destinasi, nama_destinasi FROM destinasi";
$dt_destinasi = $koneksi->query($query_destinasi);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ulasan Anda</title>
    <!-- base:css -->
    <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
    <!-- inject:css -->
    <link rel="stylesheet" href="../../css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../../images/favicon.png" />
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card p-4">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="../../images/logo.svg" alt="logo" style="width: 150px;">
                        </div>
                        <h4 class="card-title text-center">Feedback Anda</h4>
                        <form action="../aksi/aksi_ulasan.php" method="POST">
                            <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi; ?>">
                            <div class="form-group">
                                <label for="nama_lengkap">Username</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0">
                                            <i class="mdi mdi-account text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="text" id="nama_user" name="nama_user" class="form-control"
                                        value="<?php echo $nama_user; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="destinasi">Pilih Destinasi</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0">
                                            <i class="mdi mdi-map-marker text-primary"></i>
                                        </span>
                                    </div>
                                    <select id="id_destinasi" name="id_destinasi" class="form-control">
                                        <?php while ($row_destinasi = $dt_destinasi->fetch_assoc()) { ?>
                                            <option value="<?php echo $row_destinasi['id_destinasi']; ?>">
                                                <?php echo ($row_destinasi['nama_destinasi']); ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="rating">Rating</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0">
                                            <i class="mdi mdi-star text-primary"></i>
                                        </span>
                                    </div>
                                    <select id="rating" name="rating" class="form-control">
                                        <option value="1">1 - Sangat Buruk</option>
                                        <option value="2">2 - Agak Kurang</option>
                                        <option value="3">3 - Biasa Aja</option>
                                        <option value="4">4 - Bagus Banget</option>
                                        <option value="5">5 - Cakep Betul</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="komentar">Komentar</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0">
                                            <i class="mdi mdi-comment-text text-primary"></i>
                                        </span>
                                    </div>
                                    <textarea name="komentar" id="komentar" class="form-control" rows="5"
                                        placeholder="Tulis komentar Anda di sini"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0">
                                            <i class="mdi mdi-calendar text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="date" id="tanggal" name="tanggal" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mt-3">
                                <input type="submit" name="submit" value="Kirim Ulasan"
                                    class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- base:js -->
    <script src="../../vendors/js/vendor.bundle.base.js"></script>
    <!-- inject:js -->
    <script src="../../js/off-canvas.js"></script>
    <script src="../../js/hoverable-collapse.js"></script>
    <script src="../../js/template.js"></script>
    <!-- Custom JavaScript -->
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
</body>

</html>