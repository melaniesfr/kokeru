<?php include 'header.php'; ?>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
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
      <li class="nav-item active">
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
          <h1 class="h3 mb-2 text-gray-800">Data Ruang Lengkap</h1>

          <!-- Isi Tabel Data CS -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead class="text-center">
                    <tr>
                      <th>No</th>
                      <th>Nama Ruang</th>
                      <th>Customer Service</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php
                      // Execute the query
                      $query = "SELECT r.nama_ruang AS nama_ruang, cs.nama_cs AS nama_cs FROM ruang r JOIN cs ON r.id_cs = cs.id_cs ORDER BY id_ruang";
                      $result = $db->query($query);
                      if (!$result) {
                        die ("Could not query the database: <br>".$db->error."<br>Query: ".$query);
                      }

                      // Fetch and display the results
                      $i = 1;
                      while ($row = $result->fetch_object()) {
                        echo '<tr>';
                        echo '<td class="text-center">'.$i.'</td>';
                        echo '<td class="text-center">'.$row->nama_ruang.'</td>';
                        echo '<td>'.$row->nama_cs.'</td>';
                        echo '</tr>';

                        $i++;
                      }

                      echo '</tbody>';
                      echo '</table>';

                      $result->free();
                      $db->close();
                    ?>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

<?php include 'footer.php'; ?>