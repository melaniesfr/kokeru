<?php include 'header.php'; ?>

<?php
  require_once('../lib/db_login.php');
  $id = $_GET['id']; // Mendapatkan id_ruang yang dilewatkan ke url

  // Mengecek apakah user belum menekan tombol save
  if (!isset($_POST["save"])) {
    $query = "SELECT r.id_ruang as id_ruang, r.nama_ruang AS nama_ruang, cs.id_cs AS id_cs, cs.nama_cs AS nama_cs FROM ruang r JOIN cs ON r.id_cs = cs.id_cs WHERE id_ruang = ".$id."";

    // Execute the query
    $result = $db->query($query);
    if (!$result) {
      die ("Could not query the database: <br>".$db->error);
    } else {
      while ($row = $result->fetch_object()) {
        $nama = $row->nama_ruang;
        $cs = $row->id_cs;
        $nama_cs = $row->nama_cs;
      }
    }
  } else {
    $valid = TRUE; // Flag validasi

    $nama = test_input($_POST['nama']);
    if ($nama == '') {
      $error_nama = "Name is required";
      $valid = FALSE;
    }

    $cs = test_input($_POST['customer']);
    if (empty($cs)) {
      $error_cs = 'CS is required';
      $valid = FALSE;
    }

    // Update data into database
    if ($valid) {
      // Asign a query
      $query = "UPDATE ruang r JOIN cs ON r.id_cs = cs.id_cs SET r.nama_ruang = '".$nama."', r.id_cs = '".$cs."' WHERE id_ruang = ".$id."";

      // Execute the query
      $result = $db->query($query);

      if (!$result) {
        die ("Could not query the database: <br>".$db->error.'<br>Query:'.$query);
      } else {
        header('Location: data_ruang.php');
        $db->close();
      }
    }
  }
?>

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

      <!-- Nav Item - Customer Service -->
      <li class="nav-item">
        <a class="nav-link" href="data_cs.php">
          <i class="fas fa-users"></i>
          <span>Customer Service</span>
        </a>
      </li>

      <!-- Nav Item - Ruangan -->
      <li class="nav-item active">
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
          <!-- Isi Tabel Data CS -->
          <div class="card shadow mb-4">
            <div class="card-header text-center" style="font-weight: bold;">Edit Ruangan</div>
            <div class="card-body">
              <div class="table-responsive">
                <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?id='.$id; ?>">
                  <table>
                    <tr>
                      <td>Nama Ruang</td>
                      <td><input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>" autofocus style="margin-left: 20px;">
                        <div class="error" style="color: red; font-size: 0.75em; padding-top: 10px; padding-bottom: 10px; padding-left: 25px;"><?php if (isset($error_nama)) echo $error_nama; ?></div>
                      </td>
                    </tr>

                    <tr>
                      <td>Customer Service</td>
                      <td><select name="customer" id="customer" class="form-control" style="margin-left: 20px;">
                        <option><?php echo $nama_cs; ?></option>

                        <?php
                          // Asign a query
                          $query = "SELECT * FROM cs ORDER BY id_cs";
                          $result = $db->query($query);

                          if (!$result) {
                            die ("Could not query the database: <br>".$db->error);
                          }

                          // Fetch and display the results
                          while ($row = $result->fetch_object()) {
                            echo '<option value="'.$row->id_cs.'">'.$row->nama_cs.'</option>';
                          }

                          $result->free();
                          $db->close();
                        ?>
                      </select></td>
                    </tr>
                  </table>

                  <br>
                  <div class="text-center">
                    <button type="submit" class="btn btn-warning" name="save" value="save"><i class="fas fa-save"></i> Save</button>&nbsp;&nbsp;
                    <a href="data_ruang.php" class="btn btn-secondary">Back</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

<?php include 'footer.php'; ?>