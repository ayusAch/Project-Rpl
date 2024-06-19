<?php
session_start();
include "../../koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username'];

$query_registrasi = $koneksi->prepare("SELECT * FROM registrasi WHERE username = ?");
$query_registrasi->bind_param("s", $username);
$query_registrasi->execute();
$result = $query_registrasi->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nama_lengkap = $row['nama_lengkap'];
    $email = $row['email'];
    $nomor_hp = $row['no_hp'];
    $alamat = $row['alamat'];
    $id_registrasi = $row['id_registrasi'];
    $_SESSION['id_registrasi'] = $row['id_registrasi'];
} else {
    echo "Data pengguna tidak ditemukan.";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pengaturan</title>
    <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="shortcut icon" href="../../images/logo-ku.png" />
</head>

<body>
    <div class="container-scroller d-flex">
        <div class="container-fluid page-body-wrapper full-page-wrapper d-flex">
            <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
                <div class="row flex-grow">
                    <div class="col-lg-6 d-flex align-items-center justify-content-center">
                        <div class="auth-form-transparent text-left p-3">
                            <h4>Pengaturan Akun</h4>
                            <h6>
                                <?php
                                if (isset($_SESSION['username'])) {
                                    echo ($_SESSION['username']);
                                } else {
                                    echo "Pengguna Tidak Ada";
                                }
                                ?>
                            </h6>
                            <form class="pt-3" action="../aksi/aksi_setting.php" method="POST">
                                <input type="hidden" name="id_registrasi"
                                    value="<?php echo htmlspecialchars($id_registrasi); ?>">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-email-outline text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="email" id="email" name="email"
                                            class="form-control form-control-lg border-left-0"
                                            value="<?php echo ($email); ?>" placeholder="Email"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-account-outline text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="nama" name="nama"
                                            value="<?php echo ($nama_lengkap); ?>"
                                            class="form-control form-control-lg border-left-0"
                                            placeholder="Nama Lengkap" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-map-marker-outline text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="alamat" name="alamat"
                                            value="<?php echo ($alamat); ?>"
                                            class="form-control form-control-lg border-left-0" placeholder="Alamat"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="hp">Nomor HP</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-phone text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="number" id="hp" name="hp"
                                            value="<?php echo ($nomor_hp); ?>"
                                            class="form-control form-control-lg border-left-0"
                                            placeholder="Nomor Telepon" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-account-outline text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="username" name="username"
                                            value="<?php echo ($username); ?>"
                                            class="form-control form-control-lg border-left-0" placeholder="Username"
                                            required readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-lock-outline text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="password" id="password" name="password"
                                            class="form-control form-control-lg border-left-0" placeholder="Password">
                                    </div>
                                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah
                                        password.</small>
                                </div>
                                <div class="mt-3">
                                    <input type="submit" name="simpan" value="Simpan"
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
</body>

</html>