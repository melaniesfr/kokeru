<?php
  session_start();
  include('lib/db_login.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="description">
  <meta content="" name="keywords">

  <title>KoKeRu</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets1/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets1/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets1/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets1/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets1/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets1/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets1/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Template Main CSS File -->
  <link href="assets1/css/style.css" rel="stylesheet">
</head>

<body background = "assets2/img/walpaper1.jpg">
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">
      <div class="logo mr-auto">
        <h1 class="text-light"><a href="#"><span>KoKeRu</span></a></h1>
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="get-started"><a href="login.php">Login</a></li>
        </ul>
      </nav><!-- .nav-menu -->
    </div>
  </header><!-- End Header -->

  <main id="main">
    <!-- ======= Monitoring Section ======= -->
    <section id="dashboard" class="dashboard">
      <div class="container">
        <br>

        <!-- Kotak Baris 1 -->
        <div class="row">
          <div class="col-12">
            <h4 class="row justify-content-center">Monitoring Kebersihan dan Kerapian Ruang</h4>
            <h4 class="row justify-content-center">Gedung Bersama Maju</h4>
            <?php
              date_default_timezone_set('Asia/Jakarta');

              if (date('N') == 1) {
                $day = "Senin";
              } else if (date('N') == 2) {
                $day = "Selasa";
              } else if (date('N') == 3) {
                $day = "Rabu";
              } else if (date('N') == 4) {
                $day = "Kamis";
              } else if (date('N') == 5) {
                $day = "Jumat";
              } else if (date('N') == 6) {
                $day = "Sabtu";
              } else if (date('N') == 7) {
                $day = "Minggu";
              }
              echo '<h5 class="row justify-content-center">Hari '.$day.' Tanggal '.date('d F Y').' Jam '.date('H:i:s').' WIB</h5>';
            ?>
            <br>
          </div>
        </div>

        <marquee behavior="" direction="up" height="308"  onmouseover="this.stop();" onmouseout="this.start();">
          <div class="row">
            <?php
              date_default_timezone_set('Asia/Jakarta');
              $tanggal = date('Y-m-d');

              $query = "SELECT r.nama_ruang AS nama_ruang, cs.email AS email, cs.nama_cs AS nama_cs, l.id_laporan AS id_laporan, l.status AS status, l.tanggal AS tanggal FROM ruang r JOIN cs ON r.id_cs = cs.id_cs JOIN laporan l ON l.id_ruang = r.id_ruang WHERE l.tanggal = '$tanggal' ORDER BY r.id_ruang";
              $result = $db->query($query);
              if (!$result) {
                die ("Could not query the database: <br>".$db->error."<br>Query: ".$query);
              }
              ?>
              <?php
              while ($row = $result->fetch_object()) {
                echo '<div class="col-xl-3 col-md-6">';
                if ($row->status == "SUDAH") {
                  echo '  <div class="card bg-success text-white mb-4">';
                } else {
                  echo '  <div class="card bg-warning text-white mb-4">';
                }
                echo '    <div class="card-body">';
                echo '      <h3 class="row justify-content-center">'.$row->nama_ruang.'</h3>';
                echo '      <p class="row justify-content-center">'.$row->status.'</p>';
                echo '      <p class="row justify-content-center">'.$row->nama_cs.'</p>';
                echo '    </div>';
                echo '    <div class="card-footer d-flex align-items-center justify-content-between">';
                echo '      <a class="small text-white stretched-link" href="#">View Details</a>';
                echo '      <div class="small text-white"><i class="fas fa-angle-right"></i></div>';
                echo '    </div>';
                echo '  </div>';
                echo '</div>';
              }
            ?>
          </div>
        </marquee>
      </div>
    </section><!-- End Monitoring Section -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="row d-flex align-items-center">
        <div class="col-lg-6 text-lg-left text-center">
          <div class="copyright">
            &copy; Copyright <strong>KoKeRu</strong> 2020. All Rights Reserved
          </div>
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets1/vendor/jquery/jquery.min.js"></script>
  <script src="assets1/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets1/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets1/vendor/php-email-form/validate.js"></script>
  <script src="assets1/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets1/vendor/counterup/counterup.min.js"></script>
  <script src="assets1/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets1/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets1/vendor/venobox/venobox.min.js"></script>
  <script src="assets1/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets1/js/main.js"></script>
</body>
</html>