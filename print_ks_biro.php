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
$saran = array();
$kritik = array();

$res1 = $db->select("SELECT * FROM `kritik_biro` WHERE `periode_kode` = '$periode' ");
$res= $db->select("SELECT * FROM `saran_biro` WHERE `periode_kode`= '$periode' ");
while($row = $res->fetch_assoc()) {
	$saran[count($saran)] = $row['saran'];
}

while($row = $res1->fetch_assoc()) {
	$kritik[count($kritik)] = $row['kritik'];
}
while($row = $res->fetch_assoc()) {
  $nama_mk[count($nama_mk)] = $row['nama_mk'];
  $nama_dosen[count($nama_dosen)] = $row['nama_dosen'];
  $jurusan1[count($jurusan1)] = $row['jurusan'];
  $satu1[count($satu1)] = $row['satu'];
  $dua1[count($dua1)] = $row['dua'];
  $tiga1[count($tiga1)] = $row['tiga'];
  $empat1[count($empat1)] = $row['empat'];
  $total1[count($total1)] = $row['total'];
}
$tempsatu =0;
$count=0;


$w = array(78, 13, 13, 13,13,13,13);
$pdf->SetFont('Arial','B',20);
$pdf->Cell(190,9,'Kritik & Saran untuk Biro',1,0,'C');
$pdf->Ln(9);
$pdf->SetFont('Arial','B',20);
$pdf->Cell(190,9,'Saran',1,0,'C');
$pdf->Ln(9);
for($i=0;$i<count($saran);$i++){
  $t =$i+1;
  $pdf->SetFont('Arial','',12);
  $pdf->Cell(10,6*$pdf->CountMultiCell( 180, 6,''.$saran[$i], 1),''.$t,1,0,'L');
  $pdf->MultiCell( 0, 6,''.$saran[$i], 1);
  $pdf->Ln(0);
}

$pdf->SetFont('Arial','B',20);
$pdf->Cell(190,9,'Kritik',1,0,'C');
$pdf->Ln(9);
for($i=0;$i<count($kritik);$i++){
  $t =$i+1;
  $pdf->SetFont('Arial','',12);
  $pdf->Cell(10,6*$pdf->CountMultiCell( 180, 6,''.$kritik[$i], 1),''.$t,1,0,'L');
  $pdf->MultiCell( 0, 6,''.$kritik[$i], 1);
  $pdf->Ln(0);
}
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
