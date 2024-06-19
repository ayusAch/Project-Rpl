<?php
session_start();
include "../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if (!isset($_SESSION['username'])) {
    die("Admin belum login");
}
$jumlah = "";
$keterangan = "";

if (isset($_GET['id'])) {
    $id_kuota = $_GET['id'];

if ($id_kuota) {
    $query = "SELECT * FROM kuota WHERE id_kuota = '$id_kuota'";
    $result = $koneksi->query($query);

    if ($result && $result->num_rows > 0) {
        $data = $result->fetch_assoc();

        $jumlah = $data['jumlah_kuota'];
        $keterangan = $data['keterangan'];
    }
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
    <title>Data Kuota</title>
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
                        <form action="aksi_kuota.php" method="POST">
                            <input type="hidden" name="id_kuota" value="<?php echo $id_kuota; ?>">
                            <fieldset>
                                <div class="form-group">
                                    <label for="kuota" class="label_field">Jumlah Kuota</label>
                                    <input type="text" name="jumlah" value="<?php echo $jumlah; ?>" id="jumlah" class="form-control" placeholder="Jumlah Kuota"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan" class="label_field">Keterangan</label>
                                    <input type="text" name="keterangan" value="<?php echo $keterangan; ?>" id="keterangan" class="form-control" placeholder="keterangan"
                                        required>
                                </div>
                                <div class="form-group margin_0">
                                    <button type="submit" name="input" class="btn btn-primary btn-block">
                                        <?php echo $id_kuota ? "Update" : "Input"; ?>
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
</body>

</html>