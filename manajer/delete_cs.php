<?php
  require_once('../lib/db_login.php');
  $id = $_GET['id'] ?? NULL;

  // Delete data from database
  if (!empty($id)) {
    $query = "DELETE FROM cs WHERE nama_cs = '$id'";
    $result = $db->query($query);

    $query2 = "DELETE FROM user WHERE nama = '$id'";
    $result2 = $db->query($query2);

    if (!$result && !$result2) {
      die('Could not query the database: <br>'.$db->error.'<br>Query: '.$query);
    } else {
      header('Location: data_cs.php');
      $db->close();
    }
  }
?>