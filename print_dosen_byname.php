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

	$nama_mk = array();
	$nama_dosen = array();
	$jurusan1 = array();
	$satu1= array();
	$dua1=array();
	$tiga1=array();
	$empat1=array();
	$total1=array();

if($jurusan != ""){
   $res= $db->select("SELECT * FROM mv_rekap_quesioner_dosen where periode_kode = '$periode' AND nama_dosen='$jurusan' ORDER BY nama_dosen");
}else {
  $res= $db->select("SELECT * FROM mv_rekap_quesioner_dosen where periode_kode = '$periode' AND nama_dosen<>'' ORDER BY nama_dosen");

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

  for($i=0;$i<count($nama_mk);$i++){
    if($nama_dosen[$i-1]!=$nama_dosen[$i]){
      $pdf->SetFont('Arial','B',12);
      $pdf->Cell(190,6,'Nama dosen : '.$nama_dosen[$i],1,0,'L');
      $pdf->SetFont('Arial','',12);
      $pdf->Ln(6);
      $pdf->Cell($w[0],6,'Nama matakuliah	',1,0,'L');
      $pdf->Cell(34,6,'',1,0,'L');
      $pdf->Cell($w[1],6,'MHS',1,0,'L');
      $pdf->Cell($w[2],6,'1',1,0,'R');
      $pdf->Cell($w[3],6,'2',1,0,'R');
      $pdf->Cell($w[4],6,'3',1,0,'R');
      $pdf->Cell($w[5],6,'4',1,0,'R');
      $pdf->Cell($w[4],6,'AVG',1,0,'R');
      $pdf->Ln(6);
    }
    $pdf->Cell($w[0],6,''.$nama_mk[$i],1,0,'L');
    $pdf->Cell(34,6,''.$jurusan1[$i],1,0,'L');
    $pdf->Cell($w[1],6,''.$total1[$i],1,0,'L');
    $pdf->Cell($w[2],6,''.sprintf('%0.2f', $satu1[$i]),1,0,'R');
    $pdf->Cell($w[3],6,''.sprintf('%0.2f',$dua1[$i]),1,0,'R');
    $pdf->Cell($w[4],6,''.sprintf('%0.2f',$tiga1[$i]),1,0,'R');
    $pdf->Cell($w[5],6,''.sprintf('%0.2f',$empat1[$i]),1,0,'R');
    $temp = ($satu1[$i] + $dua1[$i] + $tiga1[$i] + $empat1[$i])/4;
    $pdf->Cell($w[4],6,''.sprintf('%0.2f',$temp),1,0,'R');
    $pdf->Ln(6);

    $count++;
    $tempt +=$total1[$i];
    $temps += $satu1[$i];
    $tempd += $dua1[$i];
    $tempt1 += $tiga1[$i];
    $tempe += $empat1[$i];
    $tempt2 += $temp;
    if($nama_dosen[$i+1]!=$nama_dosen[$i]){


      $pdf->Cell($w[0],6,'',1,0,'R');
      $pdf->Cell(34,6,'',1,0,'L');
      $pdf->Cell($w[1],6,''.$tempt,1,0,'L');
      $pdf->Cell($w[2],6,''.sprintf('%0.2f',($temps/$count)),1,0,'R');
      $pdf->Cell($w[3],6,''.sprintf('%0.2f',($tempd/$count)),1,0,'R');
      $pdf->Cell($w[4],6,''.sprintf('%0.2f',($tempt1/$count)),1,0,'R');
      $pdf->Cell($w[5],6,''.sprintf('%0.2f',($tempe/$count)),1,0,'R');
      $pdf->Cell($w[4],6,''.sprintf('%0.2f',($tempt2/$count)),1,0,'R');
      $pdf->Ln(6);
      $tempt=0;
      $temps=0;
      $tempd=0;
      $tempt=0;
      $tempe=0;
      $tempt1=0;
      $tempt2=0;
      $count=0;
    }
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
