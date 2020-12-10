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
          <div class="container">
            <!-- Content Row -->
            <div class="row">
              <!-- Jumlah CS -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah CS</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">3</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Jumlah Ruang -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                          Jumlah Ruang</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">12</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Sudah Dibersihkan -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                          Sudah Dibersihkan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">4</div>
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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">8</div>
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

            <!-- Kotak Baris 1 -->
            <div class="row">
              <div class="col-12">
                <h4 class="row justify-content-center">Hari Kamis Tanggal 12 November 2020 Jam 07:11 WIB</h4>
                <br>
              </div>

              <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                  <div class="card-body">
                    <h3 class="row justify-content-center">R.123</h3>
                    <p class="row justify-content-center">BELUM</p>
                    <p class="row justify-content-center">Doni Kusumah</p>
                  </div>
                  <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-blue stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                  <div class="card-body">
                    <h3 class="row justify-content-center">R.143</h3>
                    <p class="row justify-content-center">BELUM</p>
                    <p class="row justify-content-center">Roni Sandria Kalalo</p>
                  </div>
                  <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-blue stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                  <div class="card-body">
                    <h3 class="row justify-content-center">R.183</h3>
                    <p class="row justify-content-center">SUDAH</p>
                    <p class="row justify-content-center">Doni Kusumah</p>
                  </div>
                  <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-blue stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                  <div class="card-body">
                    <h3 class="row justify-content-center">R.129</h3>
                    <p class="row justify-content-center">BELUM</p>
                    <p class="row justify-content-center">Devi Deswinta Sari</p>
                  </div>
                  <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-blue stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Kotak Baris 2 -->
            <div class="row">
              <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                  <div class="card-body">
                    <h3 class="row justify-content-center">R.122</h3>
                    <p class="row justify-content-center">BELUM</p>
                    <p class="row justify-content-center">Doni Kusumah</p>
                  </div>
                  <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-blue stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                  <div class="card-body">
                    <h3 class="row justify-content-center">R.132</h3>
                    <p class="row justify-content-center">BELUM</p>
                    <p class="row justify-content-center">Roni Sandria Kalalo</p>
                  </div>
                  <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-blue stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                  <div class="card-body">
                    <h3 class="row justify-content-center">R.163</h3>
                    <p class="row justify-content-center">SUDAH</p>
                    <p class="row justify-content-center">Doni Kusumah</p>
                  </div>
                  <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-blue stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                  <div class="card-body">
                    <h3 class="row justify-content-center">R.149</h3>
                    <p class="row justify-content-center">BELUM</p>
                    <p class="row justify-content-center">Devi Deswinta Sari</p>
                  </div>
                  <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-blue stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Kotak baris 3 -->
            <div class="row">
              <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                  <div class="card-body">
                    <h3 class="row justify-content-center">R.121</h3>
                    <p class="row justify-content-center">BELUM</p>
                    <p class="row justify-content-center">Doni Kusumah</p>
                  </div>
                  <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-blue stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                  <div class="card-body">
                    <h3 class="row justify-content-center">R.113</h3>
                    <p class="row justify-content-center">BELUM</p>
                    <p class="row justify-content-center">Roni Sandria Kalalo</p>
                  </div>
                  <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-blue stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                  <div class="card-body">
                    <h3 class="row justify-content-center">R.153</h3>
                    <p class="row justify-content-center">SUDAH</p>
                    <p class="row justify-content-center">Doni Kusumah</p>
                  </div>
                  <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-blue stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                  <div class="card-body">
                    <h3 class="row justify-content-center">R.139</h3>
                    <p class="row justify-content-center">SUDAH</p>
                    <p class="row justify-content-center">Devi Deswinta Sari</p>
                  </div>
                  <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-blue stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

<?php include 'footer.php'; ?>