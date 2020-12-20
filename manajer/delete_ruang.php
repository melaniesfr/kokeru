<?php
  require_once('../lib/db_login.php');
  $id = $_GET['id'] ?? NULL;

  // Delete data from database
  if (!empty($id)) {
    $query = "DELETE FROM ruang WHERE id_ruang = '$id'";
    $result = $db->query($query);

    $query1 = "DELETE FROM laporan WHERE id_ruang = '$id' AND tanggal = '2020-12-16'";
    $result1 = $db->query($query1);

    if (!$result && !$result1) {
      die('Could not query the database: <br>'.$db->error.'<br>Query: '.$query);
    } else {
      header('Location: data_ruang.php');
      $db->close();
    }
  }
?>