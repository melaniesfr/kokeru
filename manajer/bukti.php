<?php include 'header.php'; ?>

<style>
  .zoomeffect {
    max-width: 200px;
    max-height: 200px;
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

      <!-- Nav Item - Customer Service -->
      <li class="nav-item">
        <a class="nav-link" href="data_cs.php">
          <i class="fas fa-users"></i>
          <span>Customer Service</span>
        </a>
      </li>

      <!-- Nav Item - Ruangan -->
      <li class="nav-item">
        <a class="nav-link" href="data_ruang.php">
          <i class="fab fa-buromobelexperte"></i>
          <span>Ruangan</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading  -->
      <div class="sidebar-heading">Laporan</div>

      <!-- Nav Item - Laporan -->
      <li class="nav-item">
        <a class="nav-link" href="laporan.php">
          <i class="fab fa-wpforms"></i>
          <span>Laporan Harian</span>
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
                <img class="img-profile rounded-circle" src="../assets2/img/undraw_profile.svg">
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

            <?php
              require_once('../lib/db_login.php');

              $id = $_GET['id'];

              $query = "SELECT * FROM laporan WHERE id_laporan = '$id'";
              $result = $db->query($query);
              if (!$result) {
                die ("Could not query the database: <br />".$db->error);
              }

              while ($row = $result->fetch_object()) {
                if ($row->status == "BELUM") { ?>
                  <div class="row justify-content-center">
                    <div class="col-sm-3">
                      <div class="card bg-white text-white mb-4">
                        <div class="card-body" style="weight: 200px; height: 200px; display: flex; align-items: center; justify-content: center;">
                          <h3 class="row justify-content-center text-center" style="color: black;">Belum <br> ada Bukti</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php }
              }
            ?>

            <?php
              $id = $_GET['id'];

              $server = "localhost";
              $user = "root";
              $pass = "";
              $database = "db_kokeru";

              $koneksi = mysqli_connect($server, $user, $pass, $database) or die(mysqli_error($koneksi));

              $tampil = mysqli_query($koneksi, "SELECT * FROM bukti WHERE id_laporan = '$id'");
              while ($data = mysqli_fetch_array($tampil)):
                $ekstensi_foto = array('png', 'jpg');
                $ekstensi_video = array('mp4');
                $file = $data['nama_file'];
                $x = explode('.', $file);
                $ekstensi = strtolower(end($x));

                echo '<div class="row justify-content-center">';
                echo '  <div class="col-sm-3">';
                echo '    <div class="card bg-white text-white mb-4">';
                echo '      <div class="card-body" style="weight: 200px; height: 250px; display: flex; align-items: center; justify-content: center;">';
                if (in_array($ekstensi, $ekstensi_foto) === true) { ?>
                  <h3 class="row justify-content-center zoomeffect" style="color: black;">
                    <img src="<?php echo "../img/".$data['nama_file']?>"style="max-height: 200px; max-width: 200px;">
                  </h3>
                <?php } else if (in_array($ekstensi, $ekstensi_video) === true) { ?>
                  <h3 class="row justify-content-center" style="color: black;">
                    <video width="200px" height="200px" controls>
                      <source src="<?php echo "../img/".$data['nama_file']?>" type="video/mp4">
                    </video>
                  </h3>
                <?php } else { ?>
                  <h3 class="row justify-content-center" style="color: black;">Foto / Video</h3>
                <?php }
                echo '      </div>';
                echo '    </div>';
                echo '  </div>';
                echo '</div>';
              endwhile;
            ?>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

<?php include 'footer.php'; ?>