<?php
require('PDF_MySQL_Table.php');
class PDF extends PDF_MySQL_Table
{
  function Header()
  {
      $this->SetFont('Arial','',12);
      $this->Cell(0,6,'',0,1,'C');
      $this->Ln(10);
      parent::Header();
  }
}

$pdf=new PDF();
$pdf->AddPage();

include_once 'lib/Database.php';
$db = new Database();

	error_reporting(0);
$periode = $_GET['periode'];
$field = array("satu", "dua", "tiga","empat","lima","enam","tujuh","delapan");
$nama = array("Biro Operasi Perkuliahan","Administrasi Akademik","Operasional Pembayaran Kuliah","Biro Administrasi Keuangan",
        "Perpustakaan (Gedung B)","Kemahasiswaan","Administrasi Lab","E-Library");
$nilai = array();
$res= $db->select("SELECT * FROM `mv` WHERE periode_kode='$periode'");
$res1 = $db->select("SELECT * FROM `v_rekap_quesioner_biro` WHERE periode='$periode'");
  while($row = $res1->fetch_assoc()) {
    for($i =0;$i<count($field);$i++){
      $nilai[count($nilai)] = $row[$field[$i]];
    }
  }
  while($row = $res->fetch_assoc()) {

    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(10,18,'No.',1,0,'C');
    $pdf->Cell(65,18,'Biro Yang Melayani',1,0,'C');
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(30,12,'Sangat Kurang',1,0,'C');
    $pdf->Cell(18,12,'Kurang',1,0,'C');
    $pdf->Cell(15,12,'Cukup',1,0,'C');
    $pdf->Cell(13,12,'Baik',1,0,'C');
    $pdf->Cell(26,12,'Sangat Baik',1,0,'C');
    $pdf->Cell(13,18,'Nilai',1,0,'C');
    $pdf->Ln(12);
    $pdf->Cell(10,18,'',0,0,'C');
    $pdf->Cell(65,18,'',0,0,'C');
    $pdf->Cell(30,6,'JML',1,0,'C');
    $pdf->Cell(18,6,'JML',1,0,'C');
    $pdf->Cell(15,6,'JML',1,0,'C');
    $pdf->Cell(13,6,'JML',1,0,'C');
    $pdf->Cell(26,6,'JML',1,0,'C');
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(6);
        for($i =0;$i<count($field);$i++){
        $num = $i+1;

            $x = $pdf->GetX();
            $y = $pdf->GetY();
            $heigh = 6*$pdf->CountMultiCell( 65, 6,$nama[$i], 1);
            $pdf->MultiCell(10,$heigh,$num.'.','LRB','C');
            $x += 10;
            $pdf->SetXY($x, $y);
            $pdf->MultiCell(65,6,$nama[$i],'LRB');
            $x += 65;
            $pdf->SetXY($x, $y);
            $pdf->MultiCell(30,$heigh,''.$row[$field[$i].'_satu'],'LRB','C');
            $x += 30;
            $pdf->SetXY($x, $y);
            $pdf->MultiCell(18,$heigh,''.$row[$field[$i].'_dua'],'LRB','C');
            $x += 18;
            $pdf->SetXY($x, $y);
            $pdf->MultiCell(15,$heigh,''.$row[$field[$i].'_tiga'],'LRB','C');
            $x += 15;
            $pdf->SetXY($x, $y);
            $pdf->MultiCell(13,$heigh,''.$row[$field[$i].'_empat'],'LRB','C');
            $x += 13;
            $pdf->SetXY($x, $y);
            $pdf->MultiCell(26,$heigh,''.$row[$field[$i].'_lima'],'LRB','C');
            $x += 26;
            $pdf->SetXY($x, $y);
            $pdf->MultiCell(13,$heigh,''.sprintf('%0.2f',$nilai[$i]),'LRB','C');
        }

                $pdf->SetFont('Arial','B',9);
        $pdf->Cell(155,6,'Note: Questioner disi oleh responden (mahasiswa) saat akan melakukan perwalian online',1,0,'L');
        $avg = array_sum($nilai)/count($nilai);
        $pdf->Cell(35,6,'Rata-Rata :        '.sprintf('%0.2f',$avg),1,0,'R');
  }

          $pdf->SetFont('Arial','',12);
  date_default_timezone_set("Asia/Jakarta");
  $date =  date("d M Y");
  $pdf->Ln(20);
  $pdf->Cell(0,10,'      Surabaya, '.$date.'                                                                  Surabaya, '.$date);
  $pdf->Ln(30);
  $pdf->Cell(0,10,'    Suhatati Tjandra, Ir., M.Kom.                                                      Arya Tandy Hermawan, Ir., M.T.');
  $pdf->Ln(6);
  $pdf->Cell(0,10,'               (Ketua LJM)                                                                                   (Ketua STTS)');

$pdf->Output();
?>
