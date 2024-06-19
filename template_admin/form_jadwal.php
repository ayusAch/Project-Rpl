<?php
session_start();
include "../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if (!isset($_SESSION['username'])) {
    die("Admin belum login");
}
$hari = "";
$buka = "";
$tutup = "";

// Tangkap ID dari URL
if (isset($_GET['id'])) {
    $id_jadwal = $_GET['id'];

// Jika ID ditemukan, ambil data dari database
if ($id_jadwal) {
    $query = "SELECT * FROM jadwal WHERE id_jadwal = '$id_jadwal'";
    $result = $koneksi->query($query);

    if ($result && $result->num_rows > 0) {
        $data = $result->fetch_assoc();

        $hari = $data['hari'];
        $buka = $data['jam_buka'];
        $tutup = $data['jam_tutup'];
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
    <title>Data Jadwal</title>
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
                        <form action="aksi_jadwal.php" method="POST">
                            <input type="hidden" name="id_jadwal" value="<?php echo $id_jadwal; ?>">
                            <fieldset>
                                <div class="form-group">
                                    <label for="hari" class="label_field">Hari</label>
                                    <select name="hari" id="hari">
                                        <option value="Setiap Hari"<?php if ($hari == 'Setiap Hari')
                                            echo 'selected'; ?>> Setiap Hari</option>
                                        <option value="Weekend"<?php if ($hari == 'Weekend')
                                            echo 'selected'; ?>> Weekend</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="buka" class="label_field">Jam Buka</label>
                                    <input type="time" name="buka" value="<?php echo $buka; ?>" id="buka" class="form-control" placeholder="Jam Buka"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="tutup" class="label_field">Jam Tutup</label>
                                    <input type="time" name="tutup" value="<?php echo $tutup; ?>" id="tutup" class="form-control"
                                        placeholder="Jam Tutup" required>
                                </div>
                                <div class="form-group margin_0">
                                    <button type="submit" name="input" class="btn btn-primary btn-block">
                                        <?php echo $id_jadwal ? "Update" : "Input"; ?>
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