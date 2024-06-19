<?php
session_start();
include "../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if (!isset($_SESSION['username'])) {
    die("Admin belum login");
}
// Tangkap ID dari URL
$id_registrasi = isset($_GET['id']) ? $_GET['id'] : null;

$email = "";
$nama = "";
$alamat = "";
$hp = "";
$username = "";
$password = "";

// Jika ID ditemukan, ambil data dari database
if ($id_registrasi) {
    $query = "SELECT * FROM registrasi WHERE id_registrasi = '$id_registrasi'";
    $result = $koneksi->query($query);

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $email = $data['email'];
        $nama = $data['nama_lengkap'];
        $alamat = $data['alamat'];
        $hp = $data['no_hp'];
        $username = $data['username'];
        $password = $data['password'];
    }
}
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
    <title>Pengguna</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="css/bootstrap-select.css" />
    <link rel="stylesheet" href="css/perfect-scrollbar.css" />
</head>

<body class="inner_page login">
    <div class="full_container">
        <div class="container">
            <div class="center verticle_center full_height">
                <div class="login_section">
                    <div class="logo_login">
                        <div class="center">
                            <img width="210" />
                        </div>
                    </div>
                    <div class="login_form">
                        <form action="aksi_pengunjung.php" method="POST">
                            <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi; ?>">
                            <fieldset>
                            <div class="form-group">
                                    <label for="email" class="label_field">email</label>
                                    <div></div>
                                    <input type="text" name="email" value="<?php echo $email; ?>" class="form-control"
                                        placeholder="Email" required />
                                </div>
                                <div class="form-group">
                                    <label for="nama" class="label_field">Nama Lengkap</label>
                                    <div></div>
                                    <input type="text" name="nama" value="<?php echo $nama; ?>" class="form-control"
                                        placeholder="Email" required />
                                </div>
                                <div class="form-group">
                                    <label for="alamat" class="label_field">Alamat</label>
                                    <input type="text" name="alamat" value="<?php echo $alamat; ?>" class="form-control"
                                        placeholder="Alamat" required />
                                </div>
                                <div class="form-group">
                                    <label for="hp" class="label_field">Nomor HP</label>
                                    <input type="text" name="hp" value="<?php echo $hp; ?>" class="form-control"
                                        placeholder="Nomor Hp" required />
                                </div>
                                <div class="form-group">
                                    <label for="username" class="label_field">Username</label>
                                    <input type="text" name="username" value="<?php echo $username; ?>" class="form-control"
                                        placeholder="Username" required />
                                </div>
                                <div class="form-group">
                                    <label for="password" class="label_field">Password</label>
                                    <input type="text" name="password" value="<?php echo $password; ?>" class="form-control"
                                        placeholder="Password" required />
                                </div>
                                <div class="form-group margin_0">
                                    <button type="submit" name="input" class="btn btn-primary btn-block">
                                        <?php echo ($id_registrasi) ? 'Update' : 'Input'; ?>
                                    </button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animate.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/perfect-scrollbar.min.js"></script>
    <script>
        var ps = new PerfectScrollbar('#sidebar');
    </script>
</body>

</html>