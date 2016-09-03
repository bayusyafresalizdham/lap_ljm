<?php
error_reporting(0);
	$periode = $_REQUEST['valuz'];
	$jurusan = $_REQUEST['srchby'];
	$saran = array();
	$nama_dosen = array();
	$kritik = array();
	$nama_dosen1 = array();
	$matkuls = array();
	$matkulk = array();
	include_once '../lib/Database.php';
	$db = new Database();
	echo "<a href='print_ks_dosen.php?periode=".$periode."&nama=".$jurusan."' class='btn btn-primary pull-right'>Print</a> ";

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
	for($i=0;$i<count($nama_dosen);$i++){

		if($nama_dosen[$i-1]!=$nama_dosen[$i]){
		  echo "<div class='col-md-12 col-sm-12 col-xs-12'>";
			  echo "<div class='x_panel'>";
				  echo "<div class='x_title'>";
					  echo "<h2>Saran & Kritik Mahasiswa</h2>";
					  echo "<ul class='nav navbar-right panel_toolbox'>";

					  echo "</ul>";
					  echo "<div class='clearfix'></div>";
				  echo "</div>";
				  echo "<div class='x_content'>";
					  echo "<ul class='list-unstyled timeline'>";
		      echo "<li>";
		      echo "<div class='block'>";
		      echo "<div class='tags'>";
		      echo "<a href='' class='tag'>";
		      echo "<span>Saran</span>";
		      echo "</a>";
		      echo "</div>";
		      echo "<div class='block_content'>";
		      echo "<h2 class='title'>";
					echo $nama_dosen[$i]."</h2>";
		      echo "<div class='byline'>";
		      echo "<span>".$nama_dosen[$i];
		      echo "</div>";
					echo "<p class='excerpt'>";
					echo "<ul>";
					for($j=0;$j<count($nama_dosen);$j++){
						if($nama_dosen[$i] == $nama_dosen[$j]){
			      	echo "<li>"."<b style='color:#000;'>".$matkuls[$j]."</b> - ".$saran[$j]."  </li>";
						}
					}
					echo "</ul>";
					echo "</p>";
		      echo "</div>";
		      echo "</div>";
		      echo "</li>";
					echo "<li>";
					echo "<div class='block' >";
					echo "<div class='tags' >";
					echo "<a href='' class='tag1' >";
					echo "<span >Kritik</span>";
					echo "</a>";
					echo "</div>";
					echo "<div class='block_content'>";
					echo "<h2 class='title'>";
					echo $nama_dosen[$i]."</h2>";
					echo "<div class='byline'>";
					echo "<span>".$nama_dosen[$i];
					echo "</div>";
					echo "<p class='excerpt'>";
					echo "<ul>";
					for($j=0;$j<count($nama_dosen1);$j++){
						if($nama_dosen[$i] == $nama_dosen1[$j]){
							echo "<li><b style='color:#000;'>".$matkulk[$j]."</b> - ".$kritik[$j]."  </li>";
						}
					}
					echo "</ul>";
					echo "</p>";
					echo "</div>";
					echo "</div>";
					echo "</li>";
					  echo "</ul>";

				  echo "</div>";
			  echo "</div>";
		  echo "</div>";
		}
	}
?>
