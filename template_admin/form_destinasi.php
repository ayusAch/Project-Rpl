<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include "../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (!isset($_SESSION['username'])) {
    die("Anda belum login");
}
// Tangkap ID dari URL
$id_destinasi = isset($_GET['id']) ? $_GET['id'] : null;

$id_wisata = "";
$nama = "";
$id_jadwal = "";
$id_lokasi = "";
$id_kuota = "";
$harga = "";
$fasilitas = "";
$file = "";
$tipe_file = "";
$ukuran_file = "";
$deskripsi = "";

// Jika ID ditemukan, ambil data dari database
if ($id_destinasi) {
    $query = "SELECT * FROM destinasi WHERE id_destinasi = '$id_destinasi'";
    $result = $koneksi->query($query);

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $id_wisata = $data['jenis_wisata'];
        $nama = $data['nama_destinasi'];
        $id_jadwal = $data['id_jadwal'];
        $id_lokasi = $data['id_lokasi'];
        $id_kuota = $data['id_kuota'];
        $harga = $data['harga_destinasi'];
        $fasilitas = $data['fasilitas'];
        $file = $data['file'];
        $tipe_file = $data['type'];
        $ukuran_file = $data['size'];
        $deskripsi = $data['deskripsi_destinasi'];


        $fasilitas_array = !empty($fasilitas) ? explode(',', $fasilitas) : [];
    } else {
        // Jika tidak ada data ditemukan, inisialisasi $fasilitas_array sebagai array kosong
        $fasilitas_array = [];
    }
} else {
    // Jika tidak ada ID, inisialisasi $fasilitas_array sebagai array kosong
    $fasilitas_array = [];
}

// Query untuk mendapatkan data wisata
$query_wisata = "SELECT id_wisata, nama_wisata FROM wisata";
$dt_wisata = $koneksi->query($query_wisata);

// Query untuk mendapatkan data jadwal
$query_jadwal = "SELECT id_jadwal, hari FROM jadwal";
$dt_jadwal = $koneksi->query($query_jadwal);

// Query untuk mendapatkan data lokasi
$query_lokasi = "SELECT id_lokasi, nama_lokasi FROM lokasi";
$dt_lokasi = $koneksi->query($query_lokasi);

$query_kuota = "SELECT id_kuota, jumlah_kuota, keterangan FROM kuota";
$dt_kuota = $koneksi->query($query_kuota);
?>

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Tambah Destinasi</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- site icon -->
    <link rel="icon" href="images/fevicon.png" type="image/png" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- site css -->
    <link rel="stylesheet" href="style.css" />
    <!-- responsive css -->
    <link rel="stylesheet" href="css/responsive.css" />
    <!-- color css -->
    <link rel="stylesheet" href="css/colors.css" />
    <!-- select bootstrap -->
    <link rel="stylesheet" href="css/bootstrap-select.css" />
    <!-- scrollbar css -->
    <link rel="stylesheet" href="css/perfect-scrollbar.css" />
    <!-- custom css -->
    <link rel="stylesheet" href="css/custom.css" />
    <!-- calendar file css -->
    <link rel="stylesheet" href="js/semantic.min.css" />
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body class="inner_page login">
    <div class="full_container">
        <div class="container">
            <div class="center verticle_center full_height">
                <div class="login_section">
                    <div class="logo_login">
                        <div class="center">
                            <img width="210" src="images/logo/logo.png" alt="#" />
                        </div>
                    </div>
                    <div class="login_form">
                        <form action="aksi_destinasi.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_destinasi" value="<?php echo $id_destinasi; ?>">
                            <fieldset>
                                <div class="form-group">
                                    <label for="wisata" class="label_field">Jenis Wisata</label>
                                    <select id="wisata" name="wisata" class="form-control">
                                        <?php
                                        while ($row_wisata = $dt_wisata->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo ($row_wisata['id_wisata']); ?>" <?php echo ($id_wisata == $row_wisata['id_wisata']) ? 'selected' : ''; ?>>
                                                <?php echo ($row_wisata['nama_wisata']); ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama" class="label_field">Nama Destinasi</label>
                                    <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>"
                                        class="form-control" placeholder="Tujuan Destinasi" required />
                                </div>
                                <div class="form-group">
                                    <label for="jadwal" class="label_field">Jadwal Kerja</label>
                                    <select id="jadwal" name="jadwal" class="form-control">
                                        <?php
                                        while ($row_jadwal = $dt_jadwal->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo ($row_jadwal['id_jadwal']); ?>" <?php echo ($id_jadwal == $row_jadwal['id_jadwal']) ? 'selected' : ''; ?>>
                                                <?php echo ($row_jadwal['hari']); ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kuota" class="label_field">Kapasitas </label>
                                    <select id="kuota" name="kuota" class="form-control">
                                        <?php
                                        while ($row_kuota = $dt_kuota->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo ($row_kuota['id_kuota']); ?>" <?php echo ($id_kuota == $row_kuota['id_kuota']) ? 'selected' : ''; ?>>
                                                <?php echo ($row_kuota['jumlah_kuota']); ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama" class="label_field">Lokasi</label>
                                    <select name="lokasi" id="lokasi" class="form-control">
                                        <?php
                                        while ($row_lokasi = $dt_lokasi->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo ($row_lokasi['id_lokasi']); ?>" <?php echo ($id_lokasi == $row_lokasi['id_lokasi']) ? 'selected' : ''; ?>>
                                                <?php echo ($row_lokasi['nama_lokasi']); ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="harga" class="label_field">Harga Tiket</label>
                                    <input type="number" id="harga" name="harga" value="<?php echo $harga; ?>"
                                        class="form-control" placeholder="Harga" required />
                                </div>
                                <div class="form-group">
                                    <label>Upload Gambar Destinasi</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                        </div>
                                        <input type="file" name="gambar" id="gambar" <?php echo ($id_destinasi) ? '' : 'required'; ?> class="form-control" onchange="previewImage(this)">
                                    </div>
                                    <div id="imagePreview" class="mt-2">
                                        <!-- Tampilkan gambar sebelumnya jika ada -->
                                        <?php if ($file): ?>
                                            <img src="../images/<?php echo $file; ?>" class="img-fluid"
                                                alt="Gambar Sebelumnya">
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="fasilitas" class="label_field">Fasilitas</label>
                                        <div id="fasilitas" name="fasilitas" class="form-control"
                                            style="display: flex; flex-wrap: wrap; gap: 10px;">
                                            <?php
                                            $fasilitas_list = ["Mushola", "Toilet", "Minimarket", "Camping", "Penginapan", "Parkir"];
                                            foreach ($fasilitas_list as $item) {
                                                // Menggunakan in_array dengan memastikan bahwa $fasilitas_array adalah array
                                                $checked = is_array($fasilitas_array) && in_array($item, $fasilitas_array) ? 'checked' : '';
                                                echo "<div style='flex: 0 0 30%;'>
                                                    <label><input type='checkbox' name='fasilitas[]' value='$item' $checked> $item</label>
                                                  </div>";
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="deskripsi" class="label_field">Deskripsi</label>
                                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="5"
                                            class="form-control" placeholder="Deskripsi Destinasi"
                                            required><?php echo $deskripsi; ?></textarea>
                                    </div>
                                    <div class="form-group margin_0">
                                        <button type="submit" name="input" class="btn btn-primary btn-block">
                                            <?php echo ($id_destinasi) ? 'Update' : 'Input'; ?>
                                        </button>
                                    </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- wow animation -->
    <script src="js/animate.js"></script>
    <!-- select country -->
    <script src="js/bootstrap-select.js"></script>
    <!-- nice scrollbar -->
    <script src="js/perfect-scrollbar.min.js"></script>
    <script>
        var ps = new PerfectScrollbar('#sidebar');
    </script>
    <!-- custom js -->
    <script src="js/custom.js"></script>
    <script>
        function validateForm() {
            // Mendapatkan semua checkbox fasilitas
            var checkboxes = document.getElementsByName('fasilitas[]');
            var selectedCount = 0;

            // Menghitung jumlah fasilitas yang dipilih
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    selectedCount++;
                }
            }
        }
    </script>
    <script>
        function previewImage(input) {
            var imagePreview = document.getElementById('imagePreview');

            // Hapus pratinjau gambar sebelumnya jika ada
            imagePreview.innerHTML = '';

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var imgElement = document.createElement('img');
                    imgElement.setAttribute('src', e.target.result);
                    imgElement.setAttribute('class', 'img-fluid');

                    // Tambahkan gambar ke dalam div pratinjau
                    imagePreview.appendChild(imgElement);

                    // Nonaktifkan atribut required pada input gambar
                    document.getElementById('gambar').removeAttribute('required');
                }

                // Membaca file sebagai URL data
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>