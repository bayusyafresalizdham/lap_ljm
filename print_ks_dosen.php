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
$jurusan = $_GET['nama'];

$matkuls = array();
$matkulk = array();
$saran = array();
$nama_dosen = array();
$kritik = array();
$nama_dosen1 = array();
if($jurusan != ""){
   $res1 = $db->select("SELECT * FROM `kritik_dosen` WHERE `periode_kode` ='$periode' and `nama_dosen` ='$jurusan' ORDER BY nama_dosen");
   $res= $db->select("SELECT * FROM `saran_dosen` WHERE `periode_kode` = '$periode' and `nama_dosen` ='$jurusan' ORDER BY nama_dosen");
}else {
  $res1 = $db->select("SELECT * FROM `kritik_dosen` WHERE `periode_kode` ='$periode' AND nama_dosen<>'' ORDER BY nama_dosen");
  $res= $db->select("SELECT * FROM `saran_dosen` WHERE `periode_kode` = '$periode' AND nama_dosen<>'' ORDER BY nama_dosen");
}
while($row = $res->fetch_assoc()) {
  $saran[count($saran)] = $row['saran'];
  $matkuls[count($matkuls)] = $row['nama_mk'];
  $nama_dosen[count($nama_dosen)] = $row['nama_dosen'];
}

while($row = $res1->fetch_assoc()) {
  $kritik[count($kritik)] = $row['kritik'];
  $matkulk[count($matkulk)] = $row['nama_mk'];
  $nama_dosen1[count($nama_dosen1)] = $row['nama_dosen'];
}
$tempsatu =0;
$count=0;


$w = array(78, 13, 13, 13,13,13,13);
$number=0;
$number1=0;
for($i=0;$i<count($nama_dosen);$i++){
  $number1=0;
  if($nama_dosen[$i-1]!=$nama_dosen[$i]){
    if($i>0){
      $pdf->Ln(6);
    }
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(190,6,''.$nama_dosen[$i],1,0,'C');
    $pdf->Ln(6);

    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(190,6,'Kritik',1,0,'L');
    $pdf->Ln(6);

    $pdf->SetFont('Arial','',12);
    for($j=0;$j<count($nama_dosen1);$j++){
        if($nama_dosen[$i] == $nama_dosen1[$j]){
            $number1++;
            $pdf->SetFont('Arial','',12);
            $pdf->Cell(10,6*$pdf->CountMultiCell( 180, 6,$kritik[$j]." - (".$matkulk[$j].")", 1),''.$number1.'.',1,0,'L');
            $pdf->MultiCell( 0, 6,$kritik[$j]." - (".$matkulk[$j].")", 1);
            $pdf->Ln(0);
        }
    }

        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,6,'Saran',1,0,'L');
        $pdf->Ln(6);
        $number =0;
  }

    $pdf->SetFont('Arial','',12);
    $number++;
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(10,6*$pdf->CountMultiCell( 180, 6,$saran[$i]." - (".$matkuls[$i].")", 1),''.$number.'.',1,0,'L');
    $pdf->MultiCell( 0, 6,$saran[$i]." - (".$matkuls[$i].")", 1);
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
