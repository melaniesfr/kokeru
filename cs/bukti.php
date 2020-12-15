<?php include 'header.php'; ?>

<?php
  require_once('../lib/db_login.php');
  // $id = $_GET['id'];

  // if (isset($_POST["submit"])) {
  //   if ($_SESSION['email']) {
  //     $user = $_SESSION['email'];
  //     $query = "SELECT l.id_laporan AS id_laporan FROM cs JOIN ruang r ON r.id_cs = cs.id_cs JOIN laporan l ON l.id_ruang = r.id_ruang JOIN bukti b ON b.id_laporan = l.id_laporan WHERE cs.email = '$user'";
  //   }
  //   $result = $db->query($query);
  //   if (!$result) {
  //     die ("Could not query the database: <br>".$db->error);
  //   }

  //   $valid = TRUE;
  //   while ($row = $result->fetch_object()) {
  //     $id_laporan = $row->id_laporan;

  //     $gambar = $_FILES['gambar']['name'];
  //     if ($gambar == '') {
  //       $error_gambar = "File is required";
  //       $valid = FALSE;
  //     }
  //   }

  //   move_uploaded_file($_FILES['gambar']['tmp_name'], "../img/$gambar");

  //   date_default_timezone_set('Asia/Jakarta');
  //   $tanggal = date('Y-m-d');

  //   if ($valid) {
  //     $query1 = "INSERT INTO bukti (id_laporan, nama_file, tanggal) VALUES ($id_laporan', '$gambar', '$tanggal')";
  //     $result1 = $db->query($query1);

  //     if (!$result1) {
  //       die('Could not query the database: <br>'.$db->error.'<br>Query: '.$query1);
  //     } else {
  //       $db->close();
  //     }
  //   }
  // }

  if (isset($_POST['submit'])) {
    $ekstensi_diperbolehkan = array('png', 'jpg', 'mp4');
    $file = $_FILES['file']['name'];
    $x = explode('.', $file);
    $ekstensi = strtolower(end($x));
    $ukuran	= $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];

    if ($file == '') {
      $error_file = "File is required";
    }

    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
      if ($ukuran < 1044070) {
        move_uploaded_file($file_tmp, '../img/'.$file);

        date_default_timezone_set('Asia/Jakarta');
        // $tanggal = date('Y-m-d');
        $tanggal = date('2020-12-15');

        $query = "INSERT INTO bukti (id_laporan, nama_file, tanggal) VALUES (581, '$file', '$tanggal')";
        $result = $db->query($query);

        if (!$result) {
          die('Could not query the database: <br>'.$db->error.'<br>Query: '.$query);
        } else {
          // $db->close();
          header('dashboard.php');
        }
      }
    }
  }
?>

<style>
  .zoomeffect {
    width: 100%;
    height: 100%;
    text-align :center;
    overflow: hidden;
    position: relative;
    cursor: default;
  }

  .zoomeffect img {
    display: block;
    position: relative;
    cursor: pointer;
    -webkit-transition: all .4s linear;
    transition: all .4s linear;
    width: 100%;
  }

  .zoomeffect:hover img {
    -ms-transform: scale(1.2);
    -webkit-transform: scale(1.2);
    transform: scale(1.2);
  }
</style>

    <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">Data</div>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="data_ruang.php">
          <i class="fab fa-buromobelexperte"></i>
          <span>Ruangan</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php
                  if (isset($_SESSION['email'])) {
                    $user = $_SESSION['email'];
                  }

                  $query = "SELECT * FROM user WHERE email = '$user'";
                  $result = $db->query($query);
                  if (!$result) {
                    die ("Could not query the database: <br />".$db->error);
                  }

                  while ($row = $result->fetch_object()) {
                    echo '<span class="mr-2 d-none d-lg-inline text-gray-600 small">'.$row->nama.'</span>';
                  }
                ?>
                <img class="img-profile rounded-circle" src="../assets2/img/undraw_profile_2.svg">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <a href="dashboard.php" class="btn btn-secondary btn-icon-split">
            <span class="icon text-white-50">
              <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Back</span>
          </a>

          <br><br>
          <div class="card shadow mb-4 bg-primary">
            <div class="card-header bg-warning text-center" style="margin-bottom: 20px; font-size: 20px; color: white; font-weight: bold;">Bukti Kebersihan dan Kerapian</div>

            <div class="row justify-content-center">
              <div class="col-sm-3">
                <div class="card bg-white text-white mb-4">
                  <div class="card-body" style="weight: 200px; height: 200px;">
                    <h3 class="row justify-content-center" style="color: black;">Foto / Video</h3>
                  </div>
                </div>
              </div>

              <div class="col-sm-3">
                <div class="card bg-white text-white mb-4">
                  <div class="card-body" style="weight: 200px; height: 200px;">
                    <h3 class="row justify-content-center" style="color: black;">Foto / Video</h3>
                  </div>
                </div>
              </div>
            </div>

            <div class="row justify-content-center">
              <div class="col-sm-3">
                <div class="card bg-white text-white mb-4">
                  <div class="card-body" style="weight: 200px; height: 200px;">
                    <h3 class="row justify-content-center" style="color: black;">Foto / Video</h3>
                  </div>
                </div>
              </div>

              <div class="col-sm-3">
                <div class="card bg-white text-white mb-4">
                  <div class="card-body" style="weight: 200px; height: 200px;">
                    <h3 class="row justify-content-center" style="color: black;">Foto / Video</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Upload -->
          <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
            <div class="form-group">
              <label for="file">File</label>

              <div class="custom-file">
                <input type="file" class="custom-file-input" id="file" name="file">
                <label class="custom-file-label" for="file" id="nama_file" nama="nama_file">Choose file to upload...</label>
              </div>

              <div class="error" style="color: red; font-size: 0.75em; padding-left: 10px; padding-top: 10px;"><?php if (isset($error_file)) echo $error_file; ?></div>
            </div>

            <button type="submit" class="btn btn-primary" name="submit" value="submit">Upload</button>
          </form>

          <br>

          <table class="zoomeffect">
            <?php
              $server = "localhost";
              $user = "root";
              $pass = "";
              $database = "db_kokeru";

              $koneksi = mysqli_connect($server, $user, $pass, $database) or die(mysqli_error($koneksi));

              $tampil = mysqli_query($koneksi, "SELECT * FROM bukti WHERE id_laporan = 581");
              while ($data = mysqli_fetch_array($tampil)):
            ?>

            <tr>
              <center>
                <td>
                  <?php
                    $ekstensi_foto = array('png', 'jpg');
                    $ekstensi_video = array('mp4');
                    $file = $data['nama_file'];
                    $x = explode('.', $file);
                    $ekstensi = strtolower(end($x)); ?>

                    <?php if (in_array($ekstensi, $ekstensi_foto) === true) { ?>
                      <img src="<?php echo "../img/".$data['nama_file']?>"style="width: 200px;">
                    <?php } else if (in_array($ekstensi, $ekstensi_video) === true) { ?>
                      <video width="200px" height="200px" controls>
                        <source src="<?php echo "../img/".$data['nama_file']?>" type="video/mp4">
                      </video>';
                    <?php } ?>
                </td>
              </center>
            </tr>
            <?php endwhile;?>
          </table>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

<?php include 'footer.php'; ?>