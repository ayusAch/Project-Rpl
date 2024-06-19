<?php 
session_Start();
?>

<html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
  <!-- base:css -->
  <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../../images/favicon.png" />
</head>

<body>
<div class="container-scroller d-flex">
  <div class="container-fluid page-body-wrapper full-page-wrapper d-flex">
    <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
      <div class="row flex-grow">
        <div class="col-lg-6 d-flex align-items-center justify-content-center">
          <div class="auth-form-transparent text-left p-3">
            <div class="brand-logo">
              <img src="../../images/logo.svg" alt="logo">
            </div>
            <h4>Selamat Datang Kembali</h4>
            <h6 class="font-weight-light">Masuk untuk Melanjutkan</h6>
            <form class="pt-3" action="../aksi/aksi_login.php?op=in" method="POST">
              <div class="form-group">
                <label>Username</label>
                <div class="input-group">
                  <div class="input-group-prepend bg-transparent">
                    <span class="input-group-text bg-transparent border-right-0">
                      <i class="mdi mdi-account-outline text-primary"></i>
                    </span>
                  </div>
                  <input type="text" name="username" class="form-control form-control-lg border-left-0" placeholder="Username" required>
                </div>
              </div>
              <div class="form-group">
                <label>Password</label>
                <div class="input-group">
                  <div class="input-group-prepend bg-transparent">
                    <span class="input-group-text bg-transparent border-right-0">
                      <i class="mdi mdi-lock-outline text-primary"></i>
                    </span>
                  </div>
                  <input type="password" name="password" class="form-control form-control-lg border-left-0" id="exampleInputPassword" placeholder="Password" required>
                </div>
              </div>
              <div class="mt-3">
                <input type="submit" action="aksi_regis.php" name="register" value="Login" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                <a href="form_login.php"></a>
              </div>
              <div class="text-center mt-4 font-weight-light">
                Belum Punya Akun? <a href="form_register.php" class="text-primary">Registrasi</a>
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
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <!-- endinject -->
</body>

</html>
