<?php
session_start();
include "../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if (!isset($_SESSION['username'])) {
    die("Admin belum login");
}
$nama = "";

if (isset($_GET['id'])) {
    $id_lokasi = $_GET['id'];

    if ($id_lokasi) {
        $query = "SELECT * FROM lokasi WHERE id_lokasi = '$id_lokasi'";
        $result = $koneksi->query($query);

        if ($result && $result->num_rows > 0) {
            $data = $result->fetch_assoc();

            $nama = $data['nama_lokasi'];
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
    <title>Form Lokasi</title>
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
                        <form action="aksi_lokasi.php" method="POST">
                            <input type="hidden" name="id_lokasi" value="<?php echo $id_lokasi; ?>">
                            <fieldset>
                                <div class="form-group" id="lokasiContainer">
                                    <label for="nama" class="label_field">Nama Lokasi</label>
                                    <?php if (isset($id_lokasi)) { ?>
                                        <input type="text" name="nama_lokasi" value="<?php echo $nama; ?>" id="nama"
                                            class="form-control" required>
                                    <?php } else { ?>
                                        <input type="text" name="nama_lokasi[]" id="nama" class="form-control" required>
                                    <?php } ?>
                                </div>
                                <?php if (!$id_lokasi) { ?>
                                    <div>
                                        <button type="button" class="btn btn-info" onclick="tambahInput()">Multi Insert</button>
                                    </div>
                                <?php } ?>
                                <p></p>
                                <div class="form-group margin_0">
                                    <button type="submit" name="input" class="btn btn-primary btn-block">
                                        <?php echo $id_lokasi ? "Update" : "Input"; ?>
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
        var counter = 1;

        function tambahInput() {
            counter++;
            var inputBaru = `
            <div class="input-group mt-2" id="lokasi${counter}">
                <input type="text" name="nama_lokasi[]" class="form-control" placeholder="Nama Lokasi" required>
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger" onclick="hapusInput(${counter})">Hapus</button>
                </div>
            </div>
        `;
            document.getElementById('lokasiContainer').insertAdjacentHTML('beforeend', inputBaru);
        }

        function hapusInput(id) {
            document.getElementById('lokasi' + id).remove();
        }
    </script>
</body>

</html>