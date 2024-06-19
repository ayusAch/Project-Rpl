<?php
include "koneksi.php";
session_start();

$sql_destinasi = "SELECT * FROM destinasi 
JOIN wisata ON destinasi.id_wisata = wisata.id_wisata
JOIN jadwal ON destinasi.id_jadwal = jadwal.id_jadwal
JOIN lokasi ON destinasi.id_lokasi = lokasi.id_lokasi";

$result_destinasi = $koneksi->query($sql_destinasi);

if (!$result_destinasi) {
  die("Error executing query");
}

$destinasi = [];
if ($result_destinasi->num_rows > 0) {
  while ($row = $result_destinasi->fetch_assoc()) {
    $destinasi[] = $row;
  }
}

$query_ulasan = "SELECT * FROM ulasan
JOIN registrasi ON registrasi.id_registrasi=ulasan.id_registrasi
JOIN destinasi ON destinasi.id_destinasi=ulasan.id_destinasi"; // Menampilkan ulasan terbaru di atas

$result_ulasan = $koneksi->query($query_ulasan);

// Periksa jika query berhasil
if (!$result_ulasan) {
  echo "Gagal mengambil data ulasan: ";
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Pariwisata</title>
  <!-- base:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/logo-ku.png" />
</head>

<body>
  <div class="container-scroller d-flex">
    <!-- partial:./partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item sidebar-category">
          <p>Navigasi</p>
          <span></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="home.php">
            <i class="mdi mdi-home-circle menu-icon"></i>
            <span class="menu-title">Halaman Utama</span>
          </a>
        </li>
        <li class="nav-item sidebar-category">
          <p>Menu</p>
          <span></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#tiket-collapse" aria-expanded="false"
            aria-controls="informasi-collapse">
            <i class="mdi mdi-cart-plus menu-icon"></i>
            <span class="menu-title">PESAN TIKET</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="tiket-collapse">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="pages/forms/form_tiket.php">Pesan Tiket</a></li>
              <li class="nav-item"> <a class="nav-link" href="pages/forms/rekap.php">Pesananku</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#galery-collapse" aria-expanded="false"
            aria-controls="galery-collapse">
            <i class="mdi mdi-animation-outline menu-icon"></i>
            <span class="menu-title">GALERY</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="galery-collapse">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="#rekap">Rekap Pengunjung</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#testi-collapse" aria-expanded="false"
            aria-controls="testi-collapse">
            <i class="mdi mdi-star menu-icon"></i>
            <span class="menu-title">PENILAIAN</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="testi-collapse">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="pages/forms/form_ulasan.php">Ulasan</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item sidebar-category">
          <p>Kontak</p>
          <span></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
            <i class="mdi mdi-account-group menu-icon"></i>
            <span class="menu-title">Hubungi Kami</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item">
                <a class="nav-link" href="https://wa.me/085852841041" target="_blank">WhatsApp</a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:./partials/_navbar.html -->
      <nav class="navbar col-lg-12 col-12 px-0 py-0 py-lg-4 d-flex flex-row">
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <div class="navbar-brand-wrapper">
            <a class="navbar-brand brand-logo" href="home.php"><img src="images/pohon.png" alt="logo" /></a>
          </div>
          <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1">Selamat Datang
            <br>
            <?php
            // Periksa apakah pengguna sudah login
            if (isset($_SESSION['username'])) {
              $username = $_SESSION['username'];
              // Jika sudah login, tampilkan nama pengguna
              echo "Halo, $username";
            } else {
              // Jika belum login, tampilkan pesan default
              echo "Pengguna Belum Login.";
            }
            ?>
          </h4>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item">
              <h5 class="mb-0 font-weight-bold d-none d-xl-block" id="current-date"></h5>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
        <div class="navbar-menu-wrapper navbar-search-wrapper d-none d-lg-flex align-items-center">
          <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-search d-none d-lg-block">
            </li>
          </ul>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                <img src="images/faces/user.png" alt="profile" />
                <span class="nav-profile-name"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <?php

                // Periksa apakah pengguna sudah login
                if (isset($_SESSION['username'])) {
                  // Jika sudah login, tampilkan menu settings dan logout
                  ?>
                  <a class="dropdown-item" href="pages/forms/form_setting.php">
                    <i class="mdi mdi-settings text-primary"></i>
                    Settings
                  </a>
                  <a class="dropdown-item" href="pages/aksi/logout.php">
                    <i class="mdi mdi-logout text-primary"></i>
                    Logout
                  </a>
                  <?php
                } else {
                  // Jika belum login, tampilkan menu login
                  ?>
                  <a class="dropdown-item" href="pages/forms/form_login.php">
                    <i class="mdi mdi-login text-primary"></i>
                    Login
                  </a>
                  <?php
                }
                ?>
              </div>
            </li>
          </ul>
        </div>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <?php foreach ($destinasi as $d): ?>
              <div class="col-md-6 grid-margin stretch-card">
                <div class="row w-100 flex-grow">
                  <div class="col-md-12 grid-margin stretch-card" id="destinasi">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">
                          <?= $d['nama_destinasi'] ?>
                        </h5>
                        <p class="text-muted">
                          <?= $d['nama_lokasi'] ?>
                        </p>
                        <img src="images/<?= $d['file'] ?>" alt="<?= $d['nama_destinasi'] ?>" width="500" height="auto"
                          class="img-fluid mx-auto d-block mb-3">
                        <div class="deskripsi-short">
                          <p class="card-text">
                            <?= substr($d['deskripsi_destinasi'], 0, 100) ?>...
                          </p>
                        </div>
                        <div class="deskripsi-full" style="display: none;">
                          <p class="card-text">
                            <?= $d['deskripsi_destinasi'] ?>
                          </p>
                        </div>
                        <p></p>
                        <a href="#" class="btn btn-primary btn-sm mr-2 baca-selengkapnya">Baca Selengkapnya</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>

          <div class="row">
            <!-- Rekap Pengunjung -->
            <div class="col-lg-4 grid-margin stretch-card" id="rekap">
              <div class="card">
                <div class="card-body text-center">
                  <h4 class="card-title">Rekap Pengunjung</h4>
                  <i class="mdi mdi-account-multiple-outline icon-lg text-primary mb-2"></i>
                  <h3>350 Pengunjung</h3>
                  <p class="text-muted">Total pengunjung hari ini</p>
                </div>
                <div class="card-body text-center">
                  <h4 class="card-title">Tiket Terjual</h4>
                  <i class="mdi mdi-ticket-confirmation icon-lg text-success mb-2"></i>
                  <h3>2,350 Tiket </h3>
                  <p class="text-muted">Total Tiket Terjual hari ini</p>
                </div>
                <div class="card-body text-center">
                  <h4 class="card-title">Suka</h4>
                  <i class="mdi mdi-heart icon-lg text-danger mb-2"></i>
                  <h3>12,450 Suka</h3>
                  <p class="text-muted">Terimaksih Sudah Berkunjung</p>
                </div>
                <!-- Data Tambahan -->
              </div>
            </div>

            <!-- Ulasan -->
            <div class="col-lg-8 grid-margin stretch-card" id="ulasan">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Ulasan Pengguna</h4>
                  <?php while ($row = $result_ulasan->fetch_assoc()) { ?>
                    <!-- Komentar -->
                    <div class="media mb-4">
                      <img src="images/faces/face1.jpg" class="mr-3 rounded-circle" alt="image"
                        style="width: 80px; height: 80px;">
                      <div class="media-body">
                        <h5 class="mt-0">
                          <?php echo ($row['nama_lengkap']); ?>
                        </h5>
                        <div class="rating">
                          <?php
                          $rating = isset($row['rating']) ? (int) $row['rating'] : 0;
                          for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $rating) {
                              echo '<i class="mdi mdi-star text-warning"></i>'; // Bintang penuh
                            } else {
                              echo '<i class="mdi mdi-star-outline text-warning"></i>'; // Bintang kosong
                            }
                          }
                          ?>
                        </div>
                        <p>
                          <?php echo ($row['komentar']); ?>
                        </p>
                        <p class="text-muted">
                          <?php echo date("d M Y", strtotime($row['tanggal_ulasan'])); ?>
                        </p>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:./partials/_footer.html -->
        <footer class="footer" id="footer">
          <div class="card">
            <div class="card-body">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©2024</span>
              </div>
            </div>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- base:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="script.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', (event) => {

      // Fungsi untuk mendapatkan tanggal saat ini dalam format yang diinginkan
      function getCurrentDate() {
        const today = new Date();
        const options = { year: 'numeric', month: 'short', day: 'numeric' };
        return today.toLocaleDateString('en-US', options);
      }

      // Set tanggal saat ini ke dalam elemen dengan id 'current-date'
      document.getElementById('current-date').textContent = getCurrentDate();
    });
  </script>
  <script>
    document.querySelectorAll('.baca-selengkapnya').forEach(function (button) {
      button.addEventListener('click', function (e) {
        e.preventDefault();
        var deskripsiShort = this.closest('.card-body').querySelector('.deskripsi-short');
        var deskripsiFull = this.closest('.card-body').querySelector('.deskripsi-full');

        deskripsiShort.style.display = 'none';
        deskripsiFull.style.display = 'block';
      });
    });
  </script>

  <!-- End custom js for this page-->
</body>

</html>