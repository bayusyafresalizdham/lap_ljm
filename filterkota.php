<?php
	include_once 'lib/Database.php';
	$db = new Database();
	$res= $db->select("SELECT kota_kode, kota_nama FROM ext_kota WHERE kota_show = 1 ORDER BY kota_nama");
					while($r = $res->fetch_assoc()) {
 ?>
		<option value='<?php echo $r["kota_kode"]; ?>'> <?php echo $r["kota_nama"]; }?></option>
<?php
	}
?>
