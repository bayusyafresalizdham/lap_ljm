<?php
	error_reporting(0);
	$periode = $_REQUEST['valuz'];
	$jurusan = $_REQUEST['srchby'];

	$nama_mk = array();
	$nama_dosen = array();
	$jurusan1 = array();
	$satu1= array();
	$dua1=array();
	$tiga1=array();
	$empat1=array();
	$total1=array();
	include_once '../lib/Database.php';
	$db = new Database();
	echo "<a href='print_dosen_byname.php?periode=".$periode."&nama=".$jurusan."' class='btn btn-primary pull-right'>Print</a> ";
	
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
		for($i=0;$i<count($nama_mk);$i++){
			echo "<div>";
			echo "<table class='table'>";
			if($nama_dosen[$i-1]!=$nama_dosen[$i]){
				echo "<tr style='border-top:1px solid #000;'>";
				echo "<th colspan=8>"."Nama dosen : ". $nama_dosen[$i]."</th>";
				echo "</tr>";
				echo "<tr>";
				echo "<td width=300>"."Nama matakuliah"."</td>";
				echo "<td>"."  "."</td>";
				echo "<td width=100>"."MHS"."</td>";
				echo "<td width=100>"."1"."</td>";
				echo "<td width=100>"."2"."</td>";
				echo "<td width=100>"."3"."</td>";
				echo "<td width=100>"."4"."</td>";
				echo "<td width=100>"."AVG"."</td>";
				echo "</tr>";
			}
			echo "<tr>";
			echo "<td width=300 style='max-width:300px;width:300px;'>".$nama_mk[$i]."</td>";
			echo "<td width=200 style='margin=0 !important;'>".$jurusan1[$i]."</td>";
			echo "<td width=100>".$total1[$i]."</td>";
			echo "<td width=100>".sprintf('%0.2f', $satu1[$i])."</td>";
			echo "<td width=100>".sprintf('%0.2f',$dua1[$i])."</td>";
			echo "<td width=100>".sprintf('%0.2f',$tiga1[$i])."</td>";
			echo "<td width=100>".sprintf('%0.2f',$empat1[$i])."</td>";
			$temp = ($satu1[$i] + $dua1[$i] + $tiga1[$i] + $empat1[$i])/4;
			echo "<td width=100>".sprintf('%0.2f',$temp)."</td>";
			echo "</tr>";
			$count++;
			$tempt +=$total1[$i];
			$temps += $satu1[$i];
			$tempd += $dua1[$i];
			$tempt1 += $tiga1[$i];
			$tempe += $empat1[$i];
			$tempt2 += $temp;
			if($nama_dosen[$i+1]!=$nama_dosen[$i]){
				echo "<tr>";
				echo "<td width=300></td>";
				echo "<td width=200 class='text-left'></td>";
				echo "<td width=100>".$tempt."</td>";
				echo "<td width=100>".sprintf('%0.2f',($temps/$count))."</td>";
				echo "<td width=100>".sprintf('%0.2f',($tempd/$count))."</td>";
				echo "<td width=100>".sprintf('%0.2f',($tempt1/$count))."</td>";
				echo "<td width=100>".sprintf('%0.2f',($tempe/$count))."</td>";
				echo "<td width=100>".sprintf('%0.2f',($tempt2/$count))."</td>";
				echo "</tr>";
				$tempt=0;
				$temps=0;
				$tempd=0;
				$tempt=0;
				$tempe=0;
				$tempt1=0;
				$tempt2=0;
				$count=0;
			}
			echo "</table>";
		}
?>
