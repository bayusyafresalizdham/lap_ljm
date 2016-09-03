<?php
	$periode = $_REQUEST['valuz'];
	$saran = array();
	$kritik = array();
	include_once '../lib/Database.php';
	$db = new Database();

  $res1 = $db->select("SELECT * FROM `kritik_biro` WHERE `periode_kode` = '$periode' ");
  $res= $db->select("SELECT * FROM `saran_biro` WHERE `periode_kode`= '$periode' ");
  while($row = $res->fetch_assoc()) {
		$saran[count($saran)] = $row['saran'];
	}

  while($row = $res1->fetch_assoc()) {
		$kritik[count($kritik)] = $row['kritik'];
	}
	echo "<a href='print_ks_biro.php?periode=".$periode."' class='btn btn-primary pull-right'>Print</a> ";

  echo "<div>";
  echo "<table class='table'>";
	echo "<tr>";
  echo "<td width=2>No.</td>";
	echo "<td width=300 style='max-width:300px;width:300px;'><b>Saran</b></td>";
	echo "</tr>";
	for($i=0;$i<count($saran);$i++){
    $t =$i+1;
		echo "<tr>";
    echo "<td width=2><b>".$t."</b></td>";
		echo "<td width=300 style='max-width:300px;width:300px;'>".$saran[$i]."</td>";
		echo "</tr>";
	}
	echo "<tr>";
  echo "<td width=2>No.</td>";
	echo "<td width=300 style='max-width:300px;width:300px;'><b>Kritik</b></td>";
	echo "</tr>";
	for($i=0;$i<count($kritik);$i++){
    $t =$i+1;
		echo "<tr>";
    echo "<td width=2><b>".$t."</b></td>";
		echo "<td width=300 style='max-width:300px;width:300px;'>".$kritik[$i]."</td>";
		echo "</tr>";
	}
  echo "</table>";
  echo "</div>";
?>
