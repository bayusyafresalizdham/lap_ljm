<?php

	$hasil = $_REQUEST['valuz'];
	$field = array("satu", "dua", "tiga","empat","lima","enam","tujuh","delapan");
	$nama = array("Biro Operasi Perkuliahan","Administrasi Akademik","Operasional Pembayaran Kuliah","Biro Administrasi Keuangan",
					"Perpustakaan (Gedung B)","Kemahasiswaan","Administrasi Lab","E-Library");
	$nilai = array();
	include_once '../lib/Database.php';
	$db = new Database();
	echo "<a href='print_biro.php?periode=".$hasil."' class='btn btn-primary pull-right'>Print</a> ";

	$res= $db->select("SELECT * FROM `mv` WHERE periode_kode='$hasil'");
	$res1 = $db->select("SELECT * FROM `v_rekap_quesioner_biro` WHERE periode='$hasil'");
		while($row = $res1->fetch_assoc()) {
			for($i =0;$i<count($field);$i++){
				$nilai[count($nilai)] = $row[$field[$i]];
			}
		}

		while($row = $res->fetch_assoc()) {
			echo "<div>";
				echo "<table class='table'>";
				  echo "<tr>";
				    echo "<th rowspan='2'>No.</th>";
				    echo "<th rowspan='2'>Biro Yang Melayani</th>";
				    echo "<th>Sangat Kurang</th>";
				    echo "<th>Kurang</th>";
				    echo "<th>Cukup</th>";
				    echo "<th>Baik</th>";
				    echo "<th>Sangat Baik</th>";
				    echo "<th rowspan='2' class='text-center'>Nilai</th>";
				  echo "</tr>";
				  echo "<tr>";
				    echo "<td class='text-center'>JML</td>";
				    echo "<td class='text-center'>JML</td>";
				    echo "<td class='text-center'>JML</td>";
				    echo "<td class='text-center'>JML</td>";
				    echo "<td class='text-center'>JML</td>";
				  echo "</tr>";
					for($i =0;$i<count($field);$i++){
					$num = $i+1;
				  echo "<tr>";
				    echo "<td>".$num."</td>";
				    echo "<td>".$nama[$i]."</td>";
				    echo "<td class='text-center'>".$row[$field[$i].'_satu']."</td>";
				    echo "<td class='text-center'>".$row[$field[$i].'_dua']."</td>";
				    echo "<td class='text-center'>".$row[$field[$i].'_tiga']."</td>";
				    echo "<td class='text-center'>".$row[$field[$i].'_empat']."</td>";
				    echo "<td class='text-center'>".$row[$field[$i].'_lima']."</td>";
				    echo "<td class='text-center'>".sprintf('%0.2f',$nilai[$i])."</td>";
				  echo "</tr>";
					}
					$avg = array_sum($nilai)/count($nilai);
					echo "<tr>";
					echo "<td colspan='7'>Note: Questioner disi oleh responden (mahasiswa) saat akan melakukan perwalian online</td>";
					echo "<td colspan='1'>Rata Rata : ".sprintf('%0.2f',$avg)."</td>";
					echo "</tr>";

				echo "</table>";
			echo "</div>";
		}
?>
