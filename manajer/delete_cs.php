<?php
  require_once('../lib/db_login.php');
  $id = $_GET['id'] ?? NULL;

  // Delete data from database
  if (!empty($id)) {
    $query = "DELETE FROM cs WHERE id_cs = '$id'";
    $result = $db->query($query);
    if (!$result) {
      die('Could not query the database: <br>'.$db->error.'<br>Query: '.$query);
    } else {
      header('Location: data_cs.php');
      $db->close();
    }
  }
?>