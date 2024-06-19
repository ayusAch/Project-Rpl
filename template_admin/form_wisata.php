<?php
session_start();
include "../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if (!isset($_SESSION['username'])) {
    die("Admin belum login");
}
// Tangkap ID dari URL
$id_wisata = isset($_GET['id']) ? $_GET['id'] : null;

$jenis = "";
$nama = "";

// Jika ID ditemukan, ambil data dari database
if ($id_wisata) {
    $query = "SELECT * FROM wisata WHERE id_wisata = '$id_wisata'";
    $result = $koneksi->query($query);

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $jenis = $data['jenis_wisata'];
        $nama = $data['nama_wisata'];
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
    <title>Tambah Wisata</title>
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
                        <form action="aksi_wisata.php" method="POST">
                            <input type="hidden" name="id_wisata" value="<?php echo $id_wisata; ?>">
                            <fieldset>
                                <div class="form-group">
                                    <label for="jenis" class="label_field">Kategori</label>
                                    <div></div>
                                    <select name="jenis" id="jenis" class="dropdown" required>
                                        <option value="Wisata Alam" <?php if ($jenis == 'Wisata Alam')
                                            echo 'selected'; ?>>
                                            Wisata Alam
                                        </option>
                                        <option value="Wisata Budaya" <?php if ($jenis == 'Wisata Budaya')
                                            echo 'selected'; ?>>
                                            Wisata Budaya
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama" class="label_field">Jenis Wisata</label>
                                    <input type="text" name="nama" value="<?php echo $nama; ?>" class="form-control"
                                        placeholder="Jenis Wisata" required />
                                </div>
                                <div class="form-group margin_0">
                                    <button type="submit" name="input" class="btn btn-primary btn-block">
                                        <?php echo ($id_wisata) ? 'Update' : 'Input'; ?>
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