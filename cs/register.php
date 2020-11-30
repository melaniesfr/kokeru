<?php
  session_start(); // Inisialisasi session
  require_once('../lib/db_login.php');

  $nama = $email = $password = '';

  // Mengecek apakah user belum menekan tombol submit
  if (isset($_POST["submit"])) {
    $valid = TRUE;

	  // Cek validasi nama
    $nama = test_input($_POST['nama']);
    if (empty($nama)) {
      $error_nama = 'Name is required';
      $valid = FALSE;
    } elseif (!preg_match('/^[a-zA-Z ]*$/', $nama)) {
      $error_nama = 'Only letters and white space allowed';
      $valid = FALSE;
    }

	  // Cek validasi email
    $email = test_input($_POST['email']);
    if ($email == '') {
      $error_email = "Email is required";
      $valid = FALSE;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error_email = "Invalid email format";
      $valid = FALSE;
    }

    // Cek validasi password
    $password = test_input($_POST['password']);
    if ($password == '') {
      $error_password = "Password is required";
      $valid = FALSE;
    }

    // Add data to database
    if ($valid) {
      $query = "INSERT INTO user (nama, email, password, level) VALUES ('$nama', '$email', '".md5($password)."', 'CS')";
      $result = $db->query($query);
      if (!$result) {
        die('Could not query the database: <br>'.$db->error.'<br>Query: '.$query);
      } else {
        $db->close();
        header('Location: dashboard.php');
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Customer Service | Register</title>

  <!-- Custom fonts for this template-->
  <link href="../assets2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../assets2/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                  </div>

                  <form class="user" method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Full Name" value="<?php echo $nama; ?>" autofocus>
                      <div class="error" style="color: red; font-size: 0.75em; padding-left: 10px; padding-top: 10px;"><?php if (isset($error_nama)) echo $error_nama; ?></div>
                    </div>

                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?php echo $email; ?>">
                      <div class="error" style="color: red; font-size: 0.75em; padding-left: 10px; padding-top: 10px;"><?php if (isset($error_email)) echo $error_email; ?></div>
                    </div>

                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" value="<?php echo $password; ?>">
                      <div class="error" style="color: red; font-size: 0.75em; padding-left: 10px; padding-top: 10px;"><?php if (isset($error_password)) echo $error_password; ?></div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-user btn-block" name="submit" value="submit" style="border-radius: 50px;">Register Account</button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="login.php">Already have an account? Login!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../assets2/vendor/jquery/jquery.min.js"></script>
  <script src="../assets2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../assets2/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../assets2/js/sb-admin-2.min.js"></script>
</body>
</html>