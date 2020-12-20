<?php
  require('../plugin/fpdf/fpdf.php');
  $pdf = new FPDF('P','mm','A4');

  $pdf->AddPage();

  date_default_timezone_set('Asia/Jakarta');
  $tanggal = date('Y-m-d');

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

  $pdf->SetFont('Times','B',12);
  $pdf->Cell(0,7,'LAPORAN HARIAN KEBERSIHAN DAN KERAPIAN RUANG GEDUNG BERSAMA MAJU',0,1,'C');

  $pdf->SetFont('Times','B',12);
  $pdf->Cell(0,7,'Hari '.$day.' Tanggal '.date('d F Y').'',0,1,'C');

  $pdf->SetFont('Times','',12);
  $pdf->Cell(0,7,'<<Tanggal Cetak '.date('d F Y').' Jam '.date('H:i').' WIB>>',0,1,'C');

  $pdf->Cell(10,7,'',0,1);

  $pdf->SetFont('Times','B',12);

  $pdf->Cell(15,10,'No',1,0,'C');
  $pdf->Cell(40,10,'Ruang',1,0,'C');
  $pdf->Cell(80,10,'Nama CS',1,0,'C');
  $pdf->Cell(55,10,'Status',1,1,'C');

  $pdf->SetFont('Times','',12);

  require('../lib/db_login.php');

  $query = "SELECT r.nama_ruang AS nama_ruang, cs.email AS email, cs.nama_cs AS nama_cs, l.status AS status FROM ruang r JOIN cs ON r.id_cs = cs.id_cs JOIN laporan l ON l.id_ruang = r.id_ruang WHERE l.tanggal = '$tanggal' ORDER BY r.id_ruang";

  $result = $db->query($query);
  if (!$result) {
    die ("Could not query the database: <br>".$db->error."<br>Query: ".$query);
  }

  $i = 1;
  while ($row = $result->fetch_object()) {
    $pdf->Cell(15,7,$i,1,0,'C');
    $pdf->Cell(40,7,$row->nama_ruang,1,0,'C');
    $pdf->Cell(80,7,$row->nama_cs,1,0);
    $pdf->Cell(55,7,$row->status,1,1,'C');

    $i++;
  }

  $pdf->SetFont('Times','',12);
  $pdf->Cell(0,7,'',0,1,'R');
  $pdf->SetFont('Times','',12);
  $pdf->Cell(0,7,'',0,1,'R');
  $pdf->SetFont('Times','',12);
  $pdf->Cell(0,7,'',0,1,'R');

  $pdf->SetFont('Times','',12);
  $pdf->Cell(0,7,'Approval',0,1,'R');
  $pdf->SetFont('Times','',12);
  $pdf->Cell(0,7,'',0,1,'R');
  $pdf->SetFont('Times','',12);
  $pdf->Cell(0,7,'<<ttd>>',0,1,'R');
  $pdf->SetFont('Times','',12);
  $pdf->Cell(0,7,'',0,1,'R');
  $pdf->SetFont('Times','',12);
  $pdf->Cell(0,5,'Arif Sutowo',0,1,'R');
  $pdf->SetFont('Times','',12);
  $pdf->Cell(0,7,'Manajer',0,1,'R');

  $pdf->Output();
?>