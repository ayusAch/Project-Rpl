<html>
<?php
session_start();
include "../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    die("Error");
}

// Memeriksa level pengguna
$username = $_SESSION['username'];
$sql = "SELECT level FROM registrasi WHERE username = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $level = $row['level'];

    // Memeriksa apakah pengguna memiliki level admin
    if ($level != 'Admin') {
        die("Anda tidak memiliki izin untuk mengakses halaman ini.");
    }
} else {
    die("User tidak ditemukan.");
}
// Menggunakan prepared statement untuk query
$query = "SELECT * FROM lokasi";
$dt_query = $koneksi->query($query);
?>

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Lokasi</title>
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
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body class="dashboard dashboard_1">
    <div class="full_container">
        <div class="inner_container">
            <!-- Sidebar  -->
            <nav id="sidebar">
                <div class="sidebar_blog_1">
                    <div class="sidebar-header">
                        <div class="logo_section">
                            <a href="index.html"><img class="logo_icon img-responsive" src="images/logo/logo_icon.png"
                                    alt="#" /></a>
                        </div>
                    </div>
                    <div class="sidebar_user_info">
                        <div class="icon_setting"></div>
                        <div class="user_profle_side">
                            <div class="user_img"><img class="img-responsive" src="images/layout_img/user_img.jpg"
                                    alt="#" />
                            </div>
                            <div class="user_info">
                                <?php
                                if (isset($_SESSION['username'])) {
                                    echo $_SESSION['username'];
                                } else {
                                    echo "Login";
                                }
                                ?>
                                <p><span class="online_animation"></span> Online</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sidebar_blog_2">
                    <h4>Menu Admin</h4>

                    <!-- Info Wisata Section -->
                    <ul class="list-unstyled components">
                        <li class="active">
                            <a href="#info_wisata" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <i class="fa fa-dashboard yellow_color"></i> <span>Info Wisata</span>
                            </a>
                            <ul class="collapse list-unstyled" id="info_wisata">
                                <li>
                                    <a href="db_wisata.php"> <span>Data Wisata</span></a>
                                </li>
                                <li>
                                    <a href="db_destinasi.php"> <span>Data Destinasi</span></a>
                                </li>
                                <li>
                                    <a href="db_jadwal.php"> <span>Jadwal Kerja</span></a>
                                </li>
                                <li>
                                    <a href="db_lokasi.php"> <span>Data Lokasi</span></a>
                                </li>
                                <li>
                                    <a href="db_kuota.php"> <span>Data Kuota</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <!-- Info Pengunjung Section -->
                    <ul class="list-unstyled components">
                        <li class="active">
                            <a href="#info_pengunjung" data-toggle="collapse" aria-expanded="false"
                                class="dropdown-toggle">
                                <i class="fa fa-map purple_color2"></i> <span>Info Pengunjung</span>
                            </a>
                            <ul class="collapse list-unstyled" id="info_pengunjung">
                                <li>
                                    <a href="db_pengunjung.php"> <span>Data Pengunjung</span></a>
                                </li>
                                <li>
                                    <a href="db_tiket.php"> <span>Data Tiket</span></a>
                                </li>
                                <li>
                                    <a href="db_pesanan.php"> <span>Data Pesanan</span></a>
                                </li>
                                <li>
                                    <a href="db_transaksi.php"> <span>Data Transaksi</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <!-- Umpan Balik Pengunjung Section -->
                    <ul class="list-unstyled components">
                        <li class="active">
                            <a href="#umpan_balik_pengunjung" data-toggle="collapse" aria-expanded="false"
                                class="dropdown-toggle">
                                <i class="fa fa-bar-chart-o green_color"></i> <span>Umpan Balik Pengunjung</span>
                            </a>
                            <ul class="collapse list-unstyled" id="umpan_balik_pengunjung">
                                <li>
                                    <a href="db_ulasan.php"> <span>Data Ulasan</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
                <!-- topbar -->
                <div class="topbar">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="full">
                            <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i
                                    class="fa fa-bars"></i></button>
                            <div class="right_topbar">
                                <div class="icon_info">
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
                <!-- end topbar -->
                <!-- dashboard inner -->
                <div class="midde_cont">
                    <div class="container-fluid">
                        <div class="row column_title">
                            <div class="col-md-12">
                                <div class="page_title">
                                    <h2>Data Lokasi</h2>
                                </div>

                                <body>
                                    <div class="container mt-5">
                                        <div class="d-flex justify-content-between mb-4">
                                            <div>
                                                <a href='db_admin.php' class="btn btn-primary">Kembali</a>
                                            </div>
                                            <a href='form_lokasi.php' class="btn btn-success">Tambahkan Lokasi</a>
                                        </div>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama Lokasi</th>
                                                    <th>Kelola</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                while ($dt_lokasi = $dt_query->fetch_assoc()) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $no++; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $dt_lokasi['nama_lokasi']; ?>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-warning"
                                                                onclick="showEditForm('<?php echo $dt_lokasi['id_lokasi']; ?>')">Edit</button>
                                                            <button type="button" class="btn btn-danger"
                                                                onclick="confirmDelete('<?php echo $dt_lokasi['id_lokasi']; ?>')">Hapus</button>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </body>
                            </div>
                        </div>
                        <div class="row column3">
                        </div>
                        <!-- end dashboard inner -->
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
            <!-- owl carousel -->
            <script src="js/owl.carousel.js"></script>
            <!-- chart js -->
            <script src="js/Chart.min.js"></script>
            <script src="js/Chart.bundle.min.js"></script>
            <script src="js/utils.js"></script>
            <script src="js/analyser.js"></script>
            <!-- nice scrollbar -->
            <script src="js/perfect-scrollbar.min.js"></script>
            <script>
                var ps = new PerfectScrollbar('#sidebar');
            </script>
            <!-- custom js -->
            <script src="js/chart_custom_style1.js"></script>
            <script src="js/custom.js"></script>
            <script>
                // Fungsi untuk mengarahkan ke halaman edit form
                function showEditForm(id) {
                    // Redirect ke halaman form_jadwal.php dengan mengirimkan ID jadwal sebagai parameter
                    window.location.href = "form_lokasi.php?action=edit&id=" + id;
                }
                // Fungsi untuk menampilkan konfirmasi penghapusan data
                function confirmDelete(id) {
                    if (confirm("Apakah Anda yakin ingin menghapus Lokasi ini?")) {
                        // Redirect ke halaman aksi_wisata.php dengan metode POST untuk menghapus data
                        var form = document.createElement("form");
                        form.setAttribute("method", "post");
                        form.setAttribute("action", "aksi_lokasi.php");

                        // Buat input hidden untuk mengirimkan ID wisata
                        var hiddenId = document.createElement("input");
                        hiddenId.setAttribute("type", "hidden");
                        hiddenId.setAttribute("name", "id_lokasi");
                        hiddenId.setAttribute("value", id);
                        form.appendChild(hiddenId);

                        // Buat input hidden untuk mengirimkan tindakan hapus
                        var hiddenDelete = document.createElement("input");
                        hiddenDelete.setAttribute("type", "hidden");
                        hiddenDelete.setAttribute("name", "hapus");
                        hiddenDelete.setAttribute("value", "true");
                        form.appendChild(hiddenDelete);

                        document.body.appendChild(form);
                        form.submit();
                    }
                }
            </script>
</body>

</html>