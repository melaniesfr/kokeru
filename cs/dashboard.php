<?php include 'header.php'; ?>

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
          <div class="container">
          <!-- Content Row -->
            <div class="row justify-content-center">
            <!-- Sudah Dibersihkan -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                          Sudah Dibersihkan</div>
                        <?php
                          date_default_timezone_set('Asia/Jakarta');
                          $tanggal = date('Y-m-d');
                          // $tanggal = '2020-12-15';

                          $query = "SELECT cs.email AS email, l.id_laporan, l.status  FROM laporan l JOIN ruang r ON r.id_ruang = l.id_ruang JOIN cs ON cs.id_cs = r.id_cs WHERE tanggal = '$tanggal' AND email = '$user'";
                          $result = $db->query($query);
                          if (!$result) {
                            die ("Could not query the database: <br>".$db->error."<br>Query: ".$query);
                          }

                          $i = 0;
                          while ($row = $result->fetch_object()) {
                            if ($row->status == "SUDAH") {
                              $i++;
                            }
                          }

                          echo '<div class="h5 mb-0 font-weight-bold text-gray-800">'.$i.'</div>';
                        ?>
                      </div>
                      <div class="col-auto">
                        <i class="far fa-thumbs-up fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Belum Dibersihkan -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                          Belum Dibersihkan</div>
                        <?php
                          date_default_timezone_set('Asia/Jakarta');
                          $tanggal = date('Y-m-d');
                          // $tanggal = '2020-12-15';

                          $query = "SELECT cs.email AS email, l.id_laporan, l.status  FROM laporan l JOIN ruang r ON r.id_ruang = l.id_ruang JOIN cs ON cs.id_cs = r.id_cs WHERE tanggal = '$tanggal' AND email = '$user'";
                          $result = $db->query($query);
                          if (!$result) {
                            die ("Could not query the database: <br>".$db->error."<br>Query: ".$query);
                          }

                          $i = 0;
                          while ($row = $result->fetch_object()) {
                            if ($row->status == "BELUM") {
                              $i++;
                            }
                          }

                          echo '<div class="h5 mb-0 font-weight-bold text-gray-800">'.$i.'</div>';
                        ?>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-ban fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <br>

            <div class="row justify-content-center">
              <div class="col-12">
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

                  echo '<h4 class="row justify-content-center">Hari '.$day.' Tanggal '.date('d F Y').' Jam '.date('H:i:s').' WIB</h4>';
                ?>
                <br>
              </div>

              <?php
                date_default_timezone_set('Asia/Jakarta');
                $tanggal = date('Y-m-d');
                // $tanggal = '2020-12-15';

                $query = "SELECT r.nama_ruang AS nama_ruang, cs.email AS email, cs.nama_cs AS nama_cs, l.id_laporan AS id_laporan, l.status AS status, l.tanggal AS tanggal FROM ruang r JOIN cs ON r.id_cs = cs.id_cs JOIN laporan l ON l.id_ruang = r.id_ruang WHERE l.tanggal = '$tanggal' AND l.id_ruang = r.id_ruang AND email = '$user' ORDER BY r.id_ruang";
                $result = $db->query($query);

                if (!$result) {
                  die ("Could not query the database: <br>".$db->error."<br>Query: ".$query);
                } else {
                  $i = 0;
                  while ($row = $result->fetch_object()) {
                    echo '<div class="col-xl-3 col-md-6">';
                    if ($row->status=="SUDAH") {
                      echo '  <div class="card bg-success text-white mb-4">';
                    } else {
                      echo '  <div class="card bg-warning text-white mb-4">';
                    }

                    echo '    <div class="card-body">';
                    echo '      <h3 class="row justify-content-center">'.$row->nama_ruang.'</h3>';
                    if ($row->status == "SUDAH") {
                      echo '<p class="row justify-content-center"><span class="badge bg-warning">'.$row->status.'</span></p>';
                    } else {
                      echo '<p class="row justify-content-center"><span class="badge bg-danger">'.$row->status.'</span></p>';
                    }
                    echo '      <p class="row justify-content-center">'.$row->nama_cs.'</p>';
                    echo '    </div>';
                    echo '    <div class="card-footer d-flex align-items-center justify-content-between">';
                    echo '      <a class="small text-blue stretched-link" href="bukti.php?id='.$row->id_laporan.'">View Details</a>';
                    echo '      <div class="small text-dark"><i class="fas fa-angle-right"></i></div>';
                    echo '    </div>';
                    echo '  </div>';
                    echo '</div>';
                  }
                }
              ?>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

<?php include 'footer.php'; ?>