<?php
require('PDF_MySQL_Table.php');
class PDF extends PDF_MySQL_Table
{
  function Header()
  {
      $this->SetFont('Arial','',18);
      $this->Cell(0,6,'',0,1,'C');
      $this->Ln(10);
      parent::Header();
  }
}
mysql_connect('localhost','root','');
mysql_select_db('db_ljm');
$pdf=new PDF();
$pdf->AddPage();

$pdf->SetFont('Arial','',12);
$pdf->Cell(40,10,'Kepada');
$pdf->Ln(6);
$nama = $_GET['nama'];
$pdf->Cell(0,10,'Yth. '.$nama);
$pdf->Ln(6);
$pdf->Cell(0,10,'Di Tempat');
$pdf->Ln(16);
$pdf->Cell(0,10,'Dengan hormat,');
$pdf->Ln(6);
$pdf->Cell(0,10,'Di bawah ini kami sampaikan rekap hasil kuestioner mahasiswa untuk matakuliah - matakuliah');
$pdf->Ln(6);
$pdf->Cell(0,10,'yang Bapak/Ibu asuh di Sekolah Tinggi Teknik Surabaya pada semester Gasal 2015/2016.');
$pdf->Ln(20);

$prop=array('HeaderColor'=>array(255,255,255),
            'color1'=>array(255,255,255),
            'color2'=>array(255,255,255),
            'padding'=>2);
$pdf->AddCol('Matakuliah',70,'Matakuliah');
$pdf->AddCol('Jurusan',50,'Jurusan');
$pdf->AddCol('Mhs',10,'Mhs');
$pdf->AddCol('1',12,'1');
$pdf->AddCol('2',12,'2');
$pdf->AddCol('3',12,'3');
$pdf->AddCol('4',12,'4');
$pdf->AddCol('AVG',12,'AVG');
$pdf->Table("SELECT nama_mk 'Matakuliah',jurusan 'Jurusan',total 'Mhs',ROUND(satu, 2) '1',ROUND(dua, 2) '2',ROUND(tiga, 2) '3',ROUND(empat, 2) '4', ROUND((satu+dua+tiga+empat)/4, 2) 'AVG'
FROM `mv_rekap_quesioner_dosen` WHERE `periode_kode` = '$_GET[periode]' and `nama_dosen` ='$_GET[nama]'",$prop);
include_once 'lib/Database.php';
$db = new Database();
$res= $db->select("SELECT ROUND(AVG((satu+dua+tiga+empat)/4), 2) 'wkwk'
FROM `mv_rekap_quesioner_dosen` WHERE `periode_kode` = '$_GET[periode]' and `nama_dosen` ='$_GET[nama]'");
while($row = $res->fetch_assoc()) {

  $w = array(70, 50, 10, 12,12,24,12);
  $pdf->Cell($w[0],6,'',1,0,'L');
  $pdf->Cell($w[1],6,'',1,0,'L');
  $pdf->Cell($w[2],6,'',1,0,'R');
  $pdf->Cell($w[3],6,'',1,0,'R');
  $pdf->Cell($w[4],6,'',1,0,'R');
  $pdf->Cell($w[5],6,'Rata-rata',1,0,'R');
  $pdf->Cell($w[6],6, ' '.$row['wkwk'],1,1, 1, 'R');

}
$pdf->SetFont('Arial','I',12);
$pdf->Ln(6);
$pdf->Cell(0,20,'Keterangan : ');
$pdf->Ln(10);
$pdf->Cell(0,10,'1 = Penguasaan materi yang di sajikan');
$pdf->Ln(6);
$pdf->Cell(0,10,'2 = Cara mengajar (penyampaian materi)');
$pdf->Ln(6);
$pdf->Cell(0,10,'3 = Ketepatan Jadwal Dosen');
$pdf->Ln(6);
$pdf->Cell(0,10,'4 = Evaluasi dosen terhadap mahasiswa');
$pdf->Ln(6);
$pdf->Cell(0,10,'Nilai: 0 = Sangat Kurang; 1 = Kurang; 2 = Cukup; 3 = Baik; 4 = Sangat Baik');
$pdf->Ln(16);
$pdf->Cell(0,10,'Kami mengharapkan input yang didapatkan dari mahasiswa ini dapat meningkatkan kualitas');
$pdf->Ln(6);
$pdf->Cell(0,10,'belajar mengajar untuk semester-semester berikutnya. Atas perhatian dan kerjasamanya, kami');
$pdf->Ln(6);
$pdf->Cell(0,10,'ucapkan terima kasih');
$pdf->Ln(20);
date_default_timezone_set("Asia/Jakarta");
$date =  date("d M Y");
$pdf->Cell(0,10,'                                                                                                   Surabaya, '.$date);
$pdf->Ln(30);
$pdf->Cell(0,10,'                                                                                                   Lukman Zaman');
$pdf->Ln(6);
$pdf->Cell(0,10,'                                                                                                   Ketua Jurusan S1-DKV & S1 Despro');
$pdf->Output();
?>
