<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Export Laporan Harian ke Excel</title>
</head>

<body>
  <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Laporan Harian KoKeRu.xls");
  ?>

  <center>
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

      // echo '<h4>
      //         Laporan Harian Kebersihan dan Kerapian Ruangan Gedung Bersama Maju <br>
      //         Hari '.$day.' Tanggal '.date('d F Y').'
      //       </h4>';

      echo '<h4>
              Laporan Harian Kebersihan dan Kerapian Ruangan Gedung Bersama Maju <br>
              Hari Selasa Tanggal 1 '.date('F Y').'
            </h4>';

      echo '<p>&lt;&lt;Tanggal Cetak '.date('d F Y').' Jam '.date('H:i').' WIB&gt;&gt;</p>';
    ?>
  </center>

  <table border="1">
    <thead>
      <tr>
        <th>No</th>
        <th>Ruang</th>
        <th>Nama CS</th>
        <th>Status</th>
      </tr>
    </thead>

    <tbody class="text-center">
      <?php
        require('../lib/db_login.php');

        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d');
        // $tanggal = '2020-12-16';
        $tanggal = '2020-12-01';

        // $query = "SELECT r.nama_ruang AS nama_ruang, cs.email AS email, cs.nama_cs AS nama_cs, l.status AS status FROM ruang r JOIN cs ON r.id_cs = cs.id_cs JOIN laporan l ON l.id_ruang = r.id_ruang WHERE l.tanggal = '$tanggal' ORDER BY r.id_ruang";

        $query = "SELECT r.nama_ruang AS nama_ruang, cs.email AS email, cs.nama_cs AS nama_cs, l.status AS status FROM ruang r JOIN cs ON r.id_cs = cs.id_cs JOIN laporan l ON l.id_ruang = r.id_ruang WHERE l.tanggal = '$tanggal' AND l.status = 'BELUM' ORDER BY r.id_ruang";

        $result = $db->query($query);
        if (!$result) {
          die ("Could not query the database: <br>".$db->error."<br>Query: ".$query);
        }

        // Fetch and display the results
        $i = 1;
        while ($row = $result->fetch_object()) {
          echo '<tr>';
          echo '<td>'.$i.'</td>';
          echo '<td>'.$row->nama_ruang.'</td>';
          echo '<td>'.$row->nama_cs.'</td>';
          echo '<td>'.$row->status.'</td>';
          echo '</tr>';

          $i++;
        }

        echo '</tbody>';
        echo '</table>';

        $result->free();
        $db->close();
      ?>
  <p class="text-right">
    Approval <br><br>
    &lt;&lt;ttd&gt;&gt; <br><br>
    Arif Sutowo <br>
    Manajer
  </p>
</body>
</html>